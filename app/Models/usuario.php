<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'datos_usuario';  
    protected $primaryKey = 'id';         
    public $timestamps = false;   

    protected $fillable = [
        'identif_us',
        'tipo_docu',
        'nomb_usu',
        'ape_usu',
        'telf_usu',
        'pass_us',
        'direc_us',
        'correo_us',
        'pass_us1'
    ];

    // Relación con la tabla tipo_docu
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocu::class, 'tipo_docu', 'id');
    }
}