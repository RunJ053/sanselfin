<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/PERFIL.CSS') }}">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo-area">
                <button class="menu-toggle" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars" id="menu-icon"></i>
                </button>
                <div class="logo">
                    <img src="{{ asset('img/logo/icon.png') }}" alt="Logo VeggieFresh" class="logo-image">
                </div>
                <h1 class="brand-name">La Finca Al Día</h1>
            </div>

            <div class="header-right">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-avatar" onclick="toggleDropdown()">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('user.dashboard') }}" class="dropdown-item">Ir al Inicio</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="main-container">
        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="mobile-menu-grid">
                <button class="mobile-menu-item active" onclick="showModule('overview')">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('cart')">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Mi Carrito</span>
                    <span class="badge">3</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('orders')">
                    <i class="fas fa-box"></i>
                    <span>Mis Pedidos</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('profile')">
                    <i class="fas fa-user"></i>
                    <span>Mi Perfil</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('coupons')">
                    <i class="fas fa-tag"></i>
                    <span>Cupones</span>
                    <span class="badge">2</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('favorites')">
                    <i class="fas fa-heart"></i>
                    <span>Favoritos</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('addresses')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Direcciones</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('payments')">
                    <i class="fas fa-credit-card"></i>
                    <span>Pagos</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('notifications')">
                    <i class="fas fa-bell"></i>
                    <span>Notificaciones</span>
                </button>
                <button class="mobile-menu-item" onclick="showModule('settings')">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </button>
            </div>
        </div>

        <div class="layout">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-content">
                    <h2 class="sidebar-title">Navegación</h2>
                    <nav class="nav-menu">
                        <button class="nav-item active" onclick="showModule('overview')">
                            <i class="fas fa-home"></i>
                            <span>Inicio</span>
                        </button>
                        <button class="nav-item" onclick="showModule('cart')">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Mi Carrito</span>
                            <span class="badge">3</span>
                        </button>
                        <button class="nav-item" onclick="showModule('orders')">
                            <i class="fas fa-box"></i>
                            <span>Mis Pedidos</span>
                        </button>
                        <button class="nav-item" onclick="showModule('profile')">
                            <i class="fas fa-user"></i>
                            <span>Mi Perfil</span>
                        </button>
                        <button class="nav-item" onclick="showModule('coupons')">
                            <i class="fas fa-tag"></i>
                            <span>Cupones</span>
                            <span class="badge">2</span>
                        </button>
                        <button class="nav-item" onclick="showModule('favorites')">
                            <i class="fas fa-heart"></i>
                            <span>Favoritos</span>
                        </button>
                        <button class="nav-item" onclick="showModule('addresses')">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Direcciones</span>
                        </button>
                        <button class="nav-item" onclick="showModule('payments')">
                            <i class="fas fa-credit-card"></i>
                            <span>Pagos</span>
                        </button>
                        <button class="nav-item" onclick="showModule('notifications')">
                            <i class="fas fa-bell"></i>
                            <span>Notificaciones</span>
                        </button>
                        <button class="nav-item" onclick="showModule('settings')">
                            <i class="fas fa-cog"></i>
                            <span>Configuración</span>
                        </button>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Overview Module -->
                <div id="overview-content" class="module-content">
                    <!-- Welcome Section -->
                    <div class="welcome-section">
                        <h2 class="welcome-title">¡Hola, <?php echo session('nombre_usuario') ? session('nombre_usuario') : 'Invitado'; ?> 👋</h2>
                        <p class="welcome-subtitle">Bienvenida a tu dashboard de verduras frescas</p>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <p class="stat-label">Pedidos este mes</p>
                                <p class="stat-value">8</p>
                            </div>
                            <div class="stat-card">
                                <p class="stat-label">Ahorro total</p>
                                <p class="stat-value">$45.000</p>
                            </div>
                            <div class="stat-card">
                                <p class="stat-label">Puntos acumulados</p>
                                <p class="stat-value">320</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Access Modules -->
                    <div class="modules-grid">
                        <div class="module-card" onclick="showModule('cart')">
                            <div class="module-header">
                                <div class="module-icon module-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <span class="module-badge">3</span>
                            </div>
                            <h3 class="module-title">Mi Carrito</h3>
                            <div class="module-footer">
                                <span>Ver detalles</span>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>

                        <div class="module-card" onclick="showModule('orders')">
                            <div class="module-header">
                                <div class="module-icon module-orders">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                            <h3 class="module-title">Mis Pedidos</h3>
                            <div class="module-footer">
                                <span>Ver detalles</span>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>

                        <div class="module-card" onclick="showModule('profile')">
                            <div class="module-header">
                                <div class="module-icon module-profile">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h3 class="module-title">Mi Perfil</h3>
                            <div class="module-footer">
                                <span>Ver detalles</span>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>

                        <div class="module-card" onclick="showModule('coupons')">
                            <div class="module-header">
                                <div class="module-icon module-coupons">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <span class="module-badge">2</span>
                            </div>
                            <h3 class="module-title">Cupones</h3>
                            <div class="module-footer">
                                <span>Ver detalles</span>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div class="content-section">
                        <h3 class="section-title">Actividad Reciente</h3>
                        <div class="activity-item success">
                            <div class="activity-icon success">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Pedido #1234 entregado</h4>
                                <p>2 horas ago</p>
                            </div>
                        </div>
                        <div class="activity-item info">
                            <div class="activity-icon info">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Nuevo cupón disponible: 15% OFF</h4>
                                <p>1 día ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Module -->
                <div id="cart-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Mi Carrito de Compras</h2>

                        <div class="cart-item">
                            <div class="cart-item-left">
                                <div class="cart-item-image">
                                    <i class="fas fa-carrot"></i>
                                </div>
                                <div class="cart-item-info">
                                    <h3>Zanahorias Orgánicas</h3>
                                    <p>1 kg</p>
                                </div>
                            </div>
                            <div class="cart-item-right">
                                <p class="cart-item-price">$3.500</p>
                                <p class="cart-item-quantity">Cantidad: 2</p>
                            </div>
                        </div>

                        <div class="cart-item">
                            <div class="cart-item-left">
                                <div class="cart-item-image">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="cart-item-info">
                                    <h3>Espinacas Frescas</h3>
                                    <p>500 gr</p>
                                </div>
                            </div>
                            <div class="cart-item-right">
                                <p class="cart-item-price">$2.800</p>
                                <p class="cart-item-quantity">Cantidad: 1</p>
                            </div>
                        </div>

                        <div class="cart-total">
                            <div class="cart-total-row">
                                <span class="cart-total-label">Total:</span>
                                <span class="cart-total-value">$9.800</span>
                            </div>
                            <button class="checkout-btn">Proceder al Pago</button>
                        </div>
                    </div>
                </div>

                <!-- Other Modules (placeholder) -->
                <div id="orders-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Mis Pedidos</h2>
                        <p>Aquí verás el historial de todos tus pedidos realizados...</p>
                    </div>
                </div>

                <div id="profile-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Mi Perfil</h2>
                        <p>Gestiona tu información personal y preferencias...</p>
                    </div>
                </div>

                <div id="coupons-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Cupones de Descuento</h2>
                        <p>Aquí encontrarás todos tus cupones disponibles...</p>
                    </div>
                </div>

                <div id="favorites-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Mis Favoritos</h2>
                        <p>Productos que has marcado como favoritos...</p>
                    </div>
                </div>

                <div id="addresses-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Mis Direcciones</h2>
                        <p>Gestiona las direcciones de entrega...</p>
                    </div>
                </div>

                <div id="payments-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Métodos de Pago</h2>
                        <p>Administra tus tarjetas y métodos de pago...</p>
                    </div>
                </div>

                <div id="notifications-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Notificaciones</h2>
                        <p>Revisa todas tus notificaciones...</p>
                    </div>
                </div>

                <div id="settings-content" class="module-content hidden">
                    <div class="content-section">
                        <h2 class="section-title">Configuración</h2>
                        <p>Ajusta las configuraciones de tu cuenta...</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        let currentModule = 'overview';
        let isMobileMenuOpen = false;

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            isMobileMenuOpen = !isMobileMenuOpen;

            if (isMobileMenuOpen) {
                mobileMenu.classList.add('active');
                menuIcon.className = 'fas fa-times';
            } else {
                mobileMenu.classList.remove('active');
                menuIcon.className = 'fas fa-bars';
            }
        }

        function showModule(moduleId) {
            // Hide all module contents
            const moduleContents = document.querySelectorAll('.module-content');
            moduleContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Show selected module content
            const selectedContent = document.getElementById(moduleId + '-content');
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Update navigation active states
            updateNavigation(moduleId);

            currentModule = moduleId;

            // Close mobile menu if open
            if (isMobileMenuOpen) {
                toggleMobileMenu();
            }
        }

        function updateNavigation(activeModuleId) {
            // Update sidebar navigation
            const sidebarItems = document.querySelectorAll('.sidebar .nav-item');
            sidebarItems.forEach((item, index) => {
                const moduleIds = ['overview', 'cart', 'orders', 'profile', 'coupons', 'favorites', 'addresses', 'payments', 'notifications', 'settings'];
                if (moduleIds[index] === activeModuleId) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });

            // Update mobile menu navigation
            const mobileItems = document.querySelectorAll('.mobile-menu .mobile-menu-item');
            mobileItems.forEach((item, index) => {
                const moduleIds = ['overview', 'cart', 'orders', 'profile', 'coupons', 'favorites', 'addresses', 'payments', 'notifications', 'settings'];
                if (moduleIds[index] === activeModuleId) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuToggle = document.querySelector('.menu-toggle');

            if (isMobileMenuOpen && !mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                toggleMobileMenu();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024 && isMobileMenuOpen) {
                toggleMobileMenu();
            }
        });

        //#1234
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Cerrar el menú si se hace clic fuera de él
        window.onclick = function(event) {
            if (!event.target.matches('.user-avatar')) {
                const dropdowns = document.getElementsByClassName("dropdown-menu");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>
</body>

</html>