// Scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("visible");
        }
    });
}, observerOptions);

// Observe all animated elements
document
    .querySelectorAll(".content-card, .value-item, .contact-section")
    .forEach((el) => {
        observer.observe(el);
    });

// Add smooth scrolling for better UX
document.documentElement.style.scrollBehavior = "smooth";

function limpiarTexto(input, soloLetras = false) {
    input.addEventListener("input", function () {
        let valor = input.value;

        if (soloLetras) {
            // Permitir solo letras, espacios y acentos
            valor = valor.replace(/[^a-zA-ZÀ-ÿ\u00f1\u00d1\s]/g, "");
        } else {
            // Eliminar solo caracteres especiales peligrosos (<, >, /, etc.)
            valor = valor.replace(/[<>\/\\{}[\];]/g, "");
        }

        input.value = valor;
    });
}

// Aplica la limpieza a los campos
document.addEventListener("DOMContentLoaded", () => {
    let nombreInput = document.querySelector("input[name='nombre']");
    let asuntoInput = document.querySelector("input[name='asunto']");
    let mensajeInput = document.querySelector("textarea[name='mensaje']");

    // Nombre y asunto solo letras
    limpiarTexto(nombreInput, true);
    limpiarTexto(asuntoInput, true);

    // Mensaje permite letras, números, pero limpia caracteres especiales
    limpiarTexto(mensajeInput, false);
});

document
    .getElementById("contactoForm")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Prevenimos envío hasta validar

        let nombre = document
            .querySelector("input[name='nombre']")
            .value.trim();
        let correo = document
            .querySelector("input[name='correo']")
            .value.trim();
        let asunto = document
            .querySelector("input[name='asunto']")
            .value.trim();
        let mensaje = document
            .querySelector("textarea[name='mensaje']")
            .value.trim();

        // Regex simple para validar correo
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validaciones
        if (nombre.length < 3) {
            Swal.fire({
                icon: "warning",
                title: "Nombre inválido",
                text: "El nombre debe tener al menos 3 caracteres.",
            });
            return;
        }

        if (!emailRegex.test(correo)) {
            Swal.fire({
                icon: "warning",
                title: "Correo inválido",
                text: "Por favor ingresa un correo electrónico válido.",
            });
            return;
        }

        if (asunto.length < 10) {
            Swal.fire({
                icon: "warning",
                title: "Asunto muy corto",
                text: "El asunto debe tener al menos 10 caracteres.",
            });
            return;
        }

        if (mensaje.length < 15) {
            Swal.fire({
                icon: "warning",
                title: "Mensaje muy corto",
                text: "El mensaje debe tener al menos 15 caracteres.",
            });
            return;
        }

        // Si todo pasa la validación, enviamos el formulario
        this.submit();
    });
