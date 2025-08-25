{{-- Este parcial recibe $productos, que es una colección simple de ítems, no el paginador --}}
@if (count($productos) === 0) 
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
{{-- Si hay productos, entonces itera sobre ellos --}}
@foreach ($productos as $product)
<div class="product" onclick="showProductModal({{ $product['id'] }})">
    @if ($product['descuento']) {{-- Asegúrate de que la clave 'descuento' existe y es booleana --}}
    <div class="discount-badge">¡Oferta!</div>
    @endif
    <img src="{{ $product['imagen'] }}" alt="{{ $product['nombre'] }}" width="55%" height="43%" style="object-fit:cover; border-radius:6px;">

    <div class="product-info">
        @php $quoted = $searchTerm ? preg_quote($searchTerm, '/') : null; @endphp
            <h3 class="product-title">
                @if ($searchTerm)
                    {!! preg_replace("/($quoted)/i", '<mark style="background:#ffeb3b;padding:0 2px;border-radius:3px;">$1</mark>', e($product['nombre'])) !!}
                @else
                    {{ $product['nombre'] }}
                @endif
            </h3>
        <div class="product-rating">
            {{ str_repeat('⭐', $product['rating']) }}
        </div>
        {{-- Aquí añades el '$' de nuevo si lo quitaste en el backend --}}
        <div class="product-price">${{ $product['valor'] }}</div>
    </div>
</div>
@endforeach
@endif