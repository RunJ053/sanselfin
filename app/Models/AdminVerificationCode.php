<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminVerificationCode extends Model
{
    use HasFactory;

    protected $table = 'admin_verification_codes'; // Asegúrate de que coincida con el nombre de tu tabla
    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
    ];

    // Opcional: Relación con el usuario
    public function user()
    {
        return $this->belongsTo(DatoUsuario::class, 'user_id');
    }
}