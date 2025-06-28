<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TipoCliente; // Importa el modelo TipoCliente

class RegisterAdminRequest extends FormRequest
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
            'tipo_usuario' => ['required', 'integer', 'exists:tipos_clientes,id'], // <--- Añade esta regla
            'role' => ['sometimes', 'integer'], // <--- AÑADE ESTA REGLA (puede ser 'sometimes' o 'nullable')
            'is_verified' => ['sometimes', 'boolean'], // <--- AÑADE ESTA REGLA
            // No se pide 'password' aquí, se pedirá después de la verificación del código
        ];
    }

    protected function prepareForValidation()
    {
        // Obtener el ID del rol 'Administrador' de la tabla tipos_clientes
        $adminRole = TipoCliente::where('role', 'Administrador')->first();
        $adminRoleId = $adminRole ? $adminRole->id : TipoCliente::ROLE_ADMINISTRADOR;

        $this->merge([
            'role' => $adminRoleId, // Asigna el ID numérico
            'is_verified' => false, // Los administradores no están verificados inicialmente
        ]);
    }
}