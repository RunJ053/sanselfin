<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Impuesto;
use App\Models\Promocion;
use App\Models\Estado;
use App\Models\FormaPago;
use App\Models\OpcionEntrega;
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
            ['id' => 2, 'desc_estado' => 'Inactivo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'desc_estado' => 'Pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'desc_estado' => 'En Proceso', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'desc_estado' => 'Completado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'desc_estado' => 'Enviado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'desc_estado' => 'Entregado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'desc_estado' => 'Devuelto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'desc_estado' => 'Cancelado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'desc_estado' => 'Rechazado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'desc_estado' => 'Aprobado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'desc_estado' => 'Pendiente de Pago', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'desc_estado' => 'Fallido', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'desc_estado' => 'Reembolsado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'desc_estado' => 'En Espera', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'desc_estado' => 'Finalizado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'desc_estado' => 'Suspendido', 'created_at' => now(), 'updated_at' => now()],
        ]);

        FormaPago::insert([
            [
                'id' => 1101,
                'estado_id' => 1,
                'nombre_forma_pago' => 'Efectivo',
                'descripcion' => 'Pago mediante efectivo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 1201,
                'estado_id' => 2,
                'nombre_forma_pago' => 'PayU',
                'descripcion' => 'Pago mediante PayU',
                'created_at' => now(),
                'updated_at' => now()
            ],
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

        // Insertar datos en la tabla opciones_entrega
        OpcionEntrega::insert([
            ['nombre_opcion' => 'Envío Estándar', 'costo' => 10000, 'descripcion' => 'Entrega en 2-3 días hábiles', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_opcion' => 'Envío Adomicilio', 'costo' => 15000, 'descripcion' => 'Entrega directo a tu casa', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_opcion' => 'Recogida en Tienda', 'costo' => 0, 'descripcion' => 'Recoge tu pedido en nuestra tienda física', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
