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

    // Puedes definir constantes para los IDs de roles si quieres
    const ROLE_USUARIO = 1; // Asumiendo que 'Usuario' tiene ID 1
    const ROLE_ADMINISTRADOR = 2; // Asumiendo que 'Administrador' tiene ID 2

    const ROLE_SUPER_ADMIN = 3;// Agrega más si tienes otros roles, ej: const ROLE_SUPER_ADMIN = 3;
}
