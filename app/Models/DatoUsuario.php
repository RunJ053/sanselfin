<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoUsuario extends Model
{
    use HasFactory;
    protected $table = 'datos_usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellidos',
        'segundo_nombre',
        'direccion',
        'pregunta_seguridad',
        'respuesta_seguridad',
        'tipo_docu',
        'tipo_client',
        'tipo_de_genero',
        'documento',
        'edad',
        'telefono',
        'email',
        'localidad',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $guarded = [];
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
