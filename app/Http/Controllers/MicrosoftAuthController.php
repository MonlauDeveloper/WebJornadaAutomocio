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
    /**
     * Redirige a Microsoft.
     * Si detectamos que viene de la App, lo marcamos en el state de OAuth.
     */
    public function redirectToMicrosoft(Request $request)
    {
        $driver = Socialite::driver('microsoft')
            ->stateless()
            ->with(['tenant' => config('services.microsoft.tenant')]);
 
        // Si la petición trae ?platform=mobile, lo guardamos en el state
        if ($request->get('platform') === 'mobile') {
            $driver->with(['state' => 'platform=mobile']);
        }
 
        return $driver->redirect();
    }
 
    /**
     * Maneja el callback y decide si redirigir a Web o a la App de Flutter.
     */
    public function handleMicrosoftCallback(Request $request)
    {
        try {
            // 1. Obtención del usuario mediante Socialite
            $microsoftUser = Socialite::driver('microsoft')
                ->stateless()
                ->with(['tenant' => config('services.microsoft.tenant')])
                ->user();
            $userData = $microsoftUser->user;
 
            // 2. Procesamiento de nombres y limpieza de acentos
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
            // 3. Consulta de grupos en Microsoft Graph
            $memberOfResponse = Http::withToken($microsoftUser->token)
                ->get('https://graph.microsoft.com/v1.0/me/memberOf')
                ->json();
            $courses = array_column($memberOfResponse['value'] ?? [], 'displayName');
            // --- MODIFICACIÓN: Lógica de roles permisiva ---
            // Verificamos si es profesor (esto lo mantenemos por si acaso)
            $isTeacher = !empty(array_intersect($courses, ['EquipDocentLM', 'PersonalDocentLM']));
            if ($isTeacher) {
                $isStudent = false;
                $idRole = 4; // Rol Profesor
            } else {
                // AQUÍ EL CAMBIO: Si no es profesor, asumimos SIEMPRE que es alumno.
                // Ignoramos si está matriculado en los cursos específicos de la lista antigua.
                $isStudent = true; 
                $idRole = 3; // Rol Alumno
            }
 
            $email = $userData['mail'] ?? $microsoftUser->email;
            // 4. Gestión del Usuario en Base de Datos (Evitar duplicados de username)
            $user = User::where('email', $email)->first();
 
            if (!$user) {
                $user = new User();
                $user->email = $email;
                $user->password = bcrypt('Monlau2025');
                // Generar username único
                $finalUsername = $baseUsername;
                $counter = 1;
                while (User::where('username', $finalUsername)->exists()) {
                    $finalUsername = $baseUsername . $counter;
                    $counter++;
                }
                $user->username = $finalUsername;
            }
 
            $user->idRole = $idRole;
            $user->status = 'approved';
            $user->save();
            // 5. Registro en tablas Student / Teacher
            if ($isStudent) {
                $specializations = [
                    '2CA-CM' => 1, '2CA-CS' => 4, '2CB-CM' => 1, '2CB-CS' => 4, '2CC-CM' => 1, '2CC-CS' => 4,
                    '2CD-CM' => 1, '2CD-CS' => 4, '2CE-CM' => 1, '2CE-CS' => 4, '2CF-CM' => 1, '2CF-CS' => 4,
                    '2CMA-CM' => 2, '2CR-CM' => 1, '2CR-CS' => 4, '2XA-CM' => 3, '2XB-CM' => 3, 'ONLINE' => 4
                ];
                $userSpec = null;
                // Intentamos encontrar la especialización real
                foreach ($courses as $c) {
                    if (isset($specializations[$c])) { $userSpec = $specializations[$c]; break; }
                }
                // --- MODIFICACIÓN: Asignar especialización por defecto ---
                // Si no se encontró ningún curso, le asignamos la ID 1 para que no falle.
                if ($userSpec === null) {
                    $userSpec = 1; 
                }
                // Creamos o actualizamos el estudiante
                $student = Student::updateOrCreate(
                    ['idUser' => $user->idUser],
                    [
                        'name' => $nombre, 
                        'surname1' => $apellido1, 
                        'surname2' => $apellido2, 
                        'idSpecialization' => $userSpec
                    ]
                );
                if($student) {
                    $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
                    $student->save();
                }
            }
            if ($isTeacher) {
                Teacher::updateOrCreate(
                    ['idUser' => $user->idUser],
                    ['name' => $nombre, 'surname1' => $apellido1, 'surname2' => $apellido2]
                );
            }
 
            // 6. Decidir Redirección (Web vs Flutter)
            // Generamos un token para la API si es para el móvil
            $token = $user->createToken('auth_token')->plainTextToken;
 
            // Si el 'state' contiene platform=mobile o el User-Agent es móvil
            $isMobile = str_contains($request->get('state'), 'platform=mobile') ||
                        preg_match('/iPhone|iPad|Android|Mobile/i', $request->header('User-Agent'));
 
            if ($isMobile) {
                // Esquema: appautomocion://login-callback?token=...
                return redirect("appautomocion://login-callback?token=" . $token);
            }
            Auth::login($user);
            return redirect()->route('projects.index')->with('success', 'Bienvenido.');
 
        } catch (\Exception $e) {
            Log::error('Error Login Microsoft: ' . $e->getMessage());
            return redirect('/')->with('error', 'Error en la autenticación.');
        }
    }        
}