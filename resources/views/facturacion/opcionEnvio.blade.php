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
                    <form id="envioForm" action="{{ route('procesar.entrega') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">
                        <input type="hidden" name="order_total" id="order_total_input" value="{{ $total ?? 0 }}">
                        <!-- Dirección del usuario autenticado -->
                        @if($direccionUsuario)
                        <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                            <p class="text-gray-700">
                                📍 <span class="font-semibold">Tu dirección registrada:</span>
                                {{ $direccionUsuario }}
                            </p>
                        </div>
                        @endif
                        <!-- Iterar destinos -->
                        @forelse($destino as $desti)
                        <div class="group bg-white rounded-2xl p-6 mb-4 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 cursor-pointer destino-option"
                            data-destino-id="{{ $desti->id }}"
                            data-nombre="{{ $desti->nombre_opcion }}"
                            data-descripcion="{{ $desti->descripcion }}"
                            data-tiempo="{{ $desti->tiempo_entrega ?? '' }}"
                            data-costo="{{ $desti->costo ?? 0 }}"
                            data-ciudad="{{ $desti->ciudad ?? '' }}"
                            data-departamento="{{ $desti->departamento ?? '' }}">

                            <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                                <!-- Radio + Contenido -->
                                <div class="flex items-center w-full lg:w-auto">

                                    <!-- Radio oculto real -->
                                    <input type="radio"
                                        name="destino_envio"
                                        value="{{ $desti->id }}"
                                        class="destino-radio hidden"
                                        id="destino-{{ $desti->id }}">

                                    <!-- Radio visual -->
                                    <label for="destino-{{ $desti->id }}" class="relative mr-4 cursor-pointer flex items-center">
                                        <div class="w-6 h-6 border-3 border-gray-300 rounded-full flex items-center justify-center radio-custom group-hover:border-blue-400 transition-colors">
                                            <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-0 radio-dot transition-opacity"></div>
                                        </div>
                                    </label>

                                    <!-- Icono -->
                                    <div class="w-16 h-16 flex-shrink-0 relative mr-4">
                                        <div class="w-full h-full bg-gradient-to-br from-green-300 to-yellow-100 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                            <span class="text-2xl text-white">📍</span>
                                        </div>
                                    </div>

                                    <!-- Info del destino -->
                                    <div class="flex-1 text-center lg:text-left">
                                        <div class="space-y-1">
                                            <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                                📦 Opción:
                                                <span class="font-semibold text-blue-600 ml-1">{{ $desti->nombre_opcion }}</span>
                                            </p>
                                            <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                                ℹ️ Descripción:
                                                <span class="font-semibold text-red-600 ml-1">{{ $desti->descripcion }}</span>
                                            </p>

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

                                <!-- Badge disponibilidad -->
                                <div class="flex flex-col items-center space-y-2">
                                    @if($desti->estado && $desti->estado->desc_estado == 'Activo')
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
                        <form action="{{ route('procesar.entrega') }}" method="POST">
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

                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700 font-medium">Total:</span>
                                            <span class="font-bold text-gray-800" id="total-resumen">-</span>
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
                                <button type="submit" id="btn-continuar" disabled class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl transition-all duration-300 flex items-center justify-center space-x-3 disabled:cursor-not-allowed">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Totales base que vienen del backend (JSON seguro)
    const baseTotal = Number(@json($total ?? 0)); // <-- asegura que sea número
    const currency = new Intl.NumberFormat('es-CO');

    document.addEventListener('DOMContentLoaded', function() {
        const destinosOptions = document.querySelectorAll('.destino-option');
        const radios = document.querySelectorAll('.destino-radio');
        const btnContinuar = document.getElementById('btn-continuar');
        const resumenEnvio = document.getElementById('resumen-envio');
        const mensajeInicial = document.getElementById('mensaje-inicial');
        const envioForm = document.getElementById('envioForm');

        // Inputs ocultos (pueden no existir si no los agregaste)
        const shippingInput = document.getElementById('shipping_cost_input');
        const orderTotalInput = document.getElementById('order_total_input');

        // Click sobre la tarjeta selecciona el radio asociado y dispara change
        destinosOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                // Si el click fue directamente sobre el input (raramente, porque está hidden) evitamos doble manejo
                if (e.target.classList && e.target.classList.contains('destino-radio')) return;

                const radio = this.querySelector('.destino-radio');
                if (!radio || radio.disabled) return;

                radio.checked = true;
                // Disparar evento change para que el listener asociado se ejecute
                radio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            });
        });

        // Listener en los radios (se ejecuta también si disparamos change manualmente)
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (!this.checked) return;
                const option = this.closest('.destino-option');
                if (!option) return;
                seleccionarTarjeta(option);
                actualizarResumen(option.dataset.destinoId);
            });
        });

        function seleccionarTarjeta(optionSeleccionada) {
            // Limpia estilos previos
            document.querySelectorAll('.destino-option').forEach(opt => {
                opt.classList.remove('ring-2', 'ring-blue-400', 'bg-blue-50');
                const dot = opt.querySelector('.radio-dot');
                const custom = opt.querySelector('.radio-custom');
                if (dot) dot.classList.add('opacity-0');
                if (custom) custom.classList.remove('border-blue-500');
            });

            // Marca seleccionada (visual)
            optionSeleccionada.classList.add('ring-2', 'ring-blue-400', 'bg-blue-50');
            const dotSel = optionSeleccionada.querySelector('.radio-dot');
            const customSel = optionSeleccionada.querySelector('.radio-custom');
            if (dotSel) dotSel.classList.remove('opacity-0');
            if (customSel) customSel.classList.add('border-blue-500');

            // Habilita botón
            if (btnContinuar) {
                btnContinuar.disabled = false;
                btnContinuar.className = 'w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-3';
            }
        }

        function actualizarResumen(destinoId) {
            const option = document.querySelector(`.destino-option[data-destino-id="${destinoId}"]`);
            if (!option) return;

            const ciudad = (option.dataset.ciudad || '').trim();
            const departamento = (option.dataset.departamento || '').trim();
            const nombre = (option.dataset.nombre || '').trim();

            let destinoTexto = nombre || '-';
            if (ciudad || departamento) destinoTexto = [ciudad, departamento].filter(Boolean).join(', ');

            const tiempo = (option.dataset.tiempo || '').trim() || 'No especificado';
            const costoEnvio = Number(option.dataset.costo || 0);

            // Pintar resumen (si existen los elementos)
            const elDestino = document.getElementById('destino-seleccionado');
            const elTiempo = document.getElementById('tiempo-seleccionado');
            const elCosto = document.getElementById('costo-seleccionado');
            const elTotal = document.getElementById('total-resumen');

            if (elDestino) elDestino.textContent = destinoTexto;
            if (elTiempo) elTiempo.textContent = tiempo;
            if (elCosto) elCosto.textContent = (costoEnvio > 0) ? `$${currency.format(costoEnvio)}` : 'Gratuito';
            if (elTotal) elTotal.textContent = `$${currency.format(baseTotal + costoEnvio)}`;

            // Mostrar bloque de resumen
            if (mensajeInicial) mensajeInicial.classList.add('hidden');
            if (resumenEnvio) resumenEnvio.classList.remove('hidden');

            // Pasar valores al backend (solo si los inputs existen)
            if (shippingInput) shippingInput.value = costoEnvio;
            if (orderTotalInput) orderTotalInput.value = baseTotal + costoEnvio;
        }

        // Si venimos de un old() marcado (preselección)
        const selectedRadio = document.querySelector('.destino-radio:checked');
        if (selectedRadio) {
            selectedRadio.dispatchEvent(new Event('change', {
                bubbles: true
            }));
        }

        // Validación al enviar: debe ir seleccionado algo
        if (envioForm) {
            envioForm.addEventListener('submit', function(e) {
                const checked = document.querySelector('.destino-radio:checked');
                if (!checked) {
                    e.preventDefault();
                    alert('Por favor selecciona una opción de envío.');
                }
            });
        }
    });
</script>


<!-- Estilos CSS adicionales -->
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce-soft {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
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