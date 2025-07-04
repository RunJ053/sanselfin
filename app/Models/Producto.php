<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table='productos';
    protected $fillable = [
        'nombre_producto',
        'descripccion',
        //'imagen',
        'precio_unitario',
        'impuesto_id',
        'descuento_id',
        'categoria_id',
    ];
    public function promociones()
    {
        return $this->belongsTo(Promocion::class, 'descuento_id');
    }

    public function impuestos()
    {
        return $this->belongsTo(Impuesto::class, 'impuesto_id');
    }

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}






    protected $table = 'productos';

    protected $fillable = [
        'impuesto_id',
        'descuento_id',
        'categoria_id',
        'nombre_producto',
        'descripccion',
        'precio_unitario',
    ];

    // Relaciones (opcional pero recomendado para el futuro)
    public function impuesto()
    {
        return $this->belongsTo(Impuesto::class);
    }

    public function descuento()
    {
        return $this->belongsTo(Promocion::class, 'descuento_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}