<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Promocion;
use App\Models\Estado;
use App\Models\FormaPago;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
                'descuento' => 5.00,
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
                'descuento' => 8.00,
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
                'descuento' => 8.00,
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
                'descuento' => 10.00,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('unidades_medida')->insert([
            // Pesos
            ['nombre' => 'Kilogramo', 'abreviatura' => 'Kg'],
            ['nombre' => 'Gramo', 'abreviatura' => 'gr'],
            ['nombre' => 'Libra', 'abreviatura' => 'lb'],

            // Volúmenes
            ['nombre' => 'Litro', 'abreviatura' => 'L'],
            ['nombre' => 'Mililitro', 'abreviatura' => 'ml'],
            ['nombre' => 'Galón', 'abreviatura' => 'gal'],

            // Unidades
            ['nombre' => 'Unidad', 'abreviatura' => 'u'],
            ['nombre' => 'Pieza', 'abreviatura' => 'pieza'],
            ['nombre' => 'Docena', 'abreviatura' => 'dz'],
            ['nombre' => '1/2 Docena', 'abreviatura' => '1/2dz'],

            // Agrupaciones
            ['nombre' => 'Atado', 'abreviatura' => 'atado'],
            ['nombre' => 'Manojo', 'abreviatura' => 'man'],
            ['nombre' => 'Bulto', 'abreviatura' => 'bulto'],
            ['nombre' => 'Saco', 'abreviatura' => 'saco'],
            ['nombre' => 'Paquete', 'abreviatura' => 'paq'],
            ['nombre' => 'Caja', 'abreviatura' => 'caja'],
            ['nombre' => 'Sixpack', 'abreviatura' => '6pk'],

            // Envases
            ['nombre' => 'Lata', 'abreviatura' => 'lata'],
            ['nombre' => 'Frasco', 'abreviatura' => 'frasco'],
            ['nombre' => 'Sobre', 'abreviatura' => 'sobre'],
            ['nombre' => 'Bolsa', 'abreviatura' => 'bolsa'],
            ['nombre' => 'Bandeja', 'abreviatura' => 'band'],
        ]);

        Categoria::insert([
            ['id' => 1, 'nombre' => 'Verduras', 'descripcion' => 'Verduras verdes y saludables', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Hortalizas', 'descripcion' => 'Tubérculos y hortalizas frescas', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nombre' => 'Frutas', 'descripcion' => 'Frutas frescas y naturales', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nombre' => 'Carnes', 'descripcion' => 'Carnes rojas, blancas y pescado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nombre' => 'Lácteos', 'descripcion' => 'Leche, queso, yogur y más', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nombre' => 'Panadería', 'descripcion' => 'Panes, tortas y repostería', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nombre' => 'Bebidas', 'descripcion' => 'Bebidas refrescantes y jugos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nombre' => 'Huevos', 'descripcion' => 'Huevos frescos AA y A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nombre' => 'Granos', 'descripcion' => 'Arroz, frijol, lentejas y más', 'created_at' => now(), 'updated_at' => now()],
        ]);


        // Insertar datos en la tabla opciones_entrega
        OpcionEntrega::insert([
            ['nombre_opcion' => 'Envío Adomicilio', 'costo' => 8000, 'descripcion' => 'Entrega directo a tu casa', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_opcion' => 'Recogida en Tienda', 'costo' => 0, 'descripcion' => 'Recoge tu pedido en nuestra tienda física', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $now = Carbon::now();

        DB::table('productos')->insert([
            // 🥦 Verduras y hortalizas
            ['id' => 1, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 1, 'unidad_medida_id' => 1, 'nombre_producto' => 'Tomate Chonto', 'stock' => 250, 'descripccion' => 'Tomate rojo fresco y jugoso', 'imagen' => 'Tomate.png', 'precio_unitario' => 3000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 1, 'unidad_medida_id' => 1, 'nombre_producto' => 'Cebolla Larga', 'stock' => 180, 'descripccion' => 'Cebolla verde ideal para cocinar', 'imagen' => 'Cebolla larga.png', 'precio_unitario' => 3500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 2, 'unidad_medida_id' => 1, 'nombre_producto' => 'Lechuga Crespa', 'stock' => 90, 'descripccion' => 'Lechuga fresca ideal para ensaladas', 'imagen' => 'Lechuga crespa.png', 'precio_unitario' => 5000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 2, 'unidad_medida_id' => 1, 'nombre_producto' => 'Papa Pastusa', 'stock' => 400, 'descripccion' => 'Papa ideal para sopas y guisos', 'imagen' => 'Papa.png', 'precio_unitario' => 2000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 2, 'unidad_medida_id' => 1, 'nombre_producto' => 'Zanahoria', 'stock' => 150, 'descripccion' => 'Zanahoria fresca, rica en vitaminas', 'imagen' => 'zha.jfif', 'precio_unitario' => 2500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 2, 'unidad_medida_id' => 2, 'nombre_producto' => 'Cilantro', 'stock' => 200, 'descripccion' => 'Cilantro fresco en atado', 'imagen' => 'Cilantro.png', 'precio_unitario' => 1500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 2, 'unidad_medida_id' => 2, 'nombre_producto' => 'Perejil', 'stock' => 100, 'descripccion' => 'Perejil fresco en atado', 'imagen' => 'Espinaca (2).png', 'precio_unitario' => 1200, 'created_at' => $now, 'updated_at' => $now],

            // 🍌 Frutas
            ['id' => 8, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 1, 'nombre_producto' => 'Banano', 'stock' => 300, 'descripccion' => 'Banano maduro y fresco', 'imagen' => 'Platano colicero.png', 'precio_unitario' => 2500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 1, 'nombre_producto' => 'Mango Tommy', 'stock' => 130, 'descripccion' => 'Mango dulce y jugoso', 'imagen' => 'Mango.png', 'precio_unitario' => 4000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 3, 'nombre_producto' => 'Piña Gold', 'stock' => 110, 'descripccion' => 'Piña dulce de gran tamaño', 'imagen' => 'Piña.png', 'precio_unitario' => 6000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 3, 'nombre_producto' => 'Papaya', 'stock' => 100, 'descripccion' => 'Papaya fresca y dulce', 'imagen' => 'Papaya.png', 'precio_unitario' => 4500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 1, 'nombre_producto' => 'Manzana Roja', 'stock' => 200, 'descripccion' => 'Manzana fresca y crujiente', 'imagen' => 'Manzana roja.png', 'precio_unitario' => 7000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 1, 'nombre_producto' => 'Pera', 'stock' => 170, 'descripccion' => 'Pera dulce y jugosa', 'imagen' => 'Pera.png', 'precio_unitario' => 6500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 3, 'unidad_medida_id' => 1, 'nombre_producto' => 'Sandía', 'stock' => 90, 'descripccion' => 'Sandía fresca y grande', 'imagen' => 'Sandia.png', 'precio_unitario' => 8000, 'created_at' => $now, 'updated_at' => $now],

            // 🥩 Carnes
            ['id' => 15, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 4, 'unidad_medida_id' => 1, 'nombre_producto' => 'Carne Molida Res', 'stock' => 80, 'descripccion' => 'Carne de res molida fresca', 'imagen' => 'Carne molida.png', 'precio_unitario' => 12000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 4, 'unidad_medida_id' => 1, 'nombre_producto' => 'Pechuga Pollo', 'stock' => 70, 'descripccion' => 'Pechuga fresca sin piel', 'imagen' => 'Pechuga pollo.png', 'precio_unitario' => 11000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 17, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 4, 'unidad_medida_id' => 1, 'nombre_producto' => 'Costilla de Cerdo', 'stock' => 60, 'descripccion' => 'Costilla fresca ideal para asar', 'imagen' => 'Costilla cerdo.png', 'precio_unitario' => 15000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 18, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 4, 'unidad_medida_id' => 1, 'nombre_producto' => 'Pescado Mojarra', 'stock' => 50, 'descripccion' => 'Mojarra fresca de río', 'imagen' => 'Mojarra.png', 'precio_unitario' => 13000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 19, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 4, 'unidad_medida_id' => 1, 'nombre_producto' => 'Chuleta de Cerdo', 'stock' => 55, 'descripccion' => 'Chuleta de cerdo fresca', 'imagen' => 'Chuleta.png', 'precio_unitario' => 14000, 'created_at' => $now, 'updated_at' => $now],

            // 🧀 Lácteos
            ['id' => 20, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 5, 'unidad_medida_id' => 3, 'nombre_producto' => 'Queso Campesino', 'stock' => 50, 'descripccion' => 'Queso fresco de leche entera', 'imagen' => 'Queso.png', 'precio_unitario' => 9000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 21, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 5, 'unidad_medida_id' => 4, 'nombre_producto' => 'Leche Entera', 'stock' => 120, 'descripccion' => 'Leche fresca pasteurizada', 'imagen' => 'Leche.png', 'precio_unitario' => 4000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 22, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 5, 'unidad_medida_id' => 4, 'nombre_producto' => 'Yogurt Natural', 'stock' => 90, 'descripccion' => 'Yogurt natural sin azúcar', 'imagen' => 'Yogurt.png', 'precio_unitario' => 3500, 'created_at' => $now, 'updated_at' => $now],

            // 🍞 Panadería
            ['id' => 23, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 6, 'unidad_medida_id' => 3, 'nombre_producto' => 'Pan Tajado', 'stock' => 140, 'descripccion' => 'Pan tajado blanco ideal para sándwiches', 'imagen' => 'Pan tajado.png', 'precio_unitario' => 5000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 24, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 6, 'unidad_medida_id' => 3, 'nombre_producto' => 'Pan Francés', 'stock' => 200, 'descripccion' => 'Pan francés crocante', 'imagen' => 'Pan frances.png', 'precio_unitario' => 600, 'created_at' => $now, 'updated_at' => $now],

            // 🥤 Bebidas
            ['id' => 25, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 7, 'unidad_medida_id' => 4, 'nombre_producto' => 'Gaseosa Coca-Cola 1.5L', 'stock' => 100, 'descripccion' => 'Gaseosa refrescante', 'imagen' => 'CocaCola.png', 'precio_unitario' => 5000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 26, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 7, 'unidad_medida_id' => 4, 'nombre_producto' => 'Agua Brisa 1.5L', 'stock' => 150, 'descripccion' => 'Agua mineral sin gas', 'imagen' => 'Agua.png', 'precio_unitario' => 3000, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 27, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 7, 'unidad_medida_id' => 4, 'nombre_producto' => 'Jugo Hit Mango 1L', 'stock' => 130, 'descripccion' => 'Jugo de mango pasteurizado', 'imagen' => 'Jugo.png', 'precio_unitario' => 4500, 'created_at' => $now, 'updated_at' => $now],

            // 🥚 Huevos
            ['id' => 28, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 8, 'unidad_medida_id' => 3, 'nombre_producto' => 'Huevo AA x30', 'stock' => 80, 'descripccion' => 'Huevo fresco categoría AA', 'imagen' => 'Huevo.png', 'precio_unitario' => 15000, 'created_at' => $now, 'updated_at' => $now],

            // 🧂 Abarrotes
            ['id' => 29, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 9, 'unidad_medida_id' => 1, 'nombre_producto' => 'Arroz xKg', 'stock' => 300, 'descripccion' => 'Arroz blanco premium', 'imagen' => 'Arroz.png', 'precio_unitario' => 3500, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30, 'descuento_id' => 1, 'estado_id' => 1, 'categoria_id' => 9, 'unidad_medida_id' => 1, 'nombre_producto' => 'Frijol Bola Roja xKg', 'stock' => 200, 'descripccion' => 'Frijol rojo ideal para sopas', 'imagen' => 'Frijol.png', 'precio_unitario' => 7000, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
