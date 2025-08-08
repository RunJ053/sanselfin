<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DatoUsuario;

class DatoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creacion del super admin
        DatoUsuario::insert([
            'nombre' => 'Diana',
            'email' => 'diana033@gmail.com',
            'password' => bcrypt('FincaDiana2025'),
            'tipo_docu' => 1,
            'role' => 2,
            'tipo_de_genero' => 2,
            'localidad' => 15,
            'is_verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
