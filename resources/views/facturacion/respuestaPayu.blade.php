@extends('layouts.facturacion.formaPago')

@section('title', 'Resultado del Pago')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header dinámico según estado -->
        <div class="text-center mb-8">
            @if(request('transactionState') == 4)
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4 animate-pulse">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-green-800 mb-2">¡Pago Exitoso!</h1>
                <p class="text-lg text-gray-600">Tu transacción ha sido procesada correctamente</p>
            @elseif(request('transactionState') == 6)
                <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-red-800 mb-2">Pago Rechazado</h1>
                <p class="text-lg text-gray-600">La transacción no pudo ser procesada</p>
            @elseif(request('transactionState') == 7)
                <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-yellow-800 mb-2">Pago Pendiente</h1>
                <p class="text-lg text-gray-600">Tu transacción está siendo procesada</p>
            @else
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Estado Desconocido</h1>
                <p class="text-lg text-gray-600">Revisa los detalles de tu transacción</p>
            @endif
        </div>

        <!-- Información de la transacción -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Detalles de la Transacción
                </h2>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Información principal -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="font-medium text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Referencia:
                            </span>
                            <span class="text-gray-900 font-mono text-sm bg-gray-100 px-3 py-1 rounded-lg">{{ request('referenceCode') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="font-medium text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Total:
                            </span>
                            <span class="text-2xl font-bold text-indigo-600">${{ number_format(request('TX_VALUE', 0, ',', '.')) }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-3">
                            <span class="font-medium text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Estado:
                            </span>
                            <span class="text-gray-900">{{ request('transactionState') }}</span>
                        </div>
                    </div>

                    <!-- Estado visual -->
                    <div class="flex items-center justify-center">
                        <div class="text-center p-6 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50">
                            @if(request('transactionState') == 4)
                                <div class="text-6xl mb-4">✅</div>
                                <p class="text-xl font-semibold text-green-600 mb-2">Transacción Aprobada</p>
                                <p class="text-sm text-gray-600">El pago se procesó exitosamente</p>
                            @elseif(request('transactionState') == 6)
                                <div class="text-6xl mb-4">❌</div>
                                <p class="text-xl font-semibold text-red-600 mb-2">Transacción Rechazada</p>
                                <p class="text-sm text-gray-600">El pago no pudo ser procesado</p>
                            @elseif(request('transactionState') == 7)
                                <div class="text-6xl mb-4">⏳</div>
                                <p class="text-xl font-semibold text-yellow-600 mb-2">Transacción Pendiente</p>
                                <p class="text-sm text-gray-600">El pago está siendo verificado</p>
                            @else
                                <div class="text-6xl mb-4">❓</div>
                                <p class="text-xl font-semibold text-gray-600 mb-2">Estado Desconocido</p>
                                <p class="text-sm text-gray-600">Contacta con soporte técnico</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional según estado -->
        @if(request('transactionState') == 4)
            <!-- Transacción exitosa -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
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
                                <h4 class="font-semibold text-gray-900">Comprobante Generado</h4>
                                <p class="text-gray-600 text-sm">El comprobante de pago ha sido enviado a tu correo</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-green-600 font-semibold text-sm">2</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Procesamiento del Pedido</h4>
                                <p class="text-gray-600 text-sm">Tu pedido será procesado en las próximas horas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(request('transactionState') == 6)
            <!-- Transacción rechazada -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        ¿Qué puedes hacer?
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 font-semibold text-sm">1</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Verificar Información</h4>
                                <p class="text-gray-600 text-sm">Revisa los datos de tu tarjeta o cuenta bancaria</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 font-semibold text-sm">2</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Intentar Nuevamente</h4>
                                <p class="text-gray-600 text-sm">Puedes volver a intentar el pago con otro método</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(request('transactionState') == 7)
            <!-- Transacción pendiente -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Información Importante
                    </h2>
                </div>
                <div class="p-6">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Transacción en Proceso</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>Tu pago está siendo verificado. Te notificaremos cuando el proceso esté completo. Esto puede tomar unos minutos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Acciones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(request('transactionState') == 4)
                <a href="{{ route('user.dashboard') ?? '/' }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Continuar Comprando
                </a>
                <a href="{{ route('myProfile') ?? '#' }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Mis Pedidos
                </a>
            @elseif(request('transactionState') == 6)
                <a href="javascript:history.back()" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Intentar Nuevamente
                </a>
                <a href="{{ route('user.dashboard') ?? '/' }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al Inicio
                </a>
            @else
                <a href="{{ route('user.dashboard') ?? '/' }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al Inicio
                </a>
            @endif
        </div>

        <!-- Información de contacto -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-blue-800">
                    <strong>¿Necesitas ayuda?</strong> Contacta nuestro soporte técnico
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

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-in;
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
    
    // Animación especial para elementos según estado
    const header = document.querySelector('.text-center');
    if (header) {
        header.classList.add('animate-fade-in');
    }
});
</script>
@endsection