<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podructos - La Finca al Día</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/NAV.CSS') }}">

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
                <li class="filter-item active" data-category="all">
                    <i class="fas fa-th-large"></i>
                    Todos los productos
                </li>
                <li class="filter-item" data-category="Frutas">
                    <i class="fas fa-apple-alt"></i>
                    Frutas
                </li>
                <li class="filter-item" data-category="Verduras">
                    <i class="fas fa-carrot"></i>
                    Verduras
                </li>
                <li class="filter-item" data-category="Hortaliza">
                    <i class="fas fa-seedling"></i>
                    Hortaliza
                </li>
                <li class="filter-item" data-category="Legumbres">
                    <i class="fas fa-pepper-hot"></i>
                    Legumbres
                </li>
            </ul>
        </aside>

        <section class="products-section">
            <div class="section-title">
                <i class="fas fa-store"></i>
                Nuestros Productos
            </div>

            <!-- Barra de búsqueda -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text"
                    class="search-input"
                    id="searchInput"
                    placeholder="Buscar productos por nombre...">
                <button class="clear-search" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Información de resultados -->
            <div class="search-results-info" id="searchResultsInfo" style="display: none;"></div>

            <div class="products_co" id="productsContainer">
                <div class="loading">
                    <div class="spinner"></div>
                    Cargando productos...
                </div>
            </div>
        </section>
    </main>

    <script>
        // Simulación de datos de productos
        const productos = [{
                nombre: "Manzana",
                descripcion: "Manzanas frescas y jugosas, perfectas para cualquier ocasión",
                valor: "$4.000",
                imagen: "https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=400&h=300&fit=crop",
                categoria: "Frutas",
                rating: 4,
                descuento: false
            },
            {
                nombre: "Zanahoria",
                descripcion: "Zanahorias orgánicas llenas de vitaminas y sabor",
                valor: "$3.500",
                imagen: "https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=400&h=300&fit=crop",
                categoria: "Verduras",
                rating: 4,
                descuento: true
            },
            {
                nombre: "Naranja",
                descripcion: "Naranjas dulces y cítricas, ricas en vitamina C",
                valor: "$5.300",
                imagen: "https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=400&h=300&fit=crop",
                categoria: "Frutas",
                rating: 3,
                descuento: true
            },
            {
                nombre: "Arracacha",
                descripcion: "Arracacha fresca, ideal para sopas y guisos tradicionales",
                valor: "$2.800",
                imagen: "https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=400&h=300&fit=crop",
                categoria: "Hortaliza",
                rating: 4,
                descuento: false
            },
            {
                nombre: "Lechuga",
                descripcion: "Lechuga fresca y crujiente, perfecta para ensaladas",
                valor: "$5.800",
                imagen: "https://images.unsplash.com/photo-1622206151226-18ca2c9ab4a1?w=400&h=300&fit=crop",
                categoria: "Verduras",
                rating: 5,
                descuento: false
            },
            {
                nombre: "Tomate",
                descripcion: "Tomates rojos y maduros, llenos de sabor",
                valor: "$3.200",
                imagen: "https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=400&h=300&fit=crop",
                categoria: "Verduras",
                rating: 4,
                descuento: true
            }
        ];

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentFilter = 'all';
        let searchTerm = '';
        let allProducts = [];

        // Inicializar la aplicación
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
            loadProducts();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Event listeners para filtros
            document.querySelectorAll('.filter-item').forEach(item => {
                item.addEventListener('click', (e) => {
                    document.querySelectorAll('.filter-item').forEach(f => f.classList.remove('active'));
                    e.target.classList.add('active');
                    currentFilter = e.target.dataset.category;
                    applyFiltersAndSearch();
                });
            });

            // Event listeners para búsqueda
            const searchInput = document.getElementById('searchInput');
            const clearSearch = document.getElementById('clearSearch');

            searchInput.addEventListener('input', (e) => {
                searchTerm = e.target.value.toLowerCase().trim();

                // Mostrar/ocultar botón de limpiar
                if (searchTerm) {
                    clearSearch.classList.add('visible');
                } else {
                    clearSearch.classList.remove('visible');
                }

                applyFiltersAndSearch();
            });

            clearSearch.addEventListener('click', () => {
                searchInput.value = '';
                searchTerm = '';
                clearSearch.classList.remove('visible');
                applyFiltersAndSearch();
                searchInput.focus();
            });

            // Limpiar búsqueda con ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && searchTerm) {
                    searchInput.value = '';
                    searchTerm = '';
                    clearSearch.classList.remove('visible');
                    applyFiltersAndSearch();
                }
            });
        }

        function loadProducts() {
            setTimeout(() => {
                allProducts = [...productos]; // Guardar copia de todos los productos
                applyFiltersAndSearch();
            }, 1000); // Simular carga
        }

        function renderProducts(products) {
            const container = document.getElementById('productsContainer');

            if (products.length === 0) {
                let emptyMessage = 'No se encontraron productos';
                let emptyIcon = 'fas fa-search';

                if (searchTerm) {
                    emptyMessage = `No hay productos que coincidan con "${searchTerm}"`;
                    emptyIcon = 'fas fa-search-minus';
                } else if (currentFilter !== 'all') {
                    emptyMessage = `No hay productos en la categoría "${currentFilter}"`;
                    emptyIcon = 'fas fa-box-open';
                }

                container.innerHTML = `
                    <div class="empty-state">
                        <i class="${emptyIcon}"></i>
                        <h3>${emptyMessage}</h3>
                        <p>Intenta con otros términos de búsqueda o categorías</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = products.map(product => {
                // Resaltar término de búsqueda en el nombre
                let highlightedName = product.nombre;
                if (searchTerm) {
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    highlightedName = product.nombre.replace(regex,
                        '<mark style="background: #ffeb3b; padding: 0 2px; border-radius: 3px;">$1</mark>');
                }

                return `
                    <div class="product" onclick="showProductModal('${product.nombre}')">
                        ${product.descuento ? '<div class="discount-badge">¡Oferta!</div>' : ''}
                        <img class="product-image" src="${product.imagen}" alt="${product.nombre}">
                        <div class="product-info">
                            <h3 class="product-title">${highlightedName}</h3>
                            <div class="product-rating">
                                ${'⭐'.repeat(product.rating)}
                            </div>
                            <div class="product-price">${product.valor}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function applyFiltersAndSearch() {
            let filteredProducts = [...allProducts];

            // Aplicar filtro de categoría
            if (currentFilter !== 'all') {
                filteredProducts = filteredProducts.filter(product =>
                    product.categoria === currentFilter
                );
            }

            // Aplicar filtro de búsqueda
            if (searchTerm) {
                filteredProducts = filteredProducts.filter(product =>
                    product.nombre.toLowerCase().includes(searchTerm) ||
                    product.descripcion.toLowerCase().includes(searchTerm) ||
                    product.categoria.toLowerCase().includes(searchTerm)
                );
            }

            // Mostrar información de resultados
            updateSearchResultsInfo(filteredProducts.length);

            // Renderizar productos filtrados
            renderProducts(filteredProducts);
        }

        function updateSearchResultsInfo(resultCount) {
            const resultsInfo = document.getElementById('searchResultsInfo');

            if (searchTerm || currentFilter !== 'all') {
                let infoText = '';

                if (searchTerm && currentFilter !== 'all') {
                    const categoryName = currentFilter;
                    infoText = `Se encontraron ${resultCount} producto(s) que contienen "${searchTerm}" en la categoría "${categoryName}"`;
                } else if (searchTerm) {
                    infoText = `Se encontraron ${resultCount} producto(s) que contienen "${searchTerm}"`;
                } else if (currentFilter !== 'all') {
                    infoText = `Mostrando ${resultCount} producto(s) de la categoría "${currentFilter}"`;
                }

                resultsInfo.textContent = infoText;
                resultsInfo.style.display = 'block';

                // Agregar efecto de resaltado si hay búsqueda
                if (resultCount === 0) {
                    resultsInfo.style.background = '#ffe6e6';
                    resultsInfo.style.color = '#d63031';
                } else {
                    resultsInfo.style.background = '#e8f5e8';
                    resultsInfo.style.color = '#2d3436';
                }
            } else {
                resultsInfo.style.display = 'none';
            }
        }

        function showProductModal(productName) {
            const product = allProducts.find(p => p.nombre === productName);
            if (!product) return;

            Swal.fire({
                title: product.nombre,
                html: `
                    <div style="text-align: left; margin: 1rem 0;">
                        <img src="${product.imagen}" alt="${product.nombre}" 
                             style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <p style="color: #666; margin-bottom: 0.5rem;">${product.descripcion}</p>
                        <div style="color: #ffc107; margin-bottom: 0.5rem;">${'⭐'.repeat(product.rating)}</div>
                        <h4 style="color: #4CAF50; font-size: 1.2rem; margin-bottom: 1rem;">${product.valor}</h4>
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
                preConfirm: () => {
                    const quantity = document.getElementById('quantity').value;
                    if (!quantity || quantity < 1) {
                        Swal.showValidationMessage('Por favor, introduce una cantidad válida');
                        return false;
                    }
                    return quantity;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    addToCart(product, parseInt(result.value));
                }
            });
        }

        function addToCart(product, quantity) {
            const existingProduct = cart.find(item => item.nombre === product.nombre);

            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({
                    ...product,
                    quantity: quantity
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();

            Swal.fire({
                title: '¡Producto añadido!',
                text: `${quantity} ${product.nombre}(s) añadido(s) al carrito`,
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-shopping-cart"></i> Ver carrito',
                cancelButtonText: '<i class="fas fa-shopping-bag"></i> Seguir comprando',
                timer: 3000,
                timerProgressBar: true
            }).then((result) => {
                if (result.isConfirmed) {
                    showCart();
                }
            });
        }

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        function showCart() {
            if (cart.length === 0) {
                Swal.fire({
                    title: 'Carrito vacío',
                    text: 'No tienes productos en tu carrito',
                    icon: 'info',
                    confirmButtonText: 'Continuar comprando'
                });
                return;
            }

            const cartItems = cart.map(item => `
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                    <div style="flex: 1;">
                        <strong>${item.nombre}</strong><br>
                        <small style="color: #666;">Cantidad: ${item.quantity}</small>
                    </div>
                    <div style="text-align: right;">
                        <strong style="color: #4CAF50;">${item.valor}</strong>
                    </div>
                </div>
            `).join('');

            Swal.fire({
                title: '<i class="fas fa-shopping-cart"></i> Tu Carrito',
                html: `
                    <div style="max-height: 400px; overflow-y: auto; text-align: left;">
                        ${cartItems}
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #4CAF50;">
                        <strong>Total de productos: ${cart.reduce((total, item) => total + item.quantity, 0)}</strong>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-credit-card"></i> Proceder al pago',
                cancelButtonText: '<i class="fas fa-trash"></i> Vaciar carrito',
                showDenyButton: true,
                denyButtonText: '<i class="fas fa-arrow-left"></i> Seguir comprando'
            }).then((result) => {
                if (result.isConfirmed) {
                    processCheckout();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    clearCart();
                }
            });
        }

        function clearCart() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Se eliminarán todos los productos del carrito',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, vaciar carrito',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart = [];
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();
                    Swal.fire('¡Carrito vaciado!', 'Todos los productos han sido eliminados', 'success');
                }
            });
        }

        function processCheckout() {
            Swal.fire({
                title: '¡Gracias por tu compra!',
                text: 'Tu pedido ha sido procesado exitosamente',
                icon: 'success',
                confirmButtonText: 'Generar nueva compra'
            }).then(() => {
                cart = [];
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
            });
        }
    </script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>

</body>

</html>