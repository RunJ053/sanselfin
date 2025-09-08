@extends('layouts.productosLayout')

@section('content')
<main>
    <x-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
    <aside>
        <div class="filter-title">
            <i class="fas fa-filter"></i>
            Categorías
        </div>
        <ul class="filter-list">
            {{-- Usaremos data-attributes para los enlaces de categoría y los manejaremos con JS --}}
            <li class="filter-item {{ $currentCategory == 'all' ? 'active' : '' }}">
                {{-- Usamos data-category para JS --}}
                <a href="#" data-category="all" class="category-link" style="text-decoration: none; margin-left: 0.5rem; color: inherit; display: flex; align-items: center; width: 100%;">
                    <i class="fas fa-th-large"></i>
                    <span style="margin-left: 1rem;">Todos los productos</span>
                </a>
            </li>
            @foreach ($categoriaId as $cate)
            <li class="filter-item {{ $currentCategory == $cate->nombre ? 'active' : '' }}">
                {{-- Usamos data-category para JS --}}
                <a href="#" data-category="{{ $cate->nombre }}" class="category-link" style="text-decoration: none; margin-left: 1rem; color: inherit; display: flex; align-items: center; width: 100%;">
                    <i class="fas fa-apple-alt"></i>
                    <span style="margin-left: 1rem;">{{ $cate->nombre }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>

    <section class="products-section">
        <div class="section-title">
            <i class="fas fa-store"></i>
            Nuestros Productos
        </div>

        {{-- Formulario para la búsqueda --}}
        {{-- Usaremos JS para el submit --}}
        <form id="searchForm">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchInput" name="search" placeholder="Buscar productos por nombre..." value="{{ $searchTerm }}">
                <button type="button" class="clear-search" id="clearSearch" style="{{ !empty($searchTerm) ? 'display: flex;' : 'display: none;' }}">
                    <i class="fas fa-times"></i>
                </button>
                {{-- Este hidden input es ahora gestionado por JS --}}
                <input type="hidden" name="categoria" id="hiddenCategoryInput" value="{{ $currentCategory }}">
                <button type="submit" style="display: none;"></button>
            </div>
        </form>

        <div class="search-results-info {{ ($searchTerm || $currentCategory !== 'all') && $productos->total() === 0 ? 'no-results' : '' }}" id="searchResultsInfo" style="{{ ($searchTerm || $currentCategory !== 'all') ? 'display: block;' : 'display: none;' }}">
            @if($searchTerm && $currentCategory !== 'all')
            Se encontraron {{ $productos->total() }} producto(s) que contienen "{{ $searchTerm }}" en la categoría "{{ $currentCategory }}"
            @elseif($searchTerm)
            Se encontraron {{ $productos->total() }} producto(s) que contienen "{{ $searchTerm }}"
            @elseif($currentCategory !== 'all')
            Mostrando {{ $productos->total() }} producto(s) de la categoría "{{ $currentCategory }}"
            @else
            Se encontraron {{ $productos->total() }} producto(s) en total.
            @endif
        </div>

        <div class="products_co" id="productsContainer">
            @include('partials.productos_list', ['productos' => $productos->items(), 'searchTerm' => $searchTerm, 'currentFilter' => $currentCategory])
        </div>
        <div class="paginador">
            {{ $productos->links() }}
        </div>
    </section>
</main>
@endsection