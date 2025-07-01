// Mejorar la experiencia del usuario con el input de archivo
document.getElementById('doc').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const label = document.querySelector('label[for="doc"].file-upload-label'); // Selecciona la etiqueta correcta

    if (file) {
        label.innerHTML = `✅ ${file.name}`;
        label.style.background = 'rgba(76, 175, 80, 0.1)';
        label.style.borderColor = '#4CAF50';
    } else {
        label.innerHTML = '📄 Seleccionar archivo';
        label.style.background = 'rgba(76, 175, 80, 0.05)';
        label.style.borderColor = '#4CAF50';
    }
});

// Mejorar la experiencia del usuario con el input de imagen de usuario
document.getElementById('img_user').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const label = document.querySelector('label[for="img_user"].file-upload-label'); // Selecciona la etiqueta correcta

    if (file) {
        label.innerHTML = `✅ ${file.name}`;
        label.style.background = 'rgba(76, 175, 80, 0.1)';
        label.style.borderColor = '#4CAF50';
    } else {
        label.innerHTML = '📄 Seleccionar archivo';
        label.style.background = 'rgba(76, 175, 80, 0.05)';
        label.style.borderColor = '#4CAF50';
    }
});

// Animación sutil al hacer focus en los campos
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.closest('.form-group').style.transform = 'translateX(5px)';
    });
            
    input.addEventListener('blur', function() {
        this.closest('.form-group').style.transform = 'translateX(0)';
    });
});

// Validación de campos antes de enviar el formulario con SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    const nombreInput = document.getElementById('nom');
    const apellidoInput = document.getElementById('ape');
    const form = document.querySelector('form');
    const docInput = document.getElementById('num_doc');
    const telefonoInput = document.getElementById('telefono');
    const direccionInput = document.getElementById('direccion');

    // Validar en tiempo real (solo caracteres)
    nombreInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]/g, '');
    });

    apellidoInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]/g, '');
    });

    form.addEventListener('submit', function(event) {
        let errors = [];

        // Validación de longitud del documento
        const docValue = docInput.value.trim();
        if (docValue.length < 7 || docValue.length > 12) {
            errors.push('El campo "Número del documento" debe tener entre 7 y 12 dígitos.');
        }

        // Validación de longitud del teléfono
        const telefonoValue = telefonoInput.value.trim();
        if (telefonoValue.length !== 10) {
            errors.push('El campo "Número telefónico" debe tener exactamente 10 dígitos.');
        }

        // Validación de longitud del nombre
        const nombreValue = nombreInput.value.trim();
        if (nombreValue.length < 3 || nombreValue.length > 35) {
            errors.push('El campo "Nombres" debe tener entre 3 y 35 caracteres.');
        }

        // Validación de longitud del apellido
        const apeValue = apellidoInput.value.trim();
        if (apeValue.length < 3 || apeValue.length > 35) {
            errors.push('El campo "Apellidos" debe tener entre 3 y 35 caracteres.');
        }

        // Asegúrate de que 'localidad' sea el ID correcto del select. En tu HTML es 'Locadidad'
        const localidadSelect = document.getElementById('Localidad'); // Corregido: ID en el HTML es 'Locadidad'
        if (localidadSelect && localidadSelect.value === "") { // Valida si se ha seleccionado una opción
            errors.push('Por favor, selecciona una localidad.');
        }

        const direccionValue = direccionInput.value.trim();
        if (direccionValue.length < 7 || direccionValue.length > 50) {
            errors.push('El campo "Dirección" debe tener entre 7 y 50 caracteres.');
        }

        if (errors.length > 0) {
            event.preventDefault(); // Detener el envío del formulario
            Swal.fire({
                icon: 'error',
                title: '¡Verifica tu información! 🤔',
                html: '<ul style="text-align: left; list-style-position: inside;">' +
                      errors.map(error => `<li>${error}</li>`).join('') +
                      '</ul>',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#d33'
            });
            // Opcional: enfocar el primer campo con error
            if (errors.includes('El campo "Número del documento" debe tener entre 7 y 15 dígitos.')) {
                docInput.focus();
            } else if (errors.includes('El campo "Número telefónico" debe tener exactamente 10 dígitos.')) {
                telefonoInput.focus();
            } else if (errors.includes('El campo "Nombres" debe tener entre 3 y 35 caracteres.')) {
                nombreInput.focus();
            } else if (errors.includes('El campo "Apellidos" debe tener entre 3 y 35 caracteres.')) {
                apellidoInput.focus();
            } else if (errors.includes('Por favor, selecciona una localidad.')) {
                localidadSelect.focus();
            } else if (errors.includes('El campo "Dirección" debe tener entre 7 y 50 caracteres.')) {
                direccionInput.focus();
            }
        }
    });
});