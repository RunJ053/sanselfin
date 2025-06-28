<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; // Importa la interfaz
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // Importa el trait

class DatoUsuario extends Model implements Authenticatable // Implementa la interfaz
{
    use HasFactory, AuthenticatableTrait; // Usa el trait

    use HasFactory;
    protected $table = 'datos_usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellidos',
        'direccion',
        'pregunta_seguridad',
        'respuesta_seguridad',
        'tipo_docu',
        'tipo_de_genero',
        'documento',
        'edad',
        'telefono',
        'email',
        'localidad',
        'nom_imgs',
        //'nombre_usuario',
        'password',
        'user_img',
        'role', // Añadir esto
        'is_verified', // Añadir esto
    ];
    protected $hidden = [
        'password', // Ocultar la contraseña al serializar
        'created_at',
        'updated_at',
    ];
    //protected $guarded = [];
    public $timestamps = true;

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_docu');
    }
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_client');
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'tipo_de_genero');
    }
    public function seguridad()
    {
        return $this->belongsTo(Seguridad::class, 'pregunta_seguridad');
    }
}
