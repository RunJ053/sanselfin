<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero;
use App\Models\TipoDocumento;
use App\Models\Localidad;
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
            ['role' => 'Usuario', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Empleado', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insertar datos en la tabla seguridad
        Localidad::insert([
            ['descripcion' => 'Antonio Nariño', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Barrios Unidos', 'create_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Bosa', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Chapinero ', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Ciudad Bolívar', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Engativá', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Fontibón', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Kennedy', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'La Candelaria', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Los Mártires', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Puente Aranda', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Rafael Uribe Uribe', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'San Cristóbal', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Santa Fé', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Suba', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Sumapaz', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Teusaquillo', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Tunjuelito', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Usaquén', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Usme', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
