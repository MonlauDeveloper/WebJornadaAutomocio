<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Student;

class ActualizarFotosSeeder extends Seeder
{
    public function run()
    {
        // Usamos el disco 'public' que apunta a storage/app/public
        // allFiles obtiene todos los archivos incluyendo los de las subcarpetas (2CA, 2CB, etc.)
        $files = Storage::disk('public')->allFiles('students_photos/GradoMedio');

        $actualizados = 0;
        $noEncontrados = 0;

        foreach ($files as $file) {
            // Ejemplo de $file: students_photos/GradoMedio/2CA/correo@monlau.com.jpg
            
            // Verificamos si es una imagen
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                
                // Extraemos el correo (nombre del archivo sin extensión)
                $email = pathinfo($file, PATHINFO_FILENAME);
                
                // Buscamos al usuario por correo
                $user = User::where('email', $email)->first();

                if ($user) {
                    // Buscamos el registro de estudiante asociado al usuario
                    $student = Student::where('idUser', $user->idUser)->first();

                    if ($student) {
                        // Guardamos la ruta relativa tal como la necesita la base de datos
                        $student->photoName = $file;
                        $student->save();
                        
                        $actualizados++;
                    }
                } else {
                    $noEncontrados++;
                }
            }
        }

        $this->command->info("Se han actualizado las fotos de {$actualizados} alumnos de Grado Medio.");
        if ($noEncontrados > 0) {
            $this->command->warn("No se encontró el usuario en la base de datos para {$noEncontrados} fotos.");
        }
    }
}