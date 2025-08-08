<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $table = 'tipos_clientes';
    protected $fillable = [
        'role'
    ];

    // Definir constantes para los IDs de roles
    const ROLE_USUARIO = 1;
    const ROLE_ADMINISTRADOR = 2;

    const ROLE_EMPLEADO = 3;
}
