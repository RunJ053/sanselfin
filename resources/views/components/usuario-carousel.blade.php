<div>
    <section data-aos="fade-up" class="products" aria-labelledby="products-title">
    <div class="container">
        <h2 id="products-title">Nuestra Galería de Productos</h2>
        <p>Descubre nuestra selección de frutas y verduras frescas directamente del campo a tu mesa.</p>
        <p>Explora y descubre cada producto con nuestra galería visual que tenemos solo para ti.</p>

        <div class="carousel-container">
            <!-- Controles del carrusel -->
            <button class="carousel-controls prev" aria-label="Producto anterior">‹</button>
            <button class="carousel-controls next" aria-label="Siguiente producto">›</button>

            <!-- Track del carrusel -->
            <div class="carousel-track">
                @foreach ($productos as $producto)
                    <article class="product-item animate-fade-in-up">
                        <img 
                            src="{{ filter_var($producto->imagen, FILTER_VALIDATE_URL) ? $producto->imagen : asset('img/product/' . $producto->imagen) }}" 
                            alt="{{ $producto->nombre_producto }}" 
                            loading="lazy"
                        >
                        <div class="content">
                            <h3>{{ $producto->nombre_producto }}</h3>
                            <p class="price">${{ number_format($producto->precio_unitario, 0, ',', '.') }}/kg</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Indicadores (puedes implementar dinámicamente con JS si quieres paginación visual) -->
            <div class="carousel-indicators"></div>
        </div>
    </div>
</section>
</div>