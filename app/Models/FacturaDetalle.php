<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;
    protected $table = 'facturas_detalles';
    protected $fillable = [
        'factura_cabecera_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subTotal',
        'descuento',
        'envio',
        'montoTotal',
    ];

    public function facturaCabecera()
    {
        return $this->belongsTo(FacturaCabecera::class, 'factura_cabecera_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
