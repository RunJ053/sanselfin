<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosUsuario;
use App\Models\FormaPago;
use App\Models\OpcionEntrega;
use App\Models\DetallePedido;
use App\Models\Estado;
use App\Models\MovimientoFinanciero;
use Carbon\Carbon;

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

    // Relaciones
    public function usuarios()
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

    public function movimientos()
    {
        return $this->hasMany(MovimientoFinanciero::class, 'pedido_id');
    }

    // Evento que dispara el movimiento financiero cuando se finaliza el pedido
    protected static function booted()
    {
        static::updated(function ($pedido) {
            if ($pedido->wasChanged('estado_id') && $pedido->estado_id == 7) {
                try {
                    MovimientoFinanciero::create([
                        'fecha'       => Carbon::now(),
                        'tipo'        => 'ingreso',
                        'monto'       => $pedido->total,
                        'descripcion' => "Ingreso por Pedido #{$pedido->id}",
                        'pedido_id'   => $pedido->id
                    ]);
                } catch (\Exception $e) {
                    \Log::error("Error creando movimiento financiero: " . $e->getMessage());
                }
            }
        });
    }
}
