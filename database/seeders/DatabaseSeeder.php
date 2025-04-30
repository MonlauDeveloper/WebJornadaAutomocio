<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['role' => 'Admin'],
            ['role' => 'User'],
            ['role' => 'Student'],
            ['role' => 'Teacher'],
            ['role' => 'Company'],
        ]);

        DB::table('users')->insert([
            ['userName' => 'admin', 'email' => 'admin@example.com', 'password' => bcrypt('admin123'), 'idRole' => 1],
            ['userName' => 'Javier Salvador', 'email' => 'javsal@example.com', 'password' => bcrypt('password'), 'idRole' => 4],
            ['userName' => 'Alex Ormeño', 'email' => 'alex@example.com', 'password' => bcrypt('password'), 'idRole' => 3],
            ['userName' => 'Carlos Tarré', 'email' => 'carlos@example.com', 'password' => bcrypt('password'), 'idRole' => 3],
            ['userName' => 'Felipe Casanova', 'email' => 'felipe@example.com', 'password' => bcrypt('password'), 'idRole' => 2],
            ['userName' => 'Rodi Motor', 'email' => 'rodi@example.com', 'password' => bcrypt('password'), 'idRole' => 5],
            ['userName' => 'BMW', 'email' => 'bmw@example.com', 'password' => bcrypt('password'), 'idRole' => 5],
            ['userName' => 'Roberto Manca', 'email' => 'robman@example.com', 'password' => bcrypt('password'), 'idRole' => 4],
        ]);

        DB::table('specializations')->insert([
            ['specialization' => 'GM Electromecánica'],
            ['specialization' => 'GM Motocicletas'],
            ['specialization' => 'GM Carrocería'],
            ['specialization' => 'GS Automoción'],
        ]);

        DB::table('teams')->insert([
            ['teamName' => 'Team Alpha'],
            ['teamName' => 'Team Beta'],
            ['teamName' => 'Team Gamma'],
        ]);

        DB::table('projects')->insert([
            ['title' => 'Restauracion BMW', 'photoName' => 'motorBMW.jpg', 'videoURL' => 'http://video.com/motorBMW', 'pdfURL' => 'http://pdf.com/pdf.pdf', 'moodleURL' => 'http://moodle.com', 'abstract' => 'Proyecto de restaurar un BMW.'],
            ['title' => 'Chapa Pintura', 'photoName' => 'chapaPintura.jpg', 'videoURL' => 'http://video.com/video2', 'pdfURL' => 'http://pdf.com/project2.pdf', 'moodleURL' => 'http://moodle.com', 'abstract' => 'Un proyecto de chapa y pintura!'],
        ]);

        DB::table('students')->insert([
            ['name' => 'Alex', 'surname1' => 'Ormeño', 'surname2' => 'Gómez', 'photoName' => 'alexO.jpg', 'cvLink' => 'http://curriculum.com/alexOCV.pdf', 'isTeamLeader' => 1, 'idUser' => 3, 'idSpecialization' => 1, 'idTeam' => 1, 'idProject' => 1],
            ['name' => 'Carlos', 'surname1' => 'Tarré', 'surname2' => 'Villanueva', 'photoName' => 'carlosT.jpg', 'cvLink' => 'http://curriculum.com/carlosTCV.pdf', 'isTeamLeader' => 0, 'idUser' => 4, 'idSpecialization' => 2, 'idTeam' => 2, 'idProject' => 2],
        ]);

        DB::table('companies')->insert([
            ['companyName' => 'Rodi Motor', 'idUser' => 6],
            ['companyName' => 'BMW', 'idUser' => 7],
        ]);

        DB::table('teachers')->insert([
            ['name' => 'Javier', 'surname1' => 'Salvador', 'surname2' => 'Marco', 'idUser' => 2],
            ['name' => 'Roberto', 'surname1' => 'Manca', 'surname2' => '', 'idUser' => 8],
        ]);

        DB::table('meetings')->insert([
            ['idCompany' => 1, 'idStudent' => 2, 'description' => 'Chapa y pintura con Rodi.', 'meetingDate' => '2024-12-01 10:00:00'],
            ['idCompany' => 2, 'idStudent' => 1, 'description' => 'Hablando con BMW para revision del motor.', 'meetingDate' => '2024-12-05 14:00:00'],
        ]);

        DB::table('ubications')->insert([
            ['ubicationName' => 'Sala A'],
            ['ubicationName' => 'Online'],
        ]);

        DB::table('dynamicTestings')->insert([
            ['idDynamicTesting' => 1, 'testingName' => 'System Performance Testing', 'description' => 'Test to evaluate the performance of the system under heavy load.', 'testingDate' => '2024-12-10 09:00:00', 'idUbication' => 1],
            ['idDynamicTesting' => 2, 'testingName' => 'Security Testing', 'description' => 'Test to ensure the system is secure from potential vulnerabilities.', 'testingDate' => '2024-12-12 10:00:00', 'idUbication' => 2],
        ]);        

        DB::table('presentations')->insert([
            ['presentationName' => 'Levantar culata', 'topic' => 'Motores', 'presentationDate' => '2024-12-10 11:00:00', 'idUbication' => 1],
            ['presentationName' => 'Mejor Aceite', 'topic' => 'Aceites', 'presentationDate' => '2024-12-12 15:00:00', 'idUbication' => 2],
        ]);

        DB::table('speakers')->insert([
            ['name' => 'Juan', 'surname1' => 'Garcia', 'surname2' => 'Perez', 'description' => 'Experto mecanico.', 'birthDate' => '1985-06-15'],
            ['name' => 'Carlos', 'surname1' => 'Hernandez', 'surname2' => 'Vidal', 'description' => 'Especialista en pintura.', 'birthDate' => '1975-04-20'],
        ]);

        DB::table('publicationTypes')->insert([
            ['type' => 'Escapes'],
            ['type' => 'Neumaticos'],
            ['type' => 'Tapizado'],
        ]);

        DB::table('publications')->insert([
            ['idPublication' => 1, 'title' => 'Soldar un buen escape', 'description' => 'Mecanico hablando de como soldar un escape.', 'publicationDate' => '2024-11-15', 'idPublicationType' => 1],
            ['idPublication' => 2, 'title' => 'Como tapizar tu asiento', 'description' => 'Tapizaremos un asiento de cuero.', 'publicationDate' => '2024-11-20', 'idPublicationType' => 3],
        ]);        

        DB::table('Bibliographies')->insert([
            ['idSpeaker' => 1, 'idPublication' => 1],
            ['idSpeaker' => 2, 'idPublication' => 2],
        ]);

        DB::table('rel_speakers_presentations')->insert([
            ['idSpeaker' => 1, 'idPresentation' => 1],
            ['idSpeaker' => 2, 'idPresentation' => 2],
        ]);
    }
}
