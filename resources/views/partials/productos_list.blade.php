{{-- Este parcial recibe $productos, $searchTerm, $currentFilter --}}

@if ($productos->isEmpty())
    <div class="empty-state">
        <i class="{{ $searchTerm ? 'fas fa-search-minus' : ($currentFilter !== 'all' ? 'fas fa-box-open' : 'fas fa-exclamation-circle') }}" style="color: #ccc;"></i>
        <h3>
            @if($searchTerm)
                No hay productos que coincidan con "{{ $searchTerm }}"
            @elseif($currentFilter !== 'all')
                No hay productos en la categoría "{{ $currentFilter }}"
            @else
                No se encontraron productos
            @endif
        </h3>
        <p>Intenta con otros términos de búsqueda o categorías</p>
    </div>
@else
    @foreach ($productos as $product)
        <div class="product" onclick="showProductModal({{ $product['id'] }})">
            @if ($product['descuento'])
                <div class="discount-badge">¡Oferta!</div>
            @endif
            <img class="product-image" src="{{ $product['imagen'] }}" alt="{{ $product['nombre'] }}">
            <div class="product-info">
                <h3 class="product-title">
                    @if ($searchTerm)
                        {{-- Resaltar el término de búsqueda --}}
                        {!! preg_replace("/($searchTerm)/i", '<mark style="background: #ffeb3b; padding: 0 2px; border-radius: 3px;">$1</mark>', $product['nombre']) !!}
                    @else
                        {{ $product['nombre'] }}
                    @endif
                </h3>
                <div class="product-rating">
                    {{ str_repeat('⭐', $product['rating']) }}
                </div>
                <div class="product-price">{{ $product['valor'] }}</div>
            </div>
        </div>
    @endforeach
@endif