<div>
    <section class="py-12 bg-gray-50" x-data="{ current: 0, total: {{ count($resenas) }} }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Lo que dicen nuestros clientes</h2>

            <div class="relative overflow-hidden">
                <!-- Contenedor de slides -->
                <div class="flex transition-transform duration-500"
                    :style="`transform: translateX(-${current * 100}%);`">
                    @foreach($resenas as $resena)
                                    <div class="min-w-full px-6">
                                        <div class="bg-white p-6 rounded-2xl shadow-md">
                                            <div class="flex items-center justify-center mb-4">
                                                <img src="{{ asset('img/usuario_img/' . $resena->usuario->user_img) }}" alt="User avatar" class="w-20 h-20 rounded-full mr-3" onerror="this.onerror=null;this.src='{{ asset('img/111.webp') }}';">
                                                <div class="text-left">
                                                    <h4 class="text-lg font-semibold text-gray-700">
                                                        {{ $resena->usuario->nombre ?? 'Usuario Anónimo' }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500">
                                                        <img src="{{ $resena->producto->imagen ? asset('img/product/' . $resena->producto->imagen) : asset('img/111.webp') }}" alt="Imagen del producto" class="w-14 h-14 rounded-full mr-3" onerror="this.onerror=null;this.src='{{ asset('img/111.webp') }}';">
                                                        {{ $resena->producto->nombre_producto?? 'Producto' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <p class="text-gray-600 mb-4 italic">"{{ $resena->comentario }}"</p>

                                            <div class="flex justify-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-5 h-5 {{ $i <= $resena->calificacion ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.175 
                                                                    3.61a1 1 0 00.95.69h3.809c.969 0 
                                                                    1.371 1.24.588 1.81l-3.083 2.24a1 
                                                                    1 0 00-.364 1.118l1.176 3.61c.3.921-.755 
                                                                    1.688-1.54 1.118l-3.084-2.24a1 1 
                                                                    0 00-1.176 0l-3.084 
                                                                    2.24c-.784.57-1.838-.197-1.539-1.118l1.175-3.61a1 1 
                                                                    0 00-.364-1.118L2.528 9.037c-.783-.57-.38-1.81.588-1.81h3.81a1 
                                                                    1 0 00.95-.69l1.174-3.61z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>

                <!-- Botones -->
                <button @click="current = current > 0 ? current - 1 : total - 1"
                    class="absolute top-1/2 left-0 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    ‹
                </button>
                <button @click="current = (current + 1) % total"
                    class="absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    ›
                </button>
            </div>

            <!-- Indicadores -->
            <div class="flex justify-center mt-4 space-x-2">
                <template x-for="(dot, index) in total" :key="index">
                    <button @click="current = index" class="w-3 h-3 rounded-full"
                        :class="index === current ? 'bg-yellow-500' : 'bg-gray-300'"></button>
                </template>
            </div>
        </div>
    </section>
</div>