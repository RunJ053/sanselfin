let currentModule = "overview";
let isMobileMenuOpen = false;

function toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    const menuIcon = document.getElementById("menu-icon");

    isMobileMenuOpen = !isMobileMenuOpen;

    if (isMobileMenuOpen) {
        mobileMenu.classList.add("active");
        menuIcon.className = "fas fa-times";
    } else {
        mobileMenu.classList.remove("active");
        menuIcon.className = "fas fa-bars";
    }
}

function showModule(moduleId) {
    console.log("Mostrando módulo:", moduleId);
    
    // Hide all module contents
    const moduleContents = document.querySelectorAll(".module-content");
    moduleContents.forEach((content) => {
        content.classList.add("hidden");
    });

    // Show selected module content
    const selectedContent = document.getElementById(moduleId + "-content");
    if (selectedContent) {
        selectedContent.classList.remove("hidden");
        console.log("Contenido mostrado:", moduleId + "-content");
    } else {
        console.log("No se encontró el contenido para:", moduleId + "-content");
    }

    // Update navigation active states
    updateNavigation(moduleId);

    currentModule = moduleId;

    // Close mobile menu if open
    if (isMobileMenuOpen) {
        toggleMobileMenu();
    }
}

function updateNavigation(activeModuleId) {
    // Update sidebar navigation
    const sidebarItems = document.querySelectorAll(".sidebar .nav-item");
    sidebarItems.forEach((item, index) => {
        const moduleIds = [
            "overview",
            "cart",
            "orders",
            "profile",
            "addresses",
            "notifications",
        ];
        if (moduleIds[index] === activeModuleId) {
            item.classList.add("active");
        } else {
            item.classList.remove("active");
        }
    });

    // Update mobile menu navigation
    const mobileItems = document.querySelectorAll(
        ".mobile-menu .mobile-menu-item"
    );
    mobileItems.forEach((item, index) => {
        const moduleIds = [
            "overview",
            "cart",
            "orders",
            "profile",
            "addresses",
            "notifications",
        ];
        if (moduleIds[index] === activeModuleId) {
            item.classList.add("active");
        } else {
            item.classList.remove("active");
        }
    });
}

// Close mobile menu when clicking outside
document.addEventListener("click", function (event) {
    const mobileMenu = document.getElementById("mobile-menu");
    const menuToggle = document.querySelector(".menu-toggle");

    if (
        isMobileMenuOpen &&
        !mobileMenu.contains(event.target) &&
        !menuToggle.contains(event.target)
    ) {
        toggleMobileMenu();
    }
});

// Handle window resize
window.addEventListener("resize", function () {
    if (window.innerWidth > 1024 && isMobileMenuOpen) {
        toggleMobileMenu();
    }
});

// Dropdown toggle
function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display =
        dropdown.style.display === "block" ? "none" : "block";
}

// Close dropdown if clicked outside
window.onclick = function (event) {
    if (!event.target.matches(".user-avatar")) {
        const dropdowns = document.getElementsByClassName("dropdown-menu");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
};

// Llamar a la función al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Obtener la sección desde la URL si está presente
    const urlParams = new URLSearchParams(window.location.search);
    const sectionFromUrl = urlParams.get('section');
    
    // Usar el parámetro de la URL o el de Laravel
    const section = sectionFromUrl || '{{ $section ?? "" }}';
    
    console.log("Sección detectada:", section);
    
    if (section && section.trim() !== '') {
        showModule(section);
    } else {
        // Mostrar módulo por defecto si no hay sección específica
        showModule('overview');
    }
});

