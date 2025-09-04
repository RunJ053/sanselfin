<div>
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
                            <div class="notification-container">
                                <i class="fas fa-shopping-cart"></i>
                                @if(isset($carritoCount) && $carritoCount > 0)
                                @if($carritoCount <= 99)
                                    <span class="notification-badge">{{ $carritoCount }}</span>
                                    @else
                                    <span class="notification-badge large-number">99+</span>
                                    @endif
                                    @endif
                            </div>
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
                    <a href="{{ route('carrito.index') }}" role="menuitem" aria-label="Carrito de Compras">
                        <div class="notification-container">
                            <i class="fas fa-shopping-cart"></i>
                            @if(isset($carritoCount) && $carritoCount > 0)
                            @if($carritoCount <= 99)
                                <span class="notification-badge">{{ $carritoCount }}</span>
                                @else
                                <span class="notification-badge large-number">99+</span>
                                @endif
                                @endif
                        </div>
                        <span class="visually-hidden">Carrito</span>
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