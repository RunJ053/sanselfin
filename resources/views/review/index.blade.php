@extends('layouts.review.resenaLayout')

@section('content')
<x-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <div class="max-w-6xl mx-auto p-6" x-data="{ tab: 'pendientes' }">
        {{-- Header con gradiente --}}
        <div class="text-center mb-8">
            <div class="inline-block">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                    Mis Reseñas
                </h2>
                <div class="h-1 w-24 bg-gradient-to-r from-green-500 to-emerald-500 mx-auto rounded-full"></div>
            </div>
        </div>

        {{-- Mensajes de éxito/error --}}
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('
                success ') }}',
                showConfirmButton: false,
                timer: 3000,
                background: '#f0fdf4',
                color: '#166534'
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('
                error ') }}',
                showConfirmButton: false,
                timer: 3000,
                background: '#fef2f2',
                color: '#dc2626'
            });
        </script>
        @endif

        {{-- Pestañas mejoradas --}}
        <div class="flex justify-center mb-8">
            <div class="bg-white/70 backdrop-blur-sm p-2 rounded-2xl shadow-lg border border-green-200">
                <div class="flex space-x-2">
                    <button class="relative px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105"
                        :class="tab === 'pendientes' ? 
                            'bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg shadow-green-500/30' : 
                            'text-green-700 hover:bg-green-50'"
                        @click="tab = 'pendientes'">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Pendientes</span>
                        </div>
                    </button>
                    <button class="relative px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105"
                        :class="tab === 'realizadas' ? 
                            'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg shadow-emerald-500/30' : 
                            'text-emerald-700 hover:bg-emerald-50'"
                        @click="tab = 'realizadas'">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Mis Reseñas</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        {{-- TAB PENDIENTES --}}
        <div x-show="tab === 'pendientes'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-cloak>

            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-green-800 mb-2">Productos Pendientes por Reseñar</h3>
                <p class="text-green-600">Comparte tu experiencia y ayuda a otros usuarios</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($productosPendientes as $producto)
                <div class="group bg-white/80 backdrop-blur-sm p-6 shadow-xl rounded-2xl border border-green-100 hover:border-green-300 transition-all duration-300 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-1">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-32 h-32 relative overflow-hidden rounded-2xl shadow-lg">
                            <img src="{{ asset('img/product/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre_producto }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-green-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <h4 class="font-bold text-lg text-green-800 text-center">{{ $producto->nombre_producto }}</h4>

                        <form action="{{ route('resenas.store', $producto) }}" method="POST" class="w-full space-y-4">
                            @csrf
                            <input type="hidden" name="calificacion" id="rating-{{ $producto->id }}" value="0">

                            {{-- Estrellas con mejor diseño --}}
                            <div class="flex justify-center">
                                <div class="flex space-x-1 p-3 bg-green-50 rounded-full" data-producto="{{ $producto->id }}">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg data-star="{{ $i }}" xmlns="http://www.w3.org/2000/svg"
                                        class="w-8 h-8 cursor-pointer text-green-200 hover:text-yellow-400 transition-all duration-200 hover:scale-110"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.176 0l-3.39 2.463c-.785.57-1.84-.197-1.54-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.049 9.401c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.974z" />
                                        </svg>
                                        @endfor
                                </div>
                            </div>

                            {{-- Comentario mejorado --}}
                            <div class="space-y-3">
                                <textarea name="comentario" placeholder="Comparte tu experiencia con este producto..."
                                    rows="3"
                                    class="w-full border-2 border-green-200 rounded-xl p-3 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-200 resize-none bg-white/50 backdrop-blur-sm"></textarea>

                                <button class="w-full py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    <span>Enviar Reseña</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mb-6 shadow-xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-green-800 mb-2">¡Felicitaciones! 🎉</h3>
                    <p class="text-green-600 text-lg">Ya reseñaste todos los productos disponibles</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- TAB REALIZADAS --}}
        <div x-show="tab === 'realizadas'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-cloak>

            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-emerald-800 mb-2">Mis Reseñas Realizadas</h3>
                <p class="text-emerald-600">Historial completo de tus opiniones</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @forelse($resenas as $resena)
                <div class="bg-white/80 backdrop-blur-sm p-6 shadow-xl rounded-2xl border border-emerald-100 hover:border-emerald-300 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/10">
                    <div class="flex space-x-4">
                        <div class="w-24 h-24 flex-shrink-0 relative overflow-hidden rounded-xl shadow-md">
                            <img src="{{ asset('img/product/' . $resena->producto->imagen) }}"
                                alt="{{ $resena->producto->nombre_producto }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 space-y-3">
                            <h4 class="font-bold text-lg text-emerald-800">{{ $resena->producto->nombre_producto }}</h4>

                            {{-- Rating con estrellas --}}
                            <div class="flex items-center space-x-2">
                                <div class="flex space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $resena->calificacion ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.176 0l-3.39 2.463c-.785.57-1.84-.197-1.54-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.049 9.401c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.974z" />
                                        </svg>
                                        @endfor
                                </div>
                                <span class="text-sm font-semibold text-emerald-700 bg-emerald-100 px-2 py-1 rounded-full">
                                    {{ $resena->calificacion }}/5
                                </span>
                            </div>

                            @if($resena->comentario)
                            <div class="bg-emerald-50 p-3 rounded-lg border-l-4 border-emerald-500">
                                <p class="text-emerald-800 italic">"{{ $resena->comentario }}"</p>
                            </div>
                            @else
                            <p class="text-gray-500 italic">Sin comentario adicional</p>
                            @endif
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="mt-4 flex justify-end space-x-3">
                        <a href="{{ route('resenas.edit', $resena) }}"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Editar</span>
                        </a>

                        <form action="{{ route('resenas.destroy', $resena) }}" method="POST"
                            onsubmit="return confirmDelete(event)" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Eliminar</span>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16">
                    <div class="w-32 h-32 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center mb-6 shadow-xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-emerald-800 mb-2">Aún no hay reseñas</h3>
                    <p class="text-emerald-600 text-lg mb-4">Comienza a compartir tus opiniones sobre los productos</p>
                    <button @click="tab = 'pendientes'"
                        class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        Ver productos pendientes
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos adicionales para las transiciones */
    [x-cloak] {
        display: none !important;
    }

    /* Animación para las estrellas */
    @keyframes star-pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .star-active {
        animation: star-pulse 0.3s ease-in-out;
    }

    /* Glassmorphism effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
</style>

<script>
    // JavaScript para manejar las estrellas interactivas
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-producto]').forEach(function(container) {
            const productoId = container.getAttribute('data-producto');
            const stars = container.querySelectorAll('svg[data-star]');
            const ratingInput = document.getElementById('rating-' + productoId);

            stars.forEach(function(star, index) {
                star.addEventListener('mouseenter', function() {
                    highlightStars(stars, index + 1);
                });

                star.addEventListener('click', function() {
                    const rating = index + 1;
                    ratingInput.value = rating;
                    setRating(stars, rating);
                    star.classList.add('star-active');
                    setTimeout(() => star.classList.remove('star-active'), 300);
                });
            });

            container.addEventListener('mouseleave', function() {
                const currentRating = parseInt(ratingInput.value);
                setRating(stars, currentRating);
            });
        });

        function highlightStars(stars, rating) {
            stars.forEach(function(star, index) {
                if (index < rating) {
                    star.classList.remove('text-green-200', 'text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-green-200');
                }
            });
        }

        function setRating(stars, rating) {
            stars.forEach(function(star, index) {
                if (index < rating) {
                    star.classList.remove('text-green-200', 'text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-green-200');
                }
            });
        }
    });

    // Función para confirmar eliminación
    function confirmDelete(event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#ffffff',
            backdrop: 'rgba(0, 0, 0, 0.4)'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });

        return false;
    }
</script>
@endsection