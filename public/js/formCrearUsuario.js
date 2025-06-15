document.addEventListener('DOMContentLoaded', function() 
{
    const form = document.querySelector('form');
    const nombreInput = document.getElementById('nom_usuario');
    const contraInput = document.getElementById('contra');
    const confiContraInput = document.getElementById('confi_contra');

    form.addEventListener('submit', function(event) 
    {
        const nombreValue = nombreInput.value.trim();
        const contraValue = contraInput.value.trim();
        const confiContraValue = confiContraInput.value.trim();
        
        if (nombreValue.length < 6 || nombreValue.length > 15) {
            event.preventDefault();
            nombreInput.focus();
            return;
        }
        if (contraValue.length < 8 || contraValue.length > 20) {
            event.preventDefault();
            contraInput.focus();
            return;
        }
        if (confiContraValue.length < 8 || confiContraValue.length > 20) {
            event.preventDefault();
            confiContraInput.focus();
            return;
        }

        // Verificar si las contraseñas coinciden
        if (contraValue !== confiContraValue) {
            event.preventDefault(); // Evitar el envío del formulario
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Las contraseñas no coinciden.',
                confirmButtonColor: '#d33'
            });
            confiContraInput.focus();
            return;
        }
    });
});
