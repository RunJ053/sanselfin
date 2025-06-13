<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero;
use App\Models\TipoDocumento;
use App\Models\Seguridad;
use App\Models\TipoCliente;

class InicialDataSeeder extends Seeder
{
    public function run()
    {
        // Insertar datos en la tabla generos
        Genero::insert([
            ['descripcion_gen' => 'Masculino', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'Femenino', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'No Binario', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'Prefiero no decirlo', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'Otro', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'Género Fluido', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_gen' => 'Transgénero', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insertar datos en la tabla tipos_documentos
        TipoDocumento::insert([
            ['descripcion' => 'Cédula de Ciudadanía', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Tarjeta de Identidad', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Pasaporte', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Registro Civil', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Cédula de Extranjería', 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Tipo de cliente
        TipoCliente::insert([
            ['descripcion_cliente' => 'Natural', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_cliente' => 'Jurídico', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_cliente' => 'Empresa', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion_cliente' => 'Organización', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insertar datos en la tabla seguridad
        Seguridad::insert([
            ['descripcion' => '¿Cuál es el nombre de tu primera mascota?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el nombre de tu ciudad natal?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál fue el nombre de tu mejor amigo en la infancia?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el nombre de tu escuela primaria?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es tu comida favorita?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el modelo de tu primer automóvil?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el nombre de tu madre?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el lugar de nacimiento de tu padre?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál fue tu primer empleo?', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => '¿Cuál es el nombre de tu primer profesor?', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}


