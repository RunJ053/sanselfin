<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Registro de usuario')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/REGISTRO_USUARIO.CSS') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <body>
    {{-- Mostrar mensajes de sesión --}}
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Errores de validación',
                html: '{!! implode("<br>", $errors->all()) !!}',
                confirmButtonColor: '#f39c12'
            });
        </script>
    @endif

    @yield('content')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/formRegistroUsuario.js') }}"></script>
</body>
</html>