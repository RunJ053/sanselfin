<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventarios';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id',
        'nombre_producto',
        'descripcion',
        'stock',
    ];
    public $timestamps = true;
    public function productoIventario()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
