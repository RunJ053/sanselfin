<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    protected $table = 'formas_pagos';
    protected $fillable = [
        'estado_id',
        'nombre_forma_pago',
        'descripcion_pago'
    ];
    public $timestamps = true;

    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}

