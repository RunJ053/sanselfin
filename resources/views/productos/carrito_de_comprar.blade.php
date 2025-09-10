@extends('layouts.productos.carritoCompras_Layout') {{-- o tu layout principal --}}

@section('content')
<!-- Contenedor principal -->
<div class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        <!-- Título mejorado -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-green-300 to-yellow-100 rounded-full flex items-center justify-center shadow-lg animate-bounce-soft">
                    <span class="text-2xl">🛒</span>
                </div>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-green-400 to-gray-100 to-indigo-600 bg-clip-text text-transparent mb-4">
                Mi Carrito
            </h1>
            <p class="text-gray-600 text-lg">Revisa y confirma tus productos antes de proceder al pago</p>
            <div class="w-74 h-1 bg-gradient-to-r from-green-300 to-yellow-100 rounded-full mx-auto mt-4"></div>
        </div>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- Lista de productos -->
            <div class="xl:col-span-2 animate-slide-up">
                <div class="glass-effect shadow-2xl rounded-3xl p-6 border border-white/20">

                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gradient-to-r from-green-500 to-yellow-500 rounded-full mr-3 animate-pulse-slow"></div>
                            <h2 class="text-2xl font-bold text-gray-800">Productos en tu carrito</h2>
                        </div>
                        <div class="bg-gradient-to-r from-purple-100 to-blue-100 px-5 py-2 rounded-full">
                            <span class="text-sm font-semibold text-gray-900" id="contadorCarrito">
                                {{ $itemsCarrito->sum('cantidad') }} items
                            </span>
                        </div>
                        <form action="{{ route('carrito.vaciar') }}" method="POST" onsubmit="return confirm('¿Seguro que quieres vaciar el carrito?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                Vaciar Carrito
                            </button>
                        </form>
                    </div>

                    <!-- Iterar productos -->
                    @forelse($itemsCarrito as $item)
                    <div class="group bg-white rounded-2xl p-6 mb-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-purple-200">
                        <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">

                            <!-- Imagen -->
                            <div class="w-28 h-28 flex-shrink-0 relative">
                                <img src="{{ asset('img/product/' . $item->producto->imagen) }}"
                                    alt="{{ $item->producto->nombre_producto }}"
                                    class="w-full h-full object-cover rounded-xl shadow-md group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Info -->
                            <div class="flex-1 lg:ml-6 text-center lg:text-left">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">
                                    {{ $item->producto->nombre_producto }}
                                </h3>

                                <div class="space-y-1">
                                    <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                        💲 Precio:
                                        <span class="font-semibold text-green-600 ml-1">
                                            ${{ number_format($item->precio_unitario, 0, ',', '.') }}
                                        </span>
                                    </p>
                                    <p class="flex items-center justify-center lg:justify-start text-gray-600">
                                        📦 Cantidad:
                                        <span class="font-semibold text-blue-700 ml-1">{{ $item->cantidad }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Controles -->
                            <!-- Input cantidad -->
                            <input type="number" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->stock }}"
                                class="cantidad-input w-16 text-center border-3 border-gray-800 rounded-lg" data-id="{{ $item->id }}">
                            <!-- Botón actualizar -->
                            <button type="button"
                                class="btn-update bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md"
                                data-id="{{ $item->id }}">
                                Actualizar
                            </button>

                            <!-- Botón eliminar -->
                            <button type="button"
                                class="btn-remove bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md flex items-center"
                                data-id="{{ $item->id }}">
                                🗑️ Eliminar
                            </button>

                        </div>
                    </div>
                    @empty
                    <!-- Carrito vacío -->
                    <div class="text-center py-16">
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tu carrito está vacío</h3>
                        <p class="text-gray-500 mb-6">¡Agrega algunos productos para comenzar tu compra!</p>
                        <a href="{{ route('producto') }}"
                            class="bg-gradient-to-r from-green-600 to-yellow-200 text-white px-6 py-3 rounded-full font-medium shadow-lg">
                            Explorar Productos
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>


            <!-- Resumen de compra -->
            <div class="animate-slide-up" style="animation-delay: 0.2s;">
                <div class="gradient-border sticky top-8 rounded-3xl p-1">
                    <div class="gradient-border-content p-8">

                        <!-- Subtotal -->
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                            <span class="text-gray-700 font-medium">Subtotal:</span>
                            <span class="font-bold text-gray-800">
                                ${{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Descuento -->
                        <div class="flex justify-between items-center p-4 bg-red-50 rounded-xl">
                            <span class="text-gray-700 font-medium">Descuento:</span>
                            <span class="font-bold text-red-600">
                                - ${{ number_format($descuento, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Total -->
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-4 text-white shadow-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold">Total a pagar:</span>
                                <span class="text-2xl font-bold">
                                    ${{ number_format($totalConDescuento, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-300">
                        <!-- Botón de pago -->
                        @if ($itemsCarrito->count() > 0)
                        <div class="space-y-4">
                            <form action="{{ route('seleccionar_destino') }}" method="GET">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-green-300 to-green-600 text-white py-4 px-6 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-3">
                                    <span>Proceder al Pago</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </button>
                            </form>
                            <!-- Información adicional -->
                            <div class="text-center text-sm text-gray-600">
                                <p class="flex items-center justify-center"> <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                    </svg> Pago 100% seguro y protegido </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection