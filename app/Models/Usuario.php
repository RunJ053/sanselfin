<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $fillable = [
        'cliente',
        'nombre_usuario',
        'password',
        'user_img'
    ];
    public function cliente()
    {
        return $this->belongsTo(DatoUsuario::class, 'cliente');
    }
}
