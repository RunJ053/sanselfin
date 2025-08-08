document.addEventListener('DOMContentLoaded', function() {

    // --- Selectores de Elementos del DOM ---
    const form = document.getElementById('registerForm');
    const tipoUsuarioSelect = document.getElementById('tipo_usuario_select');
    const nombreInput = document.getElementById('registerNombre');
    const apellidoInput = document.getElementById('apellido');
    const direccionInput = document.getElementById('direccion');
    const emailInput = document.getElementById('registerEmail');
    const fechaNacInput = document.getElementById('fecha_nac');
    const passwordInput = document.getElementById('registerPassword');
    const passwordConfirmInput = document.getElementById('confirmRegisterPassword');

    // Mapeo de IDs a sus nombres de campo para mensajes de error
    const fieldNames = {
        'tipo_usuario_select': 'Tipo de Usuario',
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

    // --- Funciones de Validación Individuales ---

    function validateTipoUsuario() {
        const isValid = tipoUsuarioSelect.value !== "";
        showValidationFeedback(tipoUsuarioSelect, isValid, 'Por favor, selecciona un tipo de usuario.');
        return isValid;
    }

    function validateNombre() {
        const value = nombreInput.value.trim();
        // Permite letras, espacios y caracteres acentuados.
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]{3,35}$/;
        const isValid = regex.test(value);
        showValidationFeedback(nombreInput, isValid, 'El nombre debe tener entre 3 y 35 caracteres y solo contener letras.');
        return isValid;
    }

    function validateApellido() {
        const value = apellidoInput.value.trim();
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]{6,35}$/;
        const isValid = regex.test(value);
        showValidationFeedback(apellidoInput, isValid, 'El apellido debe tener entre 3 y 35 caracteres y solo contener letras.');
        return isValid;
    }

    function validateDireccion() {
        const value = direccionInput.value.trim();
        const isValid = value.length >= 7 && value.length <= 50;
        showValidationFeedback(direccionInput, isValid, 'La dirección debe tener entre 7 y 50 caracteres.');
        return isValid;
    }

    function validateEmail() {
        const value = emailInput.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = regex.test(value);
        showValidationFeedback(emailInput, isValid, 'Por favor, ingresa un correo electrónico válido.');
        return isValid;
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
        return isValid;
    }

    function validatePasswordConfirmation() {
        const isValid = passwordConfirmInput.value === passwordInput.value;
        showValidationFeedback(passwordConfirmInput, isValid, 'Las contraseñas no coinciden.');
        return isValid;
    }


    // --- Event Listeners para Validación en Tiempo Real ---
    tipoUsuarioSelect.addEventListener('change', validateTipoUsuario);
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
        // Ejecutamos todas las validaciones
        const isTipoUsuarioValid = validateTipoUsuario();
        const isNombreValid = validateNombre();
        const isApellidoValid = validateApellido();
        const isDireccionValid = validateDireccion();
        const isEmailValid = validateEmail();
        const isFechaNacValid = validateFechaNac();
        const isPasswordValid = validatePassword();
        const isPasswordConfirmValid = validatePasswordConfirmation();

        // Si alguna validación falla, prevenimos el envío y mostramos SweetAlert2
        if (!(isTipoUsuarioValid && isNombreValid && isApellidoValid && isDireccionValid && isEmailValid && isFechaNacValid && isPasswordValid && isPasswordConfirmValid)) {
            event.preventDefault();

            let errors = [];
            // Recorremos los campos y agregamos sus errores al array
            if (!isTipoUsuarioValid) errors.push(showValidationFeedback(tipoUsuarioSelect, false, 'Por favor, selecciona un tipo de usuario.'));
            if (!isNombreValid) errors.push(showValidationFeedback(nombreInput, false, 'El nombre debe tener entre 3 y 35 caracteres y solo contener letras.'));
            if (!isApellidoValid) errors.push(showValidationFeedback(apellidoInput, false, 'El apellido debe tener entre 3 y 35 caracteres y solo contener letras.'));
            if (!isDireccionValid) errors.push(showValidationFeedback(direccionInput, false, 'La dirección debe tener entre 7 y 50 caracteres.'));
            if (!isEmailValid) errors.push(showValidationFeedback(emailInput, false, 'Por favor, ingresa un correo electrónico válido.'));
            if (!isFechaNacValid) errors.push(showValidationFeedback(fechaNacInput, false, 'Debes ser mayor de 18 años para registrarte.'));
            if (!isPasswordValid) errors.push(showValidationFeedback(passwordInput, false, 'La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un símbolo.'));
            if (!isPasswordConfirmValid) errors.push(showValidationFeedback(passwordConfirmInput, false, 'Las contraseñas no coinciden.'));

            // Construir el HTML de la lista de errores
            const errorsHtml = '<ul>' + errors.map(msg => `<li>${msg}</li>`).join('') + '</ul>';

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