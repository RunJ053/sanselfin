<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Inicio de sesión')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{ asset('css/LOGIN.CSS') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png')}}" type="image/x-icon">

</head>

<body>
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <script src="{{ asset('js/formCrearUsuario.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const tipoUsuarioSelect = document.getElementById('tipo_usuario_select');
            
            // Función para actualizar la acción del formulario
            function updateFormAction() {
                const selectedValue = tipoUsuarioSelect.value;
                if (selectedValue == 1) {
                    form.action = "{{ route('register.user') }}";
                } else if (selectedValue == 3) {
                    form.action = "{{ route('register.empleado') }}";
                } else {
                    form.action = ""; // Acción por defecto si no hay nada seleccionado
                }
            }
            
            // Actualiza la acción al cargar la página y al cambiar la selección
            updateFormAction();
            tipoUsuarioSelect.addEventListener('change', updateFormAction);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de focus mejorado
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Lógica para mostrar el spinner en el botón al enviar el formulario
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = form.querySelector('.btn-primary-custom');
                    if (!button) return;

                    // Solo aplicar el spinner si el formulario es válido (para el formulario de registro)
                    if (form.id === 'registerForm') { // Asignaremos un ID a tu formulario de registro
                        const fechaNacInput = document.getElementById('fecha_nac');
                        if (fechaNacInput && !isAdult(fechaNacInput.value)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de Registro',
                                text: 'Debes ser mayor de 18 años para registrarte.',
                                confirmButtonText: 'Entendido'
                            });
                            e.preventDefault(); // Detener el envío del formulario
                            return;
                        }
                    }

                    // Si la validación pasa o no es el formulario de registro, mostrar spinner
                    const btnText = button.querySelector('.btn-text');
                    const btnSpinner = button.querySelector('.btn-spinner');

                    if (btnText && btnSpinner) {
                        btnText.classList.add('d-none');
                        btnSpinner.classList.remove('d-none');
                    }
                    button.disabled = true;
                });
            });

            // Función para verificar la edad
            function isAdult(dateString) {
                const birthDate = new Date(dateString);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age >= 18;
            }

            // Lógica para alternar entre pestañas Login/Register
            const loginTab = document.getElementById('tab-login');
            const registerTab = document.getElementById('tab-register');
            const pillsLogin = document.getElementById('pills-login');
            const pillsRegister = document.getElementById('pills-register');
            const showRegisterTabLink = document.getElementById('showRegisterTab'); // El enlace "¿No tienes una cuenta? Regístrate aquí"

            if (showRegisterTabLink) {
                showRegisterTabLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Usar las funciones de MDBootstrap para alternar pestañas
                    const mdbTab = new mdb.Tab(registerTab);
                    mdbTab.show();
                });
            }

            // Define una variable JavaScript basada en la lógica de Blade
            // Solo abre el modal si openAdminVerificationModal está flasheado O si hay errores en el código de verificación
            var openAdminModalString = "{{ (session('openAdminVerificationModal') || $errors->has('verification_code')) ? 'true' : 'false' }}";
            var openAdminModal = (openAdminModalString === 'true'); // Convierte la cadena a booleano real

            var adminUserId = "{{ session('admin_user_id') ?? old('admin_user_id') }}";

            if (openAdminModal) {
                var adminVerificationModal = new mdb.Modal(document.getElementById('adminVerificationModal'));
                document.getElementById('modal_admin_user_id').value = adminUserId;
                adminVerificationModal.show();

                // Si se abre el modal, asegurarse de que la pestaña de registro esté activa
                const mdbTabRegister = new mdb.Tab(registerTab);
                mdbTabRegister.show();
            }

            // Lógica para mostrar alertas con SweetAlert2 para Login y Registro
            const sessionStatus = "{{ session('status') }}";
            const sessionSuccess = "{{ session('success') }}";
            const sessionMessage = "{{ session('message') }}"; // Para mensajes generales del controlador
            const hasAnyErrors = @json($errors->any());
            const allErrors = @json($errors->all());

            // Mensajes de éxito
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
            } else if (sessionMessage) { // Para mensajes de notificación general
                // Solo muestra si no es un mensaje del modal de admin (que se abrirá por JS)
                if (!openAdminModal) { // Evita duplicar el mensaje si el modal ya se está abriendo
                    Swal.fire({
                        icon: 'info', // O 'success' si es un mensaje positivo
                        title: '¡Información!',
                        text: sessionMessage,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }


            // Mensajes de error
            if (hasAnyErrors) {
                let errorMessage = '';
                allErrors.forEach(error => {
                    errorMessage += error + '<br>';
                });

                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    html: errorMessage || 'Ha ocurrido un error inesperado.',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    </script>
</body>

</html>