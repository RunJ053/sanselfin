<div>
    <section data-aos="fade-up" data-aos-duration="900" class="products" aria-labelledby="products-title">
    <div class="container">
        <h2 id="products-title">Nuestra Galería de Productos</h2>
        <p>Descubre nuestra selección de frutas y verduras frescas directamente del campo a tu mesa.</p>

        <div class="relative">
            <!-- Controles del carrusel -->
            <button id="prevBtn" class="carousel-controls prev">
                <i class="fas fa-chevron-left text-gray-700"></i>
            </button>
            <button id="nextBtn" class="carousel-controls next">
                <i class="fas fa-chevron-right text-gray-700"></i>
            </button>

            <!-- Carrusel dinámico -->
            <div id="carousel" class="carousel-container overflow-x-auto flex space-x-4 py-4 px-2">
                @foreach ($productos as $producto)
                    <article class="product-item animate-fade-in-up">
                        <img src="{{ asset('img/product/' . $producto->imagen) }}" alt="{{ $producto->nombre_producto }}" loading="lazy">
                        <div class="content">
                            <h3>{{ $producto->nombre_producto }}</h3>
                            <p class="price">${{ number_format($producto->precio_unitario, 0, ',', '.') }}/unidad</p>
                            <button onclick="showAlert()" class="add-to-cart">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1"></i>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

</div>