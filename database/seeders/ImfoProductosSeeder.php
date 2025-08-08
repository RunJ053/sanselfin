<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Impuesto;
use App\Models\Promocion;
use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImfoProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Impuesto::insert([
            [
                'nombre_impuesto' => 'IVA 16%',
                'porcentaje' => 16.00,
                'descripcion' => 'Impuesto al valor agregado del 16%',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre_impuesto' => 'IVA 8%',
                'porcentaje' => 8.00,
                'descripcion' => 'Impuesto al valor agregado del 8%',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        Estado::insert([
            ['id' => 1, 'desc_estado' => 'Activo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'desc_estado' => 'Inactivo', 'created_at' => now(), 'updated_at' => now()]
        ]);



        Promocion::insert([
            [
                'estado_id' => 1,
                'codigo_promocion' => 'FINA2025',
                'nombre_promocion' => 'Fin de Año',
                'descripcion' => 'Promoción de fin de año',
                'descuento' => 0.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estado_id' => 1,
                'codigo_promocion' => 'AMOR2025',
                'nombre_promocion' => 'Amor y Amistad',
                'descripcion' => 'Promoción del amor y la amistad',
                'descuento' => 0.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estado_id' => 1,
                'codigo_promocion' => 'MADRE2025',
                'nombre_promocion' => 'Día de la Madre',
                'descripcion' => 'Promoción día madre',
                'descuento' => 0.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estado_id' => 1,
                'codigo_promocion' => 'PADRE2025',
                'nombre_promocion' => 'Día del Padre',
                'descripcion' => 'Promoción día padre',
                'descuento' => 0.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estado_id' => 1,
                'codigo_promocion' => 'NAVIDAD2025',
                'nombre_promocion' => 'Navidad',
                'descripcion' => 'Promoción de navidad',
                'descuento' => 0.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);



        Categoria::insert([
            [
                'nombre' => 'Frutas',
                'descripcion' => 'Frutas frescas y naturales',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Verduras',
                'descripcion' => 'Verduras verdes y saludables',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Mecato',
                'descripcion' => 'Snacks y golosinas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Lácteos',
                'descripcion' => 'Productos lácteos como leche, queso, yogur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Otro',
                'descripcion' => 'Otras categorías no especificadas',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
