<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle','Mi Perfil')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/PERFIL.CSS') }}">
</head>

<body>
    @yield('nav')
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
                <div class="user-avatar" onclick="toggleDropdown()">
                    @if($usuario->user_img)
                    <img src="{{ asset( 'img/usuario_img/' . $usuario->user_img) }}" alt="Avatar" class="avatar-image">
                    @else
                    <i class="fas fa-user"></i> <!-- Icono predeterminado -->
                    @endif
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
    @yield('content')
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Actualización Exitosa! 🎉',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    @endif

    <!-- scripts -->
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/myprofile.js') }}"></script>
    <!-- Footer -->

</body>

</html>