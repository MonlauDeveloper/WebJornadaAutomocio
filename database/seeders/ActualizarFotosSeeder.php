<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActualizarFotosSeeder extends Seeder
{
    public function run()
    {
        // Relación de tu columna 'curso' con el nombre de tus carpetas en VS Code
        $carpetas = [
            'A' => 'AUTOA_mail',
            'B' => 'AUTOB_mail',
            'C' => 'AUTOC_mail',
            'D' => 'AUTOD_mail',
            'E' => 'AUTOE_mail',
            'F' => 'AUTOF_mail',
        ];

        foreach ($carpetas as $letra => $carpeta) {
            $estudiantes = DB::table('students')->where('curso', $letra)->get();

            foreach ($estudiantes as $e) {
                // AQUÍ ESTÁ EL TRUCO: 
                // Si las fotos se llaman como el ID (ej: 43.jpg), deja $e->idStudent
                // Si se llaman como el correo (ej: alumno@mail.com.jpg), usa $e->email
                $nombreArchivo = $e->idStudent . ".jpg"; 

                $nuevaRuta = "students_photos/GradoSuperior/{$carpeta}/{$nombreArchivo}";

                DB::table('students')
                    ->where('idStudent', $e->idStudent)
                    ->update(['photoName' => $nuevaRuta]);
            }
        }
    }
}