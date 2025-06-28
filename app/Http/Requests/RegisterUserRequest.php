<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TipoCliente; // Importa el modelo TipoCliente

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:datos_usuario,email'],
            'fecha_nac' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo_usuario' => ['required', 'integer', 'exists:tipos_clientes,id'], // <--- Añade esta regla
            'role' => ['sometimes', 'integer'], // <--- AÑADE ESTA REGLA (puede ser 'sometimes' o 'nullable')
            'is_verified' => ['sometimes', 'boolean'], // <--- AÑADE ESTA REGLA
        ];
    }

    protected function prepareForValidation()
    {
        // Obtener el ID del rol 'Usuario' de la tabla tipos_clientes
        $userRole = TipoCliente::where('role', 'Usuario')->first();
        $userRoleId = $userRole ? $userRole->id : TipoCliente::ROLE_USUARIO;

        $this->merge([
            'role' => $userRoleId, // Asigna el ID numérico
            'is_verified' => true, // Los usuarios normales se verifican automáticamente
        ]);
    }
}