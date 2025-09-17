<?php

namespace App\Observers;

use App\Models\Producto;
use App\Models\Tarea;
use Carbon\Carbon;

class ProductoObserver
{
    /**
     * Se ejecuta cuando un producto es actualizado
     */
    public function updated(Producto $producto)
    {
        // Verifica si el campo stock cambió
        if ($producto->isDirty('stock') && $producto->stock <= 5) {
            // Crear una tarea pendiente
            Tarea::create([
                'titulo' => 'Stock bajo en ' . $producto->nombre_producto,
                'descripcion' => 'El producto "' . $producto->nombre_producto . '" tiene stock de ' . $producto->stock,
                'tipo' => 'pendiente',
                'fecha_creacion' => Carbon::now(),
            ]);
        }
    }
}

