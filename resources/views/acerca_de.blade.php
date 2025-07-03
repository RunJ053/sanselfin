<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Finca al Día - Acerca de</title>
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/NAV.css')}}">
    <link rel="stylesheet" href="{{asset('css/ACERCA_DE.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
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

    <div class="container text-center mt-4">
        <h1>Bienvenido usuario a Acerca de</h1>
    </div>

    <br>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Historia de nuestra empresa</h2>
                <p>Texto sobre la historia de la empresa...</p>
                <h2>Filosofía de la empresa</h2>
                <p>Nuestra filosofía se basa en...</p>
            </div>
            <div class="col-md-6">
                <h3>Contáctanos</h3>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu mensaje..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

