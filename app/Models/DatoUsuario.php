<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // Importa el trait
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'tipo_docu',
        'tipo_de_genero',
        'documento',
        'edad',
        'telefono',
        'email',
        'localidad',
        'nom_imgs',
        'password',
        'user_img',
        'role',
        'is_verified',
    ];
    protected $hidden = [
        'password',
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
    public function datoslocalidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad');
    }

    /**
     * Define la relación con el código de verificación.
     * Un usuario tiene un código de verificación (o puede tener uno).
     */
    public function verificationCode(): HasOne
    {
        return $this->hasOne(UserVerificationCode::class, 'user_id');
    }
}
