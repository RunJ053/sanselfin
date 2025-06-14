// Mejorar la experiencia del usuario con el input de archivo
document.getElementById('doc').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const label = document.querySelector('.file-upload-label');
            
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
        this.parentElement.style.transform = 'translateX(5px)';
    });
            
    input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateX(0)';
    });
});

// Validación de campos antes de enviar el formulario
document.addEventListener('DOMContentLoaded', function() {
    const nombreInput = document.getElementById('nom');
    const apellidoInput = document.getElementById('ape');
    const respuestapreguntaInput = document.getElementById('respuesta');
    const form = document.querySelector('form');

    // Validar en tiempo real
    nombreInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]/g, '');
    });

    apellidoInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]/g, ''); // Eliminar todo excepto letras, espacios y ´
    });
    respuestapreguntaInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ\s´]/g, '');
    });
    
});

document.addEventListener('DOMContentLoaded', function() 
{
    const form = document.querySelector('form');
    const docInput = document.getElementById('num_doc');
    const nombreInput =document.getElementById('nom');
    const apeInput = document.getElementById('ape');
    const localidadInput =document.getElementById('localidad');
    const direccionInput = document.getElementById('direccion');
    const respuestaInput = document.getElementById('respuesta');
    const telefonoInput = document.getElementById('telefono');

    form.addEventListener('submit', function(event) 
    {
        const docValue = docInput.value.trim();
        const telefonoValue = telefonoInput.value.trim();
        const nombreValue = nombreInput.value.trim();
        const apeValue = apeInput.value.trim();
        const localidadValue = localidadInput.value.trim();
        const direccionValue = direccionInput.value.trim();
        const respuestaValue = respuestaInput.value.trim();
        
        if (docValue.length < 7 || docValue.length > 15) {
            event.preventDefault();
            docInput.focus();
            return;
        }
        if (telefonoValue.length !== 10) {
            event.preventDefault();
            telefonoInput.focus();
            return;
        }
        if (nombreValue.length < 3 || nombreValue.length > 35) {
            event.preventDefault();
            nombreInput.focus();
            return;
        }
        if (apeValue.length < 3 || apeValue.length > 35) {
            event.preventDefault();
            apeInput.focus();
            return;
        }
        if (localidadValue.length < 7 || localidadValue.length > 50) {
            event.preventDefault();
            localidadInput.focus();
            return;
        }
        if (direccionValue.length < 7 || direccionValue.length > 50) {
            event.preventDefault();
            direccionInput.focus();
            return;
        }
        if (respuestaValue.length < 5 || respuestaValue.length > 40) {
            event.preventDefault();
            respuestaInput.focus();
            return;
        }
    });
});