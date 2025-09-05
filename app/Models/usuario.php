<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'datos_usuario';  
    protected $primaryKey = 'id';         
    public $timestamps = true;   // porque tu migración tiene created_at y updated_at

    protected $fillable = [
        'nombre',
        'apellidos',
        'direccion',
        'tipo_docu',
        'tipo_de_genero',
        'documento',
        'edad',
        'telefono',
        'email',
        'localidad',
        'password',
        'user_img',
        'role',
        'is_verified',
        'nom_imgs'
    ];

    // Relación con tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_docu', 'id');
    }

    // Relación con genero
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'tipo_de_genero', 'id');
    }

    // Relación con localidad
    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad', 'id');
    }
}
