<div>
    <header class="header-bar">
        <div class="d-flex align-items-center header-brand">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('img/logo/icon.png') }}" alt="Logo">
            </a>
        </div>

        <!-- enlaces -->
        <nav class="ms-4 me-auto collapse d-md-flex nav-links" id="topNav">
            <ul class="navbar-nav d-flex flex-row gap-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-1"></i> Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-1"></i> Inventario</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galeria.index') }}"><i class="fas fa-image me-1"></i> Galeria Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reportes.financieros') }}"><i class="fas fa-chart-bar me-1"></i> Reportes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('usuario.index') }}"><i class="fas fa-users me-1"></i> Usuarios</a></li>
            </ul>
        </nav>

        <!-- usuario -->
        <div class="user-area ms-auto">
            @auth
            <div class="user-welcome">
                <i class="fas fa-user-circle me-1"></i>
                {{ session('nombre_usuario') ?? Auth::user()->nombre ?? Auth::user()->nomb_usu ?? 'Administrador' }}
            </div>
            <!-- campana de notificaciones -->
            <div class="dropdown d-inline-block">
                <a href="#" class="btn btn-link text-white position-relative p-0" style="font-size: 1rem;"
                    id="notiDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    @if(!empty($notificaciones) && count($notificaciones) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count($notificaciones) }}
                    </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notiDropdown">
                    <li>
                        <h6 class="dropdown-header">Notificaciones</h6>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('pedidos.index') }}">
                            <i class="fas fa-shopping-cart me-2 text-primary"></i> Pedidos Recientes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('producto.index') }}">
                            <i class="fas fa-box-open me-2 text-warning"></i> Stock Bajo
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tasks me-2 text-success"></i> Tareas Pendientes
                        </a>
                    </li>
                </ul>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="logout-btn">
                <i class="fas fa-exclamation-circle"></i> Login
            </a>
            @endauth
        </div>
    </header>
</div>