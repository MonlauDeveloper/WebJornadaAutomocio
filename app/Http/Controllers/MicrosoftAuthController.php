<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MicrosoftAuthController extends Controller
{
    public function redirectToMicrosoft(Request $request)
    {
        $driver = Socialite::driver('microsoft')
            ->stateless()
            ->with(['tenant' => config('services.microsoft.tenant')]);

        if ($request->get('platform') === 'mobile') {
            $driver->with([
                'tenant' => config('services.microsoft.tenant'),
                'state' => 'platform=mobile'
            ]);
        }

        return $driver->redirect();
    }

    public function handleMicrosoftCallback(Request $request)
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')
                ->stateless()
                ->with(['tenant' => config('services.microsoft.tenant')])
                ->user();

            $userData = $microsoftUser->user;

            $accents = ["á", "à", "é", "è", "ì", "í", "ó", "ò", "ù", "ú", "À", "Á", "É", "È", "Í", "Ì", "Ó", "Ò", "Ù", "Ú", "Ñ", "ñ"];
            $accentsReplacement = ["a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "A", "A", "E", "E", "I", "I", "O", "O", "U", "U", "N", "n"];
            $nombre = $userData['givenName'] ?? 'Usuario';
            $surname = $userData['surname'] ?? '';
            $apellido1 = explode(' ', $surname)[0] ?? '';
            $apellido2 = explode(' ', $surname)[1] ?? '';
            $nombreSinAcentos = str_replace($accents, $accentsReplacement, $nombre);
            $apellido1SinAcentos = str_replace($accents, $accentsReplacement, $apellido1);
            $apellido2SinAcentos = str_replace($accents, $accentsReplacement, $apellido2);
            
            $baseUsername = ucfirst($nombreSinAcentos)
                        . ucfirst(substr($apellido1SinAcentos, 0, 3))
                        . ucfirst(substr($apellido2SinAcentos, 0, 3));

            $memberOfResponse = Http::withToken($microsoftUser->token)
                ->get('https://graph.microsoft.com/v1.0/me/memberOf')
                ->json();

            $courses = array_column($memberOfResponse['value'] ?? [], 'displayName');

            $isTeacher = !empty(array_intersect($courses, ['EquipDocentLM', 'PersonalDocentLM']));
            if ($isTeacher) {
                $isStudent = false;
                $idRole = 4;
            } else {
                $isStudent = true; 
                $idRole = 3; 
            }

            $state = $request->get('state', '');
            $isMobile = str_contains($state, 'platform=mobile') ||
                        preg_match('/iPhone|iPad|Android|Mobile/i', $request->header('User-Agent'));

            $esDePrimero = false;
            $esDeSegundo = false;

            foreach ($courses as $c) {
                if (str_starts_with($c, '2') || $c === 'ONLINE') {
                    $esDeSegundo = true;
                }
                if (str_starts_with($c, '1')) {
                    $esDePrimero = true;
                }
            }

            if ($esDePrimero && !$esDeSegundo && !$isTeacher) {
                if ($isMobile) {
                    $errorMsg = urlencode('Acceso denegado. App exclusiva para 2º año.');
                    $appUrl = "appautomocion://login-callback?error=" . $errorMsg;
                    return response()->make('
                        <!DOCTYPE html>
                        <html lang="es">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Redirigiendo a la App...</title>
                            <meta http-equiv="refresh" content="0;url=' . $appUrl . '">
                        </head>
                        <body style="font-family: Arial, sans-serif; text-align: center; padding-top: 50px; background-color: #f4f4f9;">
                            <h2>Acceso Denegado</h2>
                            <p style="color: #555; font-size: 16px;">Volviendo a la aplicación...</p>
                            <script>
                                setTimeout(function() {
                                    window.location.href = "' . $appUrl . '";
                                }, 800);
                            </script>
                        </body>
                        </html>
                    ');
                }
                return redirect('/')->with('error', 'Acceso denegado: Esta App es exclusiva para alumnos de 2º año.');
            }

            $email = $userData['mail'] ?? $microsoftUser->email;

            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = new User();
                $user->email = $email;
                $user->password = bcrypt('Monlau2025');
                $finalUsername = $baseUsername;
                $counter = 1;
                while (User::where('username', $finalUsername)->exists()) {
                    $finalUsername = $baseUsername . $counter;
                    $counter++;
                }
                $user->username = $finalUsername;
                
                $user->idRole = $idRole;
                $user->status = 'approved';
                $user->save();
            }

            if ($isStudent) {
                $specializations = [
                    '2CA-CM' => 1, '2CA-CS' => 4, '2CB-CM' => 1, '2CB-CS' => 4, '2CC-CM' => 1, '2CC-CS' => 4,
                    '2CD-CM' => 1, '2CD-CS' => 4, '2CE-CM' => 1, '2CE-CS' => 4, '2CF-CM' => 1, '2CF-CS' => 4,
                    '2CMA-CM' => 2, '2CR-CM' => 1, '2CR-CS' => 4, '2XA-CM' => 3, '2XB-CM' => 3, 'ONLINE' => 4
                ];
                
                $userSpec = 1; 
                $letraCurso = null;

                foreach ($courses as $c) {
                    if (isset($specializations[$c])) { 
                        $userSpec = $specializations[$c]; 
                        $letraCurso = (strlen($c) >= 3 && $c !== 'ONLINE') ? $c[2] : null;
                        break; 
                    }
                }

                $student = Student::firstOrCreate(
                    ['idUser' => $user->idUser],
                    [
                        'name' => $nombre, 
                        'surname1' => $apellido1, 
                        'surname2' => $apellido2, 
                        'idSpecialization' => $userSpec,
                        'curso' => $letraCurso
                    ]
                );

                if(empty($student->cvLink)) {
                    $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
                    $student->save();
                }
            }

            if ($isTeacher) {
                Teacher::firstOrCreate(
                    ['idUser' => $user->idUser],
                    ['name' => $nombre, 'surname1' => $apellido1, 'surname2' => $apellido2]
                );
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            if ($isMobile) {
                $safeToken = urlencode($token);
                $appUrl = "appautomocion://login-callback?token=" . $safeToken;

                return response()->make('
                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Redirigiendo a la App...</title>
                        <meta http-equiv="refresh" content="0;url=' . $appUrl . '">
                    </head>
                    <body style="font-family: Arial, sans-serif; text-align: center; padding-top: 50px; background-color: #f4f4f9;">
                        <h2>Inicio de sesión exitoso</h2>
                        <p style="color: #555; font-size: 16px;">Vuelve a la aplicación para continuar.</p>
                        <p style="color: #777; font-size: 14px; margin-bottom: 30px;">Si la aplicación no se abre automáticamente, presiona el botón:</p>
                        <a href="' . $appUrl . '" style="display: inline-block; padding: 14px 28px; background-color: #0078D4; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Abrir Aplicación</a>
                        <script>
                            setTimeout(function() {
                                window.location.href = "' . $appUrl . '";
                            }, 800);
                        </script>
                    </body>
                    </html>
                ');
            }

            Auth::login($user);
            return redirect()->route('projects.index')->with('success', 'Bienvenido.');

        } catch (\Exception $e) {
            Log::error('Error Login Microsoft: ' . $e->getMessage());
            
            $state = $request->get('state', '');
            $isMobile = str_contains($state, 'platform=mobile') || preg_match('/iPhone|iPad|Android|Mobile/i', $request->header('User-Agent'));
            
            if ($isMobile) {
                $appUrl = "appautomocion://login-callback?error=Error_en_autenticacion";
                return response()->make('<html><head><meta http-equiv="refresh" content="0;url=' . $appUrl . '"></head><body><script>window.location.href="' . $appUrl . '";</script></body></html>');
            }

            return redirect('/')->with('error', 'Error en la autenticación.');
        }
    }
}