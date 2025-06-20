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
        'fecha_fin'
    ];
}



