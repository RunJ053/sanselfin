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
    // Hide all module contents
    const moduleContents = document.querySelectorAll(".module-content");
    moduleContents.forEach((content) => {
        content.classList.add("hidden");
    });

    // Show selected module content
    const selectedContent = document.getElementById(moduleId + "-content");
    if (selectedContent) {
        selectedContent.classList.remove("hidden");
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
            "coupons",
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
            "coupons",
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

//#1234
function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display =
        dropdown.style.display === "block" ? "none" : "block";
}

// Cerrar el menú si se hace clic fuera de él
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
