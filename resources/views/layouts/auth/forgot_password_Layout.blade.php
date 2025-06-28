<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle','Recuperar Contraseña')</title>

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

            const sessionStatus = "{{ session('status') }}";
            const sessionSuccess = "{{ session('success') }}";
            const hasAnyErrors = @json($errors->any());
            const allErrors = @json($errors->all());
            const emailError = "{{ $errors->first('email') }}";

            if (sessionStatus) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: sessionStatus,
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (sessionSuccess) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Operación Exitosa!',
                    text: sessionSuccess,
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (hasAnyErrors) {
                let errorMessage = '';

                if (emailError) { // Manejo de error de email específico
                    errorMessage += 'Error de Correo: ' + emailError + '<br>';
                }

                // Añadir cualquier otro error que no sea el de email
                allErrors.forEach(error => {
                    // Evitar duplicar el error de email si ya lo manejamos
                    if (emailError && error === emailError) {
                        return; // Saltar este error si ya lo agregamos
                    }
                    errorMessage += error + '<br>';
                });

                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    html: errorMessage || 'Ha ocurrido un error inesperado.', // Muestra un mensaje genérico si no hay errores específicos
                    confirmButtonText: 'Entendido'
                });
            }
        });
    </script>
</body>