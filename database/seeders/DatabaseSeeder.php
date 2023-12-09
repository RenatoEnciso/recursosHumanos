<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(1)->create();

         // Crear un administrador de sistema
         \App\Models\User::factory()->create([
            'name' => 'Administrador de sistema',
            'email' => 'admi@gmail.com',
            'password' => bcrypt('admi'),
            'idRol' => 4,
        ]);

        // Crear un usuario de contrato
        \App\Models\User::factory()->create([
            'name' => 'Usuario de Contrato',
            'email' => 'contrato@gmail.com',
            'password' => bcrypt('contrato'),
            'idRol' => 5,
        ]);

        // Crear un usuario de RRHH
        \App\Models\User::factory()->create([
            'name' => 'Usuario de RRHH',
            'email' => 'rrhh@gmail.com',
            'password' => bcrypt('rrhh'),
            'idRol' => 6,
        ]);
    }
}




