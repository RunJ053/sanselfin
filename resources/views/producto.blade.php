<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podructos - La Finca al Día</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/NAV.CSS') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #cfe8a9, #f8f4e3);
            min-height: 100vh;
            color: #333;
        }

        main {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            gap: 2rem;
            padding: 0 1rem;
        }

        aside {
            width: 250px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .filter-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-container {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 1rem;
            background: #f8f9fa;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: #4CAF50;
            background: white;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
        }

        .clear-search {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1.2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .clear-search.visible {
            opacity: 1;
        }

        .clear-search:hover {
            color: #ff4757;
        }

        .search-results-info {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }

        .filter-list {
            list-style: none;
        }

        .filter-item {
            padding: 0.8rem 1rem;
            margin: 0.5rem 0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f8f9fa;
            border: 2px solid transparent;
        }

        .filter-item:hover {
            background: #4CAF50;
            color: white;
            transform: translateX(5px);
        }

        .filter-item.active {
            background: #4CAF50;
            color: white;
            border-color: #45a049;
        }

        .products-section {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .products_co {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 2fr));
            gap: 0.5rem;
        }

        .product {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .product::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product:hover::before {
            transform: scaleX(1);
        }

        .product:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .product:hover .product-image {
            transform: scale(1.05);
        }

        .product-info {
            text-align: center;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .product-rating {
            color: #ffc107;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 0.5rem;
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #ff4757;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            font-size: 1.2rem;
            color: #666;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            main {
                flex-direction: column;
                margin: 1rem auto;
                padding: 0 0.5rem;
            }

            aside {
                width: 100%;
                position: static;
            }

            .header-content {
                padding: 0 1rem;
            }

            .products_co {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }

            .product {
                padding: 1rem;
            }
        }

        /* SweetAlert2 Custom Styles */
        .swal2-popup {
            border-radius: 15px !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }

        .swal2-title {
            color: #333 !important;
        }

        .swal2-confirm {
            background-color: #4CAF50 !important;
            border-radius: 10px !important;
            font-weight: bold !important;
        }

        .swal2-cancel {
            background-color: #ff4757 !important;
            border-radius: 10px !important;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="main-nav" aria-label="Navegación principal">
            <!-- Logo -->
            <div class="nav-left">
                <a href="{{ route('user.dashboard') }}" class="logo-link">
                    <img src="{{asset ('img/logo/icon.png')}}" alt="Logo de La Finca al Día" width="120" height="40">
                </a>
            </div>

            <!-- Enlaces de navegación centrales -->
            <div class="nav-center">
                <ul class="nav-links" role="menubar">
                    <li role="none"><a href="{{ route('user.dashboard') }}" role="menuitem">Inicio</a></li>
                    <li role="none"><a href="{{ route('producto') }}" role="menuitem">Productos</a></li>
                    <li role="none"><a href="{{ route('servicio')}}" role="menuitem">Servicios</a></li>
                    <li role="none"><a href="{{ route('acerca_de')}}" role="menuitem">Acerca de</a></li>
                </ul>
            </div>

            <!-- Acciones de la derecha -->
            <div class="nav-right">
                <ul class="nav-actions" role="menubar">
                    <li role="none">
                        <a href="/notificaciones" role="menuitem" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
                            <span class="visually-hidden">Notificaciones</span>
                        </a>
                    </li>
                    <li role="none">
                        <a href="/carrito" role="menuitem" aria-label="Carrito de Compras">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="visually-hidden">Carrito</span>
                        </a>
                    </li>
                    <li role="none">
                        <a href="/ayuda" role="menuitem" aria-label="Ayuda">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>Ayuda</span>
                        </a>
                    </li>
                </ul>

                <!-- Avatar de usuario -->
                <div class="user-avatar" onclick="toggleDropdown()" role="button" aria-haspopup="true" aria-expanded="false">
                    @auth <!-- Verificamos que el usuario esté autenticado -->
                    @if (Auth::user()->user_img)
                    <img src="{{ asset('img/usuario_img/' . Auth::user()->user_img) }}"
                        alt="Avatar de {{ Auth::user()->nombre }}"
                        class="avatar-image">
                    @else
                    <i class="fas fa-user"></i>
                    @endif
                    @endauth

                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('myProfile') }}" class="dropdown-item">Mi Perfil</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                    </div>
                </div>

                <!-- Botón hamburguesa -->
                <button class="menu-toggle" onclick="toggleMobileMenu()" aria-expanded="false" aria-label="Menú">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>

        <!-- Overlay para móvil -->
        <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

        <!-- Menú móvil -->
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-header">
                <button class="mobile-menu-close" onclick="closeMobileMenu()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Enlaces de navegación móvil -->
            <ul class="mobile-nav-links">
                <li><a href="{{ route('user.dashboard') }}">Inicio</a></li>
                <li><a href="{{ route('producto') }}">Productos</a></li>
                <li><a href="{{ route('servicio')}}">Servicios</a></li>
                <li><a href="{{ route('acerca_de')}}">Acerca de</a></li>
            </ul>

            <!-- Acciones móvil -->
            <ul class="mobile-nav-actions">
                <li>
                    <a href="/notificaciones">
                        <i class="fas fa-bell"></i>
                        <span>Notificaciones</span>
                    </a>
                </li>
                <li>
                    <a href="/carrito">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carrito de Compras</span>
                    </a>
                </li>
                <li>
                    <a href="/ayuda">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Necesito Ayuda</span>
                    </a>
                </li>
                <li>
                    <a href="/perfil">
                        <i class="fas fa-user"></i>
                        <span>Mi Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <aside>
            <div class="filter-title">
                <i class="fas fa-filter"></i>
                Categorías
            </div>
            <ul class="filter-list">
                {{-- Usamos href para las categorías para que sean enlaces reales --}}
                <li class="filter-item {{ $currentCategory == 'all' ? 'active' : '' }}">
                    <a href="{{ route('producto', ['search' => $searchTerm]) }}" data-category="all" style="text-decoration: none; color: inherit; display: flex; align-items: center; width: 100%;">
                        <i class="fas fa-th-large"></i>
                        Todos los productos
                    </a>
                </li>
                @foreach ($categoriaId as $cate)
                <li class="filter-item {{ $currentCategory == $cate->nombre ? 'active' : '' }}">
                    <a href="{{ route('producto', ['categoria' => $cate->nombre, 'search' => $searchTerm]) }}" data-category="{{ $cate->nombre }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; width: 100%;">
                        <i class="fas fa-apple-alt"></i> {{-- Icono genérico, puedes ajustarlo por categoría si tienes un campo para ello --}}
                        <span>{{ $cate->nombre }}</span>
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
            <form action="{{ route('producto') }}" method="GET" id="searchForm">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" name="search" placeholder="Buscar productos por nombre..." value="{{ $searchTerm }}">
                    <button type="button" class="clear-search" id="clearSearch" style="{{ !empty($searchTerm) ? 'display: flex;' : 'display: none;' }}">
                        <i class="fas fa-times"></i>
                    </button>
                    {{-- Campo oculto para mantener la categoría seleccionada al buscar --}}
                    <input type="hidden" name="categoria" id="hiddenCategoryInput" value="{{ $currentCategory }}">
                    <button type="submit" style="display: none;"></button> {{-- Botón de submit oculto para que el Enter funcione --}}
                </div>
            </form>

            <div class="search-results-info {{ ($searchTerm || $currentCategory !== 'all') && $productos->count() === 0 ? 'no-results' : '' }}" id="searchResultsInfo" style="{{ ($searchTerm || $currentCategory !== 'all') ? 'display: block;' : 'display: none;' }}">
                @if($searchTerm && $currentCategory !== 'all')
                Se encontraron {{ $productos->count() }} producto(s) que contienen "{{ $searchTerm }}" en la categoría "{{ $currentCategory }}"
                @elseif($searchTerm)
                Se encontraron {{ $productos->count() }} producto(s) que contienen "{{ $searchTerm }}"
                @elseif($currentCategory !== 'all')
                Mostrando {{ $productos->count() }} producto(s) de la categoría "{{ $currentCategory }}"
                @endif
            </div>

            {{-- Aquí se cargarán los productos --}}
            <div class="products_co" id="productsContainer">
                @include('partials.productos_list', ['productos' => $productos, 'searchTerm' => $searchTerm, 'currentFilter' => $currentCategory])
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');
        const hiddenCategoryInput = document.getElementById('hiddenCategoryInput');
        const searchResultsInfo = document.getElementById('searchResultsInfo');

        // ... Tu lógica existente para búsqueda y filtros ...

        // Mantiene el botón de limpiar visible si hay término de búsqueda inicial
        if (searchInput.value.trim() !== '') {
            clearSearch.classList.add('visible');
        }

        searchInput.addEventListener('input', (e) => {
            if (e.target.value.trim()) {
                clearSearch.classList.add('visible');
            } else {
                clearSearch.classList.remove('visible');
            }
        });

        clearSearch.addEventListener('click', () => {
            searchInput.value = '';
            clearSearch.classList.remove('visible');
            document.getElementById('searchForm').submit();
            searchInput.focus();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchInput.value.trim()) {
                searchInput.value = '';
                clearSearch.classList.remove('visible');
                document.getElementById('searchForm').submit();
            }
        });

        document.querySelectorAll('.filter-item a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                hiddenCategoryInput.value = e.currentTarget.dataset.category;
                document.querySelectorAll('.filter-item').forEach(f => f.classList.remove('active'));
                e.currentTarget.closest('.filter-item').classList.add('active');
                document.getElementById('searchForm').submit();
            });
        });

        // --- Funciones del Carrito ---

        /**
         * Abre el modal de SweetAlert2 con los detalles del producto y la opción de cantidad.
         * @param {number} productId - El ID del producto.
         */
        async function showProductModal(productId) {
            try {
                const response = await fetch(`/productos/${productId}/details`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const product = await response.json(); // Asume que la ruta devuelve JSON

                Swal.fire({
                    title: product.nombre,
                    html: `
                    <div style="text-align: left; margin: 1rem 0;">
                        <img src="${product.imagen || 'ruta/a/imagen/por/defecto.jpg'}" alt="${product.nombre}"
                            style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <p style="color: #666; margin-bottom: 0.5rem;">${product.descripcion || 'Sin descripción.'}</p>
                        <div style="color: #ffc107; margin-bottom: 0.5rem;">${'⭐'.repeat(product.rating || 0)}</div>
                        <h4 style="color: #4CAF50; font-size: 1.2rem; margin-bottom: 1rem;">$${parseFloat(product.valor).toFixed(2)}</h4>
                        <div style="margin-bottom: 1rem;">
                            <label for="quantity" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Cantidad:</label>
                            <input type="number" id="quantity" min="1" value="1"
                                    style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        </div>
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-cart-plus"></i> Añadir al carrito',
                    cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                    focusConfirm: false, // Evita que se auto-enfoque en el botón y se cierre con Enter
                    didOpen: () => {
                        // Asegurarse de que el input de cantidad esté enfocado para el usuario
                        document.getElementById('quantity').focus();
                    },
                    preConfirm: () => {
                        const quantity = document.getElementById('quantity').value;
                        if (!quantity || parseInt(quantity) < 1) {
                            Swal.showValidationMessage('Por favor, introduce una cantidad válida');
                            return false;
                        }
                        return parseInt(quantity);
                    }
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await addToCart(product.id, result.value);
                    }
                });
            } catch (error) {
                console.error('Error al cargar detalles del producto:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No pudimos cargar los detalles del producto.',
                });
            }
        }

        /**
         * Envía una solicitud AJAX para añadir un producto al carrito.
         * @param {number} productId - El ID del producto.
         * @param {number} quantity - La cantidad a añadir.
         */
        async function addToCart(productId, quantity) {
            try {
                const response = await fetch('{{ route("api.carrito.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        producto_id: productId,
                        cantidad: quantity
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Error al añadir el producto al carrito.');
                }

                // Actualizar el contador del carrito en la barra de navegación
                updateCartCount(data.cart_count);

                Swal.fire({
                    title: '¡Producto añadido!',
                    text: `${quantity} unidad(es) añadida(s) al carrito`,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-shopping-cart"></i> Ver carrito',
                    cancelButtonText: '<i class="fas fa-shopping-bag"></i> Seguir comprando',
                    timer: 3000,
                    timerProgressBar: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("carrito.index") }}'; // Redirige a la vista del carrito
                    }
                    // Si el usuario hace clic en "Seguir comprando" o el timer termina, el modal se cierra
                });

            } catch (error) {
                console.error('Error al añadir al carrito:', error);
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'No se pudo añadir el producto al carrito.',
                    icon: 'error',
                });
            }
        }

        /**
         * Actualiza el contador visible del carrito en la interfaz.
         * @param {number} count - El número total de ítems en el carrito.
         */
        function updateCartCount(count) {
            const cartCountElement = document.querySelector('.nav-actions a[href="/carrito"] .cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = count;
            }
        }

        // Al cargar la página, obtener el conteo actual del carrito para que se muestre correctamente
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch('{{ route("api.carrito.count") }}');
                if (response.ok) {
                    const data = await response.json();
                    updateCartCount(data.cart_count);
                }
            } catch (error) {
                console.error('Error al obtener el conteo del carrito:', error);
            }
        });
    </script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>

</body>

</html>