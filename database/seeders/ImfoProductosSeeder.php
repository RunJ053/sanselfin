<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Impuesto;
use App\Models\Promocion;
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
            ['descripcion_imp'=> 'IVA 16%', 'created_at'=> now(), 'updated_at'=> now()],
            ['descripcion_imp'=> 'IVA 8%', 'created_at'=> now(), 'updated_at'=> now()]
            ]);

Promocion::insert([
    ['estado_id' => 1,'codigo_promocion' => 'FINA2025','nombre_promocion' => 'Fin de Año','descripcion_pro' => 'Promoción de fin de año',
        'created_at' => now(),
        'updated_at' => now()],
    ['estado_id' => 1,'codigo_promocion' => 'AMOR2025','nombre_promocion' => 'Amor y Amistad','descripcion_pro' => 'Promoción del amor y la amistad',
        'created_at' => now(),
        'updated_at' => now()],
    ['estado_id' => 1,'codigo_promocion' => 'MADRE2025','nombre_promocion' => 'Día de la Madre','descripcion_pro' => 'Promoción día madre',
        'created_at' => now(),
        'updated_at' => now()],
    ['estado_id' => 1,'codigo_promocion' => 'PADRE2025','nombre_promocion' => 'Día del Padre','descripcion_pro' => 'Promoción día padre',
        'created_at' => now(),
        'updated_at' => now()],
    ['estado_id' => 1,'codigo_promocion' => 'NAVIDAD2025','nombre_promocion' => 'Navidad','descripcion_pro' => 'Promoción de navidad',
        'created_at' => now(),
        'updated_at' => now()]
]);


        Categoria::insert([
            ['descripcion_cate'=>'Frutas', 'created_at'=> now(), 'updated_at'=>now()],
            ['descripcion_cate'=>'Verduras', 'created_at'=> now(), 'updated_at'=>now()],
            ['descripcion_cate'=>'Mecato', 'created_at'=> now(), 'updated_at'=>now()],
            ['descripcion_cate'=>'Lacteos', 'created_at'=> now(), 'updated_at'=>now()],
            ['descripcion_cate'=>'Otro', 'created_at'=> now(), 'updated_at'=>now()],

        ]);
    }
}
