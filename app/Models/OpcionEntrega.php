<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionEntrega extends Model
{
    use HasFactory;

    protected $table = 'opciones_entrega';
    protected $fillable = [
        'nombre_opcion',
        'descripcion',
        'costo',
        'estado_id',
    ];
    // Relación con el modelo Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
