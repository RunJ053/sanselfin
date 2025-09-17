<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MovimientoFinanciero extends Model
{
    protected $table = "movimientos_financieros";
    protected $fillable = [
        'fecha',
        'tipo',
        'monto',
        'descripcion',
        'pedido_id',
        'producto_id'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
