<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table = 'detalles_pedidos';
    protected $fillable = [
        'cantidad',
        'precio',
        'descuento_aplicado',
        'pedidos',
        'productos',
        'usuario',
        'estados'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedidos');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos');
    }

    public function usuario()
    {
        return $this->belongsTo(DatoUsuario::class, 'usuario');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados');
    }
}
