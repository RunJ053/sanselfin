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
