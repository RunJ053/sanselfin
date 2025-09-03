<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = [
        'fecha',
        'total',
        'direccion_envio',
        'usuario',
        'pagos',
        'envios',
        'estado_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(DatoUsuario::class, 'usuario');
    }
    public function pago()
    {
        return $this->belongsTo(FormaPago::class, 'pagos');
    }
    public function envio()
    {
        return $this->belongsTo(OpcionEntrega::class, 'envios');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedidos');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
