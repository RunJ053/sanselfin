<?php

namespace App\Policies;

use App\Models\DatoUsuario as User;
use App\Models\ResenaProducto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResenaProductoPolicy
{
    use HandlesAuthorization;

    public function update(User $user, ResenaProducto $resena)
    {
        return $user->id === $resena->usuario_id;
    }

    public function delete(User $user, ResenaProducto $resena)
    {
        return $user->id === $resena->usuario_id;
    }
}