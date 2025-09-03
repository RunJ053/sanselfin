@extends('layouts.review.resenaLayout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 flex items-center justify-center p-6">
    <div class="max-w-lg w-full">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-block">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                    Editar Reseña
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-green-500 to-emerald-500 mx-auto rounded-full"></div>
            </div>
        </div>

        {{-- Formulario principal --}}
        <div class="bg-white/80 backdrop-blur-sm p-8 shadow-2xl rounded-3xl border border-green-100">
            {{-- Información del producto --}}
            <div class="flex items-center space-x-4 mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                <div class="w-16 h-16 relative overflow-hidden rounded-xl shadow-md">
                    <img src="{{ asset('img/product/' . $resena->producto->imagen) }}"
                        alt="{{ $resena->producto->nombre_producto }}"
                        class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-green-800 text-lg">{{ $resena->producto->nombre_producto }}</h3>
                    <p class="text-green-600 text-sm">Editando tu reseña</p>
                </div>
            </div>

            <form action="{{ route('resenas.update', $resena) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Calificación --}}
                <div>
                    <label class="block text-green-800 font-semibold mb-3 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.176 0l-3.39 2.463c-.785.57-1.84-.197-1.54-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.049 9.401c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.974z"></path>
                        </svg>
                        <span>Calificación</span>
                    </label>
                    
                    <input type="hidden" name="calificacion" id="rating-{{ $resena->id }}" value="{{ $resena->calificacion }}">
                    
                    <div class="flex justify-center">
                        <div class="flex space-x-2 p-4 bg-green-50 rounded-2xl border border-green-200" data-resena="{{ $resena->id }}">
                            @for($i = 1; $i <= 5; $i++)
                            <svg data-star="{{ $i }}" xmlns="http://www.w3.org/2000/svg"
                                class="w-10 h-10 cursor-pointer {{ $i <= $resena->calificacion ? 'text-yellow-400' : 'text-green-200' }} hover:text-yellow-400 transition-all duration-200 hover:scale-110"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.176 0l-3.39 2.463c-.785.57-1.84-.197-1.54-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.049 9.401c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.974z" />
                            </svg>
                            @endfor
                        </div>
                    </div>
                    
                    {{-- Texto de rating actual --}}
                    <div class="text-center mt-3">
                        <span id="rating-text" class="text-sm font-medium text-green-700 bg-green-100 px-3 py-1 rounded-full">
                            {{ $resena->calificacion }}/5 estrellas
                        </span>
                    </div>
                </div>

                {{-- Comentario --}}
                <div>
                    <label class="block text-green-800 font-semibold mb-3 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>Comentario</span>
                    </label>
                    <textarea name="comentario" 
                        rows="4" 
                        placeholder="Comparte los detalles de tu experiencia con este producto..."
                        class="w-full border-2 border-green-200 rounded-xl p-4 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-200 resize-none bg-white/50 backdrop-blur-sm">{{ $resena->comentario }}</textarea>
                </div>

                {{-- Botones --}}
                <div class="flex space-x-4 pt-4">
                    <button type="submit" 
                        class="flex-1 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Actualizar Reseña</span>
                    </button>
                    
                    <a href="{{ route('resenas.index') }}" 
                        class="flex-1 py-3 bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Cancelar</span>
                    </a>
                </div>
            </form>

            {{-- Información adicional --}}
            <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                <div class="flex items-center space-x-2 text-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm font-medium">Tu reseña ayuda a otros usuarios a tomar mejores decisiones</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animación para las estrellas */
@keyframes star-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}

.star-active {
    animation: star-pulse 0.3s ease-in-out;
}

/* Glassmorphism effect */
.backdrop-blur-sm {
    backdrop-filter: blur(4px);
}
</style>

{{-- Script mejorado para manejo de estrellas --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.querySelector("[data-resena='{{ $resena->id }}']");
        const stars = container.querySelectorAll("[data-star]");
        const input = document.getElementById("rating-{{ $resena->id }}");
        const ratingText = document.getElementById("rating-text");

        stars.forEach(star => {
            star.addEventListener("mouseover", () => {
                let rating = parseInt(star.getAttribute("data-star"));
                highlightStars(stars, rating);
                updateRatingText(rating);
            });

            star.addEventListener("mouseout", () => {
                let currentRating = parseInt(input.value);
                highlightStars(stars, currentRating);
                updateRatingText(currentRating);
            });

            star.addEventListener("click", () => {
                let rating = parseInt(star.getAttribute("data-star"));
                input.value = rating;
                highlightStars(stars, rating);
                updateRatingText(rating);
                
                // Añadir animación
                star.classList.add('star-active');
                setTimeout(() => star.classList.remove('star-active'), 300);
            });
        });

        // Inicializar con el valor de la reseña
        highlightStars(stars, parseInt(input.value));

        function highlightStars(stars, rating) {
            stars.forEach(star => {
                let value = parseInt(star.getAttribute("data-star"));
                if (value <= rating) {
                    star.classList.remove("text-green-200");
                    star.classList.add("text-yellow-400");
                } else {
                    star.classList.remove("text-yellow-400");
                    star.classList.add("text-green-200");
                }
            });
        }

        function updateRatingText(rating) {
            const texts = {
                1: "1/5 estrellas - Muy malo",
                2: "2/5 estrellas - Malo", 
                3: "3/5 estrellas - Regular",
                4: "4/5 estrellas - Bueno",
                5: "5/5 estrellas - Excelente"
            };
            ratingText.textContent = texts[rating] || `${rating}/5 estrellas`;
        }
    });

    // Validación del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const rating = document.getElementById("rating-{{ $resena->id }}").value;
        if (rating === "0" || rating === "") {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Calificación requerida',
                text: 'Por favor selecciona una calificación antes de continuar',
                confirmButtonColor: '#10b981',
                background: '#f0fdf4',
                color: '#166534'
            });
        }
    });
</script>
@endsection