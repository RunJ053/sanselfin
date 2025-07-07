<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    public $timestamps = false; // porque usas 'fecha_creacion' en lugar de created_at

    protected $fillable = ['titulo', 'descripcion', 'tipo', 'fecha_creacion'];
}