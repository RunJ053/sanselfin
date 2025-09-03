<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResenaProducto extends Model
{
    use HasFactory;

    protected $table = 'resenas_productos';

    protected $fillable = [
        'usuario_id',
        'producto_id',
        'calificacion',
        'comentario'
    ];

    public function usuario()
    {
        return $this->belongsTo(DatoUsuario::class, 'usuario_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    
}