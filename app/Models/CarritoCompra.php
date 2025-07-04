<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoCompra extends Model
{
    use HasFactory;

    protected $table = 'carrito_compras';

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'usuario', // Asumo que este es el ID del usuario
        'producto_id',
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class); // Asegúrate de que 'Producto' sea el nombre de tu modelo de producto
    }

    public function user()
    {
        // Asegúrate de que 'App\Models\DatoUsuario' sea la ruta correcta a tu modelo de usuario
        return $this->belongsTo(DatoUsuario::class, 'usuario', 'id'); // 'usuario' es la FK en carrito_compras, 'id' es la PK en DatoUsuario
    }
}
