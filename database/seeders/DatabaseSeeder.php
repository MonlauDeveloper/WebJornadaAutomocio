<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insertar roles - corregida columna 'name' en lugar de 'role'
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Company'],
        ]);

        // Insertar usuarios
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

        // Las siguientes tablas serán agregadas cuando se creen sus migraciones
        // DB::table('specializations')->insert([...]);
        // DB::table('teams')->insert([...]);
        // DB::table('projects')->insert([...]);
        // etc...
    }
}
