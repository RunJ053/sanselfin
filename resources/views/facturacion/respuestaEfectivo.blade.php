@extends('layouts.facturacion.formaPago')

@section('title', 'Pedido Confirmado')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header de confirmación -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4 animate-pulse">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">¡Pedido Confirmado!</h1>
            <p class="text-lg text-gray-600">Tu pedido ha sido registrado exitosamente</p>
        </div>

        <!-- Información del pedido -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Detalles del Pedido
                </h2>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información básica -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Fecha:</span>
                            <span class="text-gray-900">{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Método de Pago:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Pago en Efectivo
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-700">Estado:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse"></div>
                                En Proceso
                            </span>
                        </div>
                    </div>

                    <!-- Resumen de costos -->
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                        <h3 class="font-semibold text-gray-900 mb-3">Resumen de Costos</h3>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="text-gray-900">${{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Envío:</span>
                            <span class="text-gray-900">${{ number_format($costoEnvio ?? 0, 2) }}</span>
                        </div>
                        @if(($descuento ?? 0) > 0)
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Descuento:</span>
                            <span>-${{ number_format($descuento, 2) }}</span>
                        </div>
                        @endif
                        <hr class="border-gray-200">
                        <div class="flex justify-between font-semibold text-lg">
                            <span class="text-gray-900">Total:</span>
                            <span class="text-green-600">${{ number_format($total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de entrega -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Información de Entrega
                </h2>
            </div>

            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l5 5 5-5"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 mb-2">Dirección de Envío</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $direccionEnvio ?? 'Dirección no disponible' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximos pasos -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Próximos Pasos
                </h2>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 font-semibold text-sm">1</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Factura Enviada</h4>
                            <p class="text-gray-600 text-sm">Hemos enviado la factura a tu correo electrónico</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-yellow-600 font-semibold text-sm">2</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Preparación del Pedido</h4>
                            <p class="text-gray-600 text-sm">Nuestro equipo comenzará a preparar tu pedido</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-sm">3</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Pago al Recibir</h4>
                            <p class="text-gray-600 text-sm">Prepara el monto exacto: ${{ number_format($total ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('notificaciones.index') }}"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 01-7.5-7.5 7.5 7.5 0 0115 0c0 4.142-3.358 7.5-7.5 7.5v5z"></path>
                </svg>
                Ver Notificaciones
            </a>

            <a href="{{ route('myProfile') ?? '#' }}"
                class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Mis Pedidos
            </a>

            <a href="{{ route('producto') ?? '/' }}"
                class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Continuar Comprando
            </a>
        </div>

        <!-- Información adicional -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-yellow-800">
                    <strong>Importante:</strong> Guarda el número de pedido para futuras consultas
                </span>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in-up {
        animation: slideInUp 0.6s ease-out;
    }
</style>

<script>
    // Agregar animación a los elementos cuando se carga la página
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.bg-white');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
            element.classList.add('animate-slide-in-up');
        });
    });
</script>
@endsection