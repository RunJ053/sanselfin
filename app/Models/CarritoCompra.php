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
        'impuesto_calculado',
        'total_item',
        'usuario',
        'producto_id',
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(DatoUsuario::class, 'usuario', 'id'); // 'usuario' es la FK en carrito_compras, 'id' es la PK en DatoUsuario
    }
}
