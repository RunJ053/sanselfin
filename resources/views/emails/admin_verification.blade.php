{{-- Este es un ejemplo de plantilla de correo para la verificación de registro de administrador --}}
@component('mail::message')
# Verificación de Registro de Administrador

Hola {{ $userName }},

Un nuevo registro para administrador ha sido iniciado con tu correo electrónico.
Para completar el registro y confirmar que eres un administrador autorizado, por favor usa el siguiente código de verificación:

## {{ $code }}

Este código expirará en 30 minutos.

Si tú no solicitaste este registro, por favor ignora este correo.

Gracias,
{{ config('app.name') }}
@endcomponent
