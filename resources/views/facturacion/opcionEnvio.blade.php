@extends('layouts.productos.carritoCompras_Layout')

@section('content')
<!-- Contenedor principal -->
<div class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        <!-- Título mejorado -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-green-300 to-yellow-100 rounded-full flex items-center justify-center shadow-lg animate-bounce-soft">
                    <span class="text-2xl">🚚</span>
                </div>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-green-400 to-gray-100 bg-clip-text text-transparent mb-4">
                Selecciona tu Destino
            </h1>
            <p class="text-gray-600 text-lg">Elige a dónde quieres que enviemos tu pedido</p>
            <div class="w-74 h-1 bg-gradient-to-r from-green-300 to-yellow-100 rounded-full mx-auto mt-4"></div>
        </div>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- Lista de destinos de envío -->
            <div class="xl:col-span-2 animate-slide-up">
                <div class="glass-effect shadow-2xl rounded-3xl p-6 border border-white/20">

                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gradient-to-r from-green-400 to-gray-100 rounded-full mr-3 animate-pulse-slow"></div>
                            <h2 class="text-2xl font-bold text-gray-800">Destinos disponibles</h2>
                        </div>
                        <div class="bg-gradient-to-r from-blue-100 to-purple-100 px-4 py-2 rounded-full">
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $destino->count() }}
                            </span>
                        </div>
                    </div>

                    <!-- Formulario de selección -->
                    <form action="{{ route('procesar.entrega') }}" method="POST" id="envioForm">
                        @csrf
                        
                        <!-- Iterar destinos -->
                        @forelse($destino as $desti)
                        <div class="group bg-white rounded-2xl p-6 mb-4 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 cursor-pointer destino-option" data-destino-id="{{ $destino->id }}">
                            <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">

                                <!-- Radio button personalizado -->
                                <div class="flex items-center w-full lg:w-auto">
                                    <div class="relative mr-4">
                                        <input type="radio" 
                                               name="destino_envio" 
                                               value="{{ $destino->id }}" 
                                               id="destino_{{ $destino->id }}" 
                                               class="sr-only destino-radio"
                                               {{ old('destino_envio') == $desti->id ? 'checked' : '' }}>
                                        <div class="w-6 h-6 border-3 border-gray-300 rounded-full flex items-center justify-center radio-custom group-hover:border-blue-400 transition-colors">
                                            <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-0 radio-dot transition-opacity"></div>
                                        </div>
                                    </div>

                                    <!-- Icono de ubicación -->
                                    <div class="w-16 h-16 flex-shrink-0 relative mr-4">
                                        <div class="w-full h-full bg-gradient-to-br from-green-300 to-yellow-100 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                            <span class="text-2xl text-white">📍</span>
                                        </div>
                                    </div>

                                    <!-- Info del destino -->
                                    <div class="flex-1 text-center lg:text-left">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                                            {{ $desti->ciudad }}
                                        </h3>

                                        <div class="space-y-1">
                                            <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                                🏢 Departamento:
                                                <span class="font-semibold text-blue-600 ml-1">
                                                    {{ $desti->departamento }}
                                                </span>
                                            </p>
                                            
                                            @if($desti->tiempo_entrega)
                                            <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                                ⏰ Tiempo de entrega:
                                                <span class="font-semibold text-green-600 ml-1">
                                                    {{ $desti->tiempo_entrega }}
                                                </span>
                                            </p>
                                            @endif

                                            @if($desti->costo && $desti->costo > 0)
                                                <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                                    💰 Costo de envío:
                                                    <span class="font-semibold text-orange-600 ml-1">
                                                        ${{ number_format($desti->costo, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            @else
                                                <p class="flex items-center justify-center lg:justify-start text-green-600">
                                                    ✅ <span class="font-semibold ml-1">Envío gratuito</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Badge de disponibilidad -->
                                <div class="flex flex-col items-center space-y-2">
                                    @if($estado == Activo)
                                        <div class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            ✅ Disponible
                                        </div>
                                    @else
                                        <div class="bg-gradient-to-r from-red-100 to-red-200 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            ❌ No disponible
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <!-- Sin destinos -->
                        <div class="text-center py-16">
                            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                                <span class="text-4xl text-gray-400">📦</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay destinos disponibles</h3>
                            <p class="text-gray-500 mb-6">Por el momento no tenemos destinos de envío configurados</p>
                        </div>
                        @endforelse

                        <!-- Mensaje de error -->
                        @error('destino_envio')
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <span class="text-red-400">⚠️</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- Resumen y confirmación -->
            <div class="animate-slide-up" style="animation-delay: 0.2s;">
                <div class="gradient-border sticky top-8 rounded-3xl p-1">
                    <div class="gradient-border-content p-8">

                        <div class="text-center mb-6">
                            <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-r from-green-300 to-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-white text-xl">📋</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Resumen del Envío</h3>
                            <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mx-auto"></div>
                        </div>

                        <!-- Información seleccionada -->
                        <div id="resumen-envio" class="hidden">
                            <div class="space-y-4 mb-6">
                                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-medium">Destino:</span>
                                        <span class="font-bold text-gray-800" id="destino-seleccionado">-</span>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-medium">Tiempo:</span>
                                        <span class="font-bold text-gray-800" id="tiempo-seleccionado">-</span>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-medium">Costo envío:</span>
                                        <span class="font-bold text-gray-800" id="costo-seleccionado">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mensaje inicial -->
                        <div id="mensaje-inicial" class="text-center py-8">
                            <div class="text-gray-400 mb-4">
                                <span class="text-4xl">🎯</span>
                            </div>
                            <p class="text-gray-600">Selecciona un destino para continuar</p>
                        </div>

                        <hr class="my-6 border-gray-300">

                        <!-- Botón de continuar -->
                        <div class="space-y-4">
                            <button type="submit" form="envioForm" id="btn-continuar" disabled class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl transition-all duration-300 flex items-center justify-center space-x-3 disabled:cursor-not-allowed">
                                <span>Continuar</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                            
                            <!-- Información adicional -->
                            <div class="text-center text-sm text-gray-600">
                                <p class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                    </svg>
                                    Envíos seguros and rastreables
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const destinosOptions = document.querySelectorAll('.destino-option');
    const radios = document.querySelectorAll('.destino-radio');
    const btnContinuar = document.getElementById('btn-continuar');
    const resumenEnvio = document.getElementById('resumen-envio');
    const mensajeInicial = document.getElementById('mensaje-inicial');
    
    // Datos de destinos para JavaScript
    const destinosData = @json($destino->keyBy('id'));
    
    // Manejar click en opciones
    destinosOptions.forEach(option => {
        option.addEventListener('click', function() {
            if (!this.querySelector('.destino-radio').disabled) {
                const radio = this.querySelector('.destino-radio');
                const destinoId = this.dataset.destinoId;
                
                // Limpiar selecciones previas
                destinosOptions.forEach(opt => {
                    opt.classList.remove('ring-2', 'ring-blue-400', 'bg-blue-50');
                    opt.querySelector('.radio-dot').classList.add('opacity-0');
                    opt.querySelector('.radio-custom').classList.remove('border-blue-500');
                });
                
                // Marcar como seleccionado
                radio.checked = true;
                this.classList.add('ring-2', 'ring-blue-400', 'bg-blue-50');
                this.querySelector('.radio-dot').classList.remove('opacity-0');
                this.querySelector('.radio-custom').classList.add('border-blue-500');
                
                // Actualizar resumen
                actualizarResumen(destinoId);
                
                // Habilitar botón
                btnContinuar.disabled = false;
                btnContinuar.className = 'w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-3';
            }
        });
    });
    
    // Manejar cambios de radio directos
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                const destinoId = this.value;
                const option = this.closest('.destino-option');
                
                // Limpiar otras selecciones
                destinosOptions.forEach(opt => {
                    if (opt !== option) {
                        opt.classList.remove('ring-2', 'ring-blue-400', 'bg-blue-50');
                        opt.querySelector('.radio-dot').classList.add('opacity-0');
                        opt.querySelector('.radio-custom').classList.remove('border-blue-500');
                    }
                });
                
                // Marcar como seleccionado
                option.classList.add('ring-2', 'ring-blue-400', 'bg-blue-50');
                option.querySelector('.radio-dot').classList.remove('opacity-0');
                option.querySelector('.radio-custom').classList.add('border-blue-500');
                
                // Actualizar resumen
                actualizarResumen(destinoId);
                
                // Habilitar botón
                btnContinuar.disabled = false;
                btnContinuar.className = 'w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-3';
            }
        });
    });
    
    function actualizarResumen(destinoId) {
        const destino = destinosData[destinoId];
        if (destino) {
            document.getElementById('destino-seleccionado').textContent = `${destino.ciudad}, ${destino.departamento}`;
            document.getElementById('tiempo-seleccionado').textContent = destino.tiempo_entrega || 'No especificado';
            
            const costoTexto = destino.costo_envio && destino.costo_envio > 0 
                ? `$${new Intl.NumberFormat('es-CO').format(destino.costo_envio)}`
                : 'Gratuito';
            document.getElementById('costo-seleccionado').textContent = costoTexto;
            
            // Mostrar resumen
            mensajeInicial.classList.add('hidden');
            resumenEnvio.classList.remove('hidden');
        }
    }
    
    // Verificar si hay una selección previa (old input)
    const selectedRadio = document.querySelector('.destino-radio:checked');
    if (selectedRadio) {
        const option = selectedRadio.closest('.destino-option');
        const destinoId = selectedRadio.value;
        
        option.classList.add('ring-2', 'ring-blue-400', 'bg-blue-50');
        option.querySelector('.radio-dot').classList.remove('opacity-0');
        option.querySelector('.radio-custom').classList.add('border-blue-500');
        
        actualizarResumen(destinoId);
        
        btnContinuar.disabled = false;
        btnContinuar.className = 'w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-3';
    }
});
</script>

<!-- Estilos CSS adicionales -->
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes bounce-soft {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.8s ease-out;
}

.animate-bounce-soft {
    animation: bounce-soft 2s ease-in-out infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 2s ease-in-out infinite;
}

.glass-effect {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.gradient-border {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.gradient-border-content {
    background: white;
    border-radius: 1.25rem;
}

.border-3 {
    border-width: 3px;
}
</style>

@endsection