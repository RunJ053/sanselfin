<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'productos';

    protected $fillable = [
        'impuesto_id',
        'descuento_id',
        'categoria_id',
        'estado_id',
        'nombre_producto',
        'stock',
        'descripccion',
        'precio_unitario',
    ];

    // Relaciones (opcional pero recomendado para el futuro)
    public function impuestos()
    {
        return $this->belongsTo(Impuesto::class, 'impuesto_id');
    }

    public function promociones()
    {
        return $this->belongsTo(Promocion::class, 'descuento_id');
    }

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function resenas()
    {
        return $this->hasMany(ResenaProducto::class);
    }

    public function getPromedioCalificacionAttribute()
    {
        return $this->resenas()->avg('calificacion') ?? 0;
    }
}
