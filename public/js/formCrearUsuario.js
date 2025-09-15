document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const nombreInput = document.getElementById('registerNombre');
    const apellidoInput = document.getElementById('apellido');
    const direccionInput = document.getElementById('direccion');
    const emailInput = document.getElementById('registerEmail');
    const fechaNacInput = document.getElementById('fecha_nac');
    const passwordInput = document.getElementById('registerPassword');
    const passwordConfirmInput = document.getElementById('confirmRegisterPassword');

    // --- Mostrar errores debajo de cada input ---
    function showValidationFeedback(inputElement, isValid, message = '') {
        let feedbackElement = inputElement.parentElement.querySelector('.invalid-feedback');
        if (!feedbackElement) {
            feedbackElement = document.createElement('div');
            feedbackElement.classList.add('invalid-feedback');
            inputElement.parentElement.appendChild(feedbackElement);
        }

        if (isValid) {
            inputElement.classList.remove('is-invalid');
            feedbackElement.textContent = '';
        } else {
            inputElement.classList.add('is-invalid');
            feedbackElement.textContent = message;
        }
    }

    // --- Validaciones ---
    function validateNombre() {
        nombreInput.value = nombreInput.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]/g, ''); // limpia números
        const value = nombreInput.value.trim();
        const isValid = value.length >= 3;
        const message = '';
        showValidationFeedback(nombreInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateApellido() {
        apellidoInput.value = apellidoInput.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]/g, ''); // limpia números
        const value = apellidoInput.value.trim();
        const isValid = value.length >= 3;
        const message = '';
        showValidationFeedback(apellidoInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateDireccion() {
        const value = direccionInput.value.trim();
        const isValid = value.length >= 7 && value.length <= 50;
        const message = '';
        showValidationFeedback(direccionInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateEmail() {
        const value = emailInput.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = regex.test(value);
        const message = '';
        showValidationFeedback(emailInput, isValid, message);
        return isValid ? '' : message;
    }

    function validateFechaNac() {
        const value = fechaNacInput.value;
        if (!value) {
            showValidationFeedback(fechaNacInput, false, 'La fecha de nacimiento es obligatoria.');
            return 'La fecha de nacimiento es obligatoria.';
        }
        const birthDate = new Date(value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        const isValid = age >= 18;
        const message = 'Debes ser mayor de 18 años.';
        showValidationFeedback(fechaNacInput, isValid, message);
        return isValid ? '' : message;
    }

    function validatePassword() {
        const value = passwordInput.value;
        const hasMinLength = value.length >= 8;
        const hasUpper = /[A-Z]/.test(value);
        const hasLower = /[a-z]/.test(value);
        const hasNumber = /\d/.test(value);
        const hasSpecial = /[@$!%*#?&.]/.test(value);

        const isValid = hasMinLength && hasUpper && hasLower && hasNumber && hasSpecial;

        let message = '';
        showValidationFeedback(passwordInput, isValid, message);
        return isValid ? '' : message;
    }

    function validatePasswordConfirmation() {
        const isValid = passwordConfirmInput.value === passwordInput.value && passwordConfirmInput.value !== '';
        const message = 'Las contraseñas no coinciden.';
        showValidationFeedback(passwordConfirmInput, isValid, message);
        return isValid ? '' : message;
    }

    // --- Eventos en tiempo real ---
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

    // --- Envío del formulario ---
    form.addEventListener('submit', function (event) {
        const errors = [
            validateNombre(),
            validateApellido(),
            validateDireccion(),
            validateEmail(),
            validateFechaNac(),
            validatePassword(),
            validatePasswordConfirmation()
        ].filter(msg => msg !== '');

        if (errors.length > 0) {
            event.preventDefault();

            Swal.fire({
                icon: 'error',
                title: '¡Verifica tu información!',
                html: `<ul style="text-align:left; list-style-position: inside;">${errors.map(e => `<li>${e}</li>`).join('')}</ul>`,
                confirmButtonText: 'Entendido',
            });
        }
    });
});
