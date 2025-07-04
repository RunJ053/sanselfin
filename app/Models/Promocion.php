<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';
    protected $fillable = [
        'estado_id',
        'codigo_promocion',
        'nombre_promocion',
        'descripcion',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    protected $dates = ['created_at', 'updated_at'];
    // Relaciones
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

}
