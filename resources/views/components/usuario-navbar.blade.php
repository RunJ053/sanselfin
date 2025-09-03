<div>
    <header class="header">
        <header class="header">
            <nav class="main-nav" aria-label="Navegación principal">
                <!-- Logo -->
                <div class="nav-left">
                    <a href="{{ route('user.dashboard') }}" class="logo-link">
                        <img src="{{asset ('img/logo/icon.png')}}" alt="Logo de La Finca al Día" width="120" height="40">
                    </a>
                </div>

                <!-- Acciones de la derecha -->
                <div class="nav-right">
                    <ul class="nav-actions" role="menubar">
                        <li role="none">
                            <a href="{{ route('notificaciones.index') }}" role="menuitem" aria-label="Notificaciones">
                                <div class="notification-container">
                                    <i class="fas fa-bell"></i>
                                    @if(isset($notificaciones) && $notificaciones->where('leida', false)->count() > 0)
                                    @if($notificaciones->where('leida', false)->count() <= 99)
                                        <span class="notification-badge">{{ $notificaciones->where('leida', false)->count() }}</span>
                                        @else
                                        <span class="notification-badge large-number">99+</span>
                                        @endif
                                        @endif
                                </div>
                                <span class="visually-hidden">Notificaciones</span>
                            </a>
                        </li>

                        <li role="none">
                            <a href="{{ route('carrito.index') }}" role="menuitem" aria-label="Carrito de Compras">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="visually-hidden">Carrito</span>
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
                            <a href="{{ route('user.dashboard') }}" class="dropdown-item">Inicio</a>
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
                <div class="mobile-nav-actions">
                    <button class="mobile-menu-item active" onclick="showModule('overview')">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </button><br>
                    <button class="mobile-menu-item" onclick="showModule('orders')">
                        <i class="fas fa-box"></i>
                        <span>Mis Pedidos</span>
                    </button><br>
                    <button class="mobile-menu-item" onclick="showModule('profile')">
                        <i class="fas fa-user"></i>
                        <span>Mi Perfil</span>
                    </button><br>
                    <button class="mobile-menu-item" onclick="showModule('addresses')">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Direcciones</span>
                    </button><br>
                </div>
                <!-- Acciones móvil -->
                <ul class="mobile-nav-actions">
                    <li role="none">
                        <a href="{{ route('notificaciones.index') }}" role="menuitem" aria-label="Notificaciones">
                            <div class="notification-container">
                                <i class="fas fa-bell"></i>
                                @if(isset($notificaciones) && $notificaciones->where('leida', false)->count() > 0)
                                @if($notificaciones->where('leida', false)->count() <= 99)
                                    <span class="notification-badge">{{ $notificaciones->where('leida', false)->count() }}</span>
                                    @else
                                    <span class="notification-badge large-number">99+</span>
                                    @endif
                                    @endif
                            </div>
                            <span class="visually-hidden">Notificaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('carrito.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Carrito de Compras</span>
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
</div>