<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class MicrosoftAuthController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        // Obtén los datos del usuario desde Microsoft
        $microsoftUser = Socialite::driver('microsoft')->user();
        $userData = $microsoftUser->user;

        $accents = array("á", "à", "é", "è", "ì", "í", "ó", "ò", "ù", "ú", "À", "Á", "É", "È", "Í", "Ì", "Ó", "Ò", "Ù", "Ú", "Ñ", "ñ");
        $accentsReplacement = array("a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "A", "A", "E", "E", "I", "I", "O", "O", "U", "U", "N", "n");
    
        // Obtén el nombre y apellidos tal cual
        $nombre = $userData['givenName']; // No reemplazamos acentos
        $surname = $userData['surname']; 
    
        // Divide el apellido en dos partes
        $apellido1 = explode(' ', $surname)[0] ?? ''; 
        $apellido2 = explode(' ', $surname)[1] ?? ''; 
    
        // Genera el username con los nombres y apellidos sin acentos
        $nombreSinAcentos = str_replace($accents, $accentsReplacement, $nombre);
        $apellido1SinAcentos = str_replace($accents, $accentsReplacement, $apellido1);
        $apellido2SinAcentos = str_replace($accents, $accentsReplacement, $apellido2);
    
        $username = ucfirst($nombreSinAcentos) 
                    . ucfirst(substr($apellido1SinAcentos, 0, 3)) 
                    . ucfirst(substr($apellido2SinAcentos, 0, 3));
    
        // Verifica el curso del alumno
        $memberOfResponse = Http::withToken($microsoftUser->token)
            ->get('https://graph.microsoft.com/v1.0/me/memberOf')
            ->json();
    
        $courses = array_column($memberOfResponse['value'] ?? [], 'displayName');
        $studentCourses = [
            "2CA-CM", "2CA-CS", "2CB-CM", "2CB-CS", "2CC-CM", "2CC-CS",
            "2CD-CM", "2CD-CS", "2CE-CM", "2CE-CS", "2CF-CM", "2CF-CS",
            "2CMA-CM", "2CR-CM", "2CR-CS", "2XA", "2XB"
        ];
    
        $isStudent = !empty(array_intersect($courses, $studentCourses));
        $isTeacher = !$isStudent && !empty(array_intersect($courses, ['EquipDocentLM', 'PersonalDocentLM'])); // Verifica si es profesor
        $idRole = $isStudent ? 3 : ($isTeacher ? 4 : 2); // Alumno = 3, Profesor = 4, otro = 2
        $status = 'approved';
    
        // Busca o crea un nuevo usuario
        $user = User::firstOrNew(['email' => $userData['mail']]);

        // Si el usuario es nuevo, establece la contraseña
        if (!$user->exists) {
            $user->password = bcrypt('Monlau2025');
        }

        // Actualiza o establece otros atributos del usuario
        $user->username = $username;
        $user->idRole = $idRole;
        $user->status = $status;
        $user->save();
    
        // Si el usuario es alumno, guardar datos adicionales en la tabla students
        if ($isStudent) {
            $specializations = [
                '2CA-CM' => 1, '2CA-CS' => 4, '2CB-CM' => 1, '2CB-CS' => 4, '2CC-CM' => 1, '2CC-CS' => 4,
                '2CD-CM' => 1, '2CD-CS' => 4, '2CE-CM' => 1, '2CE-CS' => 4, '2CF-CM' => 1, '2CF-CS' => 4,
                '2CMA-CM' => 2, '2CMA-CM GM Motos' => 2, '2CR-CM' => 1, '2CR-CS' => 4, '2XA-CM' => 3, '2XB-CM' => 3, 'ONLINE' => 4 //11-02-25 11.07
            ];
            
            $userSpecialization = null;
            foreach ($courses as $course) {
                if (isset($specializations[$course])) {
                    $userSpecialization = $specializations[$course];
                    break;
                }
            }
    
            if ($userSpecialization) {
                $student = \App\Models\Student::updateOrCreate(
                ['idUser' => $user->idUser, // Vincular al usuario creado
                ], [
                    'name' => $nombre, 
                    'surname1' => $apellido1, 
                    'surname2' => $apellido2,
                    'idSpecialization' => $userSpecialization,
                ]);
                if($student){
                    $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
                    $student->save();
                }
            }
           
        }
    
        // Si el usuario es profesor, guardar datos adicionales en la tabla teachers
        if ($isTeacher) {
            \App\Models\Teacher::updateOrCreate([
                'idUser' => $user->idUser, // Vincular al usuario creado
            ], [
                'name' => $nombre, // Guardar nombre con acentos
                'surname1' => $apellido1, // Guardar primer apellido con acentos
                'surname2' => $apellido2, // Guardar segundo apellido con acentos
            ]);
        }
    
        Auth::login($user);
    
        return redirect()->route('projects.index')->with('success', 'Usuario autenticado correctamente.');
    }        
}