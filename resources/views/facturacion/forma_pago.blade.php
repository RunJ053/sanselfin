@extends('layouts.facturacion.formaPago')

@section('content')
<main class="container mx-auto py-12 px-4 max-w-6xl">
    @php
    $notificaciones = $notificaciones ?? collect();
    $carritoCount = $carritoCount ?? 0;
    @endphp
    <!-- Resumen con diseño mejorado -->
    <div class="relative mb-12">
        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl blur-xl opacity-20"></div>
        <div class="relative glass-effect backdrop-blur-sm bg-white/90 shadow-2xl rounded-2xl p-8 border border-white/20">
            <div class="flex flex-col lg:flex-row justify-between items-center space-y-6 lg:space-y-0">
                <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start mb-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse mr-3"></div>
                        <h5 class="text-xl font-bold text-gray-800">Total a pagar</h5>
                    </div>
                    <p class="text-gray-600 text-lg">Resumen de tu compra</p>
                    <div class="w-20 h-1 bg-gradient-to-r from-green-500 to-blue-500 rounded-full mt-3 mx-auto lg:mx-0"></div>
                </div>
                <div class="text-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-500 rounded-full blur-md opacity-30 animate-pulse-slow"></div>
                        <div class="relative bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-full shadow-lg">
                            <h3 class="text-3xl font-bold">${{ number_format($totalEnvio, 0, ',', '.') }} COP</h3>
                        </div>
                        <div class="p-4 rounded-lg shadow bg-white">
                            <h2 class="text-lg font-bold">Resumen de la compra</h2>
                            <p><strong>Subtotal: $</strong> {{ number_format($sub, 0, ',', '.') }}</p>
                            <p style="color: red;"><strong>Descuento: - $</strong> {{ number_format($descuento, 0, ',', '.') }}</p>
                            <p>Envío: ${{ number_format($costoEnvio, 0, ',', '.') }}</p>
                            <hr>
                            <hr class="my-2">
                            <p class="font-bold text-xl">Total a pagar: ${{ number_format($totalEnvio, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Encabezado mejorado -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-32 h-32 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full blur-3xl opacity-20 animate-float"></div>
        <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-blue-600 to-green-600 bg-clip-text text-transparent mb-4">
            Selecciona tu método de pago
        </h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Elige entre nuestras opciones de pago
            <span class="font-semibold text-green-600">100% seguro</span>
            y confiable
        </p>
        <div class="flex justify-center mt-6">
            <div class="flex space-x-2">
                <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
            </div>
        </div>
    </div>

    <!-- Opciones de pago mejoradas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">

        <!-- Pago en Efectivo -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">

            <!-- Efecto de brillo -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 via-blue-500 to-purple-500"></div>

            <!-- Contenido -->
            <div class="p-8 text-center relative">
                <!-- Icono de fondo -->
                <div class="absolute top-4 right-4 opacity-10">
                    <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" />
                    </svg>
                </div>

                <!-- Icono principal -->
                <div class="relative">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-green-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce-subtle">
                        <span class="text-xs font-bold text-white">💰</span>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors">
                    Pago en Efectivo
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Paga directamente en nuestros puntos autorizados de manera rápida y segura
                </p>

                <!-- Características -->
                <div class="space-y-2 mb-6">
                    <div class="flex items-center justify-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                        Sin comisiones adicionales
                    </div>
                    <div class="flex items-center justify-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                        Pago inmediato
                    </div>
                </div>

                <!-- Botón -->
                <form id="efectivo-form" action="{{ route('checkout.efectivo') }}" method="GET">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 px-6 rounded-full font-semibold shadow-lg hover:from-emerald-600 hover:to-green-700 transition-all duration-300">
                        Seleccionar
                        <svg class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

            <!-- PayU -->
            <form method="POST" action="{{ route('checkout.payu') }}" class="group relative overflow-hidden bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">

                <!-- Efecto de brillo -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500"></div>

                <!-- Contenido -->
                <div class="p-8 text-center relative">
                    <!-- Icono de fondo -->
                    <div class="absolute top-4 right-4 opacity-10">
                        <svg class="w-24 h-24 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" />
                        </svg>
                    </div>

                    <!-- Icono principal -->
                    <div class="relative">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-400 rounded-full flex items-center justify-center animate-bounce-subtle">
                            <span class="text-xs font-bold text-white">🔒</span>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Pagar con PayU
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Utiliza tu tarjeta de crédito, débito o transferencia bancaria de forma segura
                    </p>

                    <!-- Características -->
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center justify-center text-sm text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                            </svg>
                            Encriptación SSL 256-bit
                        </div>
                        <div class="flex items-center justify-center text-sm text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                            </svg>
                            Múltiples medios de pago
                        </div>
                    </div>

                    <!-- Botón -->
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-full font-semibold group-hover:from-purple-600 group-hover:to-blue-700 transition-all duration-300 shadow-lg">
                        Continuar
                        <svg class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Sección de seguridad -->
        <div class="mt-16 text-center">
            <div class="inline-flex items-center bg-white rounded-full px-6 py-3 shadow-lg">
                <svg class="w-6 h-6 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                </svg>
                <span class="text-gray-700 font-medium">Pagos 100% seguros y protegidos</span>
            </div>
        </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const overlay = document.getElementById("loading-overlay");

        const form = document.getElementById("efectivo-form");

        if (form) {
            form.addEventListener("submit", () => {
                overlay.classList.remove("hidden"); // mostramos overlay
            });
        }
    });
</script>

@endsection