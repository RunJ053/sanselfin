function toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const menuToggle = document.querySelector(".menu-toggle");

    mobileMenu.classList.toggle("active");
    mobileOverlay.classList.toggle("active");
    menuToggle.classList.toggle("active");

    // Actualizar aria-expanded
    const isExpanded = mobileMenu.classList.contains("active");
    menuToggle.setAttribute("aria-expanded", isExpanded);

    // Prevenir scroll del body cuando el menú está abierto
    document.body.style.overflow = isExpanded ? "hidden" : "";
}

// Cerrar menú móvil
function closeMobileMenu() {
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const menuToggle = document.querySelector(".menu-toggle");

    mobileMenu.classList.remove("active");
    mobileOverlay.classList.remove("active");
    menuToggle.classList.remove("active");
    menuToggle.setAttribute("aria-expanded", "false");

    // Restaurar scroll del body
    document.body.style.overflow = "";
}

// Toggle del dropdown de usuario
function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    const userAvatar = document.querySelector(".user-avatar");

    dropdown.classList.toggle("show");

    // Actualizar aria-expanded
    const isExpanded = dropdown.classList.contains("show");
    userAvatar.setAttribute("aria-expanded", isExpanded);
}

// Cerrar dropdown al hacer clic fuera
window.addEventListener("click", function (event) {
    if (!event.target.closest(".user-avatar")) {
        const dropdown = document.getElementById("dropdownMenu");
        const userAvatar = document.querySelector(".user-avatar");
        dropdown.classList.remove("show");
        userAvatar.setAttribute("aria-expanded", "false");
    }
});

// Cerrar menú móvil al cambiar el tamaño de ventana
window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
        closeMobileMenu();
    }
});

// Cerrar menú móvil con tecla Escape
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeMobileMenu();
    }
});

// Mejorar navegación por teclado
document.addEventListener("keydown", function (event) {
    if (event.key === "Tab") {
        const mobileMenu = document.getElementById("mobileMenu");
        if (mobileMenu.classList.contains("active")) {
            // Mantener el foco dentro del menú móvil
            const focusableElements = mobileMenu.querySelectorAll("a, button");
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (event.shiftKey && document.activeElement === firstElement) {
                lastElement.focus();
                event.preventDefault();
            } else if (
                !event.shiftKey &&
                document.activeElement === lastElement
            ) {
                firstElement.focus();
                event.preventDefault();
            }
        }
    }
});
