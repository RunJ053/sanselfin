document.addEventListener('DOMContentLoaded', function() {

    // --- Selectores de Elementos del DOM ---
    const form = document.getElementById('registerForm');
    const nombreInput = document.getElementById('registerNombre');
    const apellidoInput = document.getElementById('apellido');
    const direccionInput = document.getElementById('direccion');
    const emailInput = document.getElementById('registerEmail');
    const fechaNacInput = document.getElementById('fecha_nac');
    const passwordInput = document.getElementById('registerPassword');
    const passwordConfirmInput = document.getElementById('confirmRegisterPassword');

    // Mapeo de IDs a sus nombres de campo para mensajes de error
    const fieldNames = {
        'registerNombre': 'Nombre',
        'apellido': 'Apellido',
        'direccion': 'Dirección',
        'registerEmail': 'Correo electrónico',
        'fecha_nac': 'Fecha de Nacimiento',
        'registerPassword': 'Contraseña',
        'confirmRegisterPassword': 'Confirmar Contraseña'
    };

    /**
     * Función para mostrar/ocultar el feedback de validación de Bootstrap.
     * @param {HTMLElement} inputElement - El elemento de input.
     * @param {boolean} isValid - Verdadero si el campo es válido, falso si no lo es.
     * @param {string} message - El mensaje de error a mostrar.
     */
    function showValidationFeedback(inputElement, isValid, message = '') {
        const feedbackElement = inputElement.parentElement.querySelector('.invalid-feedback');
        if (isValid) {
            inputElement.classList.remove('is-invalid');
            if (feedbackElement) {
                feedbackElement.textContent = '';
            }
        } else {
            inputElement.classList.add('is-invalid');
            if (feedbackElement) {
                feedbackElement.textContent = message;
            }
        }
    }

    // --- Funciones de Validación Individuales (Mejoradas) ---

    function validateNombre() {
        const value = nombreInput.value.trim();
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]{3,35}$/;
        const isValid = regex.test(value);
        const message = 'El nombre debe tener entre 3 y 35 caracteres y solo contener letras.';
        showValidationFeedback(nombreInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateApellido() {
        const value = apellidoInput.value.trim();
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]{3,35}$/;
        const isValid = regex.test(value);
        const message = 'El apellido debe tener entre 3 y 35 caracteres y solo contener letras.';
        showValidationFeedback(apellidoInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateDireccion() {
        const value = direccionInput.value.trim();
        const isValid = value.length >= 7 && value.length <= 50;
        const message = 'La dirección debe tener entre 7 y 50 caracteres.';
        showValidationFeedback(direccionInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateEmail() {
        const value = emailInput.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = regex.test(value);
        const message = 'Por favor, ingresa un correo electrónico válido.';
        showValidationFeedback(emailInput, isValid, message);
        return isValid ? '' : message;
    }

    function validatePassword() {
        const value = passwordInput.value;
        const hasMinLength = value.length >= 8;
        const hasUpper = /[A-Z]/.test(value);
        const hasLower = /[a-z]/.test(value);
        const hasNumber = /\d/.test(value);
        const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(value);
        
        const isValid = hasMinLength && hasUpper && hasLower && hasNumber && hasSpecial;
        let message = '';
        if (!isValid) {
            message = 'La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un símbolo.';
        }
        showValidationFeedback(passwordInput, isValid, message);
        return isValid ? '' : message;
    }

    function validatePasswordConfirmation() {
        const isValid = passwordConfirmInput.value === passwordInput.value;
        const message = 'Las contraseñas no coinciden.';
        showValidationFeedback(passwordConfirmInput, isValid, message);
        return isValid ? '' : message;
    }


    // --- Event Listeners para Validación en Tiempo Real ---
    nombreInput.addEventListener('input', validateNombre);
    apellidoInput.addEventListener('input', validateApellido);
    direccionInput.addEventListener('input', validateDireccion);
    emailInput.addEventListener('input', validateEmail);
    fechaNacInput.addEventListener('change', validateFechaNac);
    passwordInput.addEventListener('input', () => {
        validatePassword();
        validatePasswordConfirmation();
    });
    passwordConfirmInput.addEventListener('input', validatePasswordConfirmation);

    // --- Manejo del Envío del Formulario ---
    form.addEventListener('submit', function(event) {
        // Ejecutamos todas las validaciones y recogemos los errores
        const errors = [
            validateNombre(),
            validateApellido(),
            validateDireccion(),
            validateEmail(),
            validateFechaNac(),
            validatePassword(),
            validatePasswordConfirmation()
        ].filter(error => error !== ''); // Filtra los mensajes vacíos (campos válidos)

        // Si hay errores, prevenimos el envío y mostramos SweetAlert2
        if (errors.length > 0) {
            event.preventDefault();

            // Construir el HTML de la lista de errores
            const errorsHtml = '<ul style="text-align: left; list-style-position: inside;">' + 
                               errors.map(msg => `<li>${msg}</li>`).join('') + 
                               '</ul>';

            // Mostrar el SweetAlert2
            Swal.fire({
                icon: 'error',
                title: '¡Verifica tu información!',
                html: errorsHtml,
                confirmButtonText: 'Entendido',
            });
        }
    });

    // Validamos el formulario al cargarse si hay errores de Laravel
    document.querySelectorAll('.is-invalid').forEach(element => {
        // Dispara el evento 'input' para que se muestre el feedback en tiempo real
        const event = new Event('input');
        element.dispatchEvent(event);
    });
});