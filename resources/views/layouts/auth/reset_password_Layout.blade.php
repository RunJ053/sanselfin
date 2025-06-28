<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Restablecer Contraseña')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{ asset('css/ADMINISTRADOR.CSS') }}"> <!-- Asegúrate de que tu CSS exista -->
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png')}}" type="image/x-icon">

</head>

<body>
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = form.querySelector('.btn-primary-custom');
                    if (!button) return;
                    const btnText = button.querySelector('.btn-text');
                    const btnSpinner = button.querySelector('.btn-spinner');

                    if (btnText && btnSpinner) {
                        btnText.classList.add('d-none');
                        btnSpinner.classList.remove('d-none');
                    }
                    button.disabled = true;
                });
            });
        });
    </script>

    @if (session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('status') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Operación Exitosa!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    {{-- Mensajes de error (por ejemplo, desde '$errors->any()' en el controlador)  --}}
    @if ($errors->any())

    let errorMessage = '';
    @foreach ($errors->all() as $error)
    errorMessage += '{{ $error }}<br>';
    @endforeach
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            html: errorMessage, // Usamos html para múltiples líneas
            confirmButtonText: 'Entendido'
        });
    </script>
    @endif

    {{-- Si tienes mensajes específicos de error (ej. 'email' o 'token') que quieres manejar de forma separada --}}
    @if ($errors->has('email'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error de Correo',
            text: "{{ $errors->first('email') }}",
            confirmButtonText: 'Entendido'
        });
    </script>
    @endif

    @if ($errors->has('token'))
    <script>
        Swal.fire({
            icon: 'warning', // Puedes usar 'warning' o 'error'
            title: 'Código Inválido o Expirado',
            text: "{{ $errors->first('token') }}",
            confirmButtonText: 'Entendido'
        });
    </script>
    @endif

</body>

</html>