<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVerificationCode extends Model
{
    use HasFactory;

    protected $table = 'user_verification_codes'; // Asegúrate de que coincida con el nombre de tu tabla
    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    /**
     * Define la relación con el usuario.
     * Un código de verificación pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(DatoUsuario::class, 'user_id');
    }
}
