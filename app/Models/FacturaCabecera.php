<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCabecera extends Model
{
    use HasFactory;
    protected $table = 'facturas_cabeceras';
    protected $fillable = [
        'estado_id',
        'cliente_id',
        'forma_pago_id',
        'envio_id',
        'pedido_id',
        'numero_factura',
        'fecha'
    ];

    public function usuario()
    {
        return $this->belongsTo(DatoUsuario::class, 'cliente_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }

    public function envio()
    {
        return $this->belongsTo(OpcionEntrega::class, 'envio_id');
    }

    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class, 'factura_cabecera_id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
