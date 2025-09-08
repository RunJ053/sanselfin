<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','La Finca al Día - Frutas y Verduras Frescas')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" href={{ asset('img/logo/icon.png') }} type="image/x-icon">

    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/NAV.css") }}">
    <link rel="stylesheet" href="{{ asset("css/footer.css") }}">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/hamburguesa.js')}}"></script>
    <script src="{{ asset('https://unpkg.com/aos@2.3.1/dist/aos.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Inicializar AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Funcionalidad del carrusel
        const carousel = document.getElementById('carousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (carousel && prevBtn && nextBtn) {
            const scrollAmount = 300;

            prevBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });

            // Auto-scroll (opcional)
            let isUserInteracting = false;

            carousel.addEventListener('mouseenter', () => {
                isUserInteracting = true;
            });

            carousel.addEventListener('mouseleave', () => {
                isUserInteracting = false;
            });
        }

        // Función para mostrar alerta (placeholder)
        function showAlert() {
            alert('Funcionalidad del carrito disponible después del login');
        }

        function showAlert2(){
            alert('Funcionalidad disponible después del login');
        }

        // Observador para animaciones en scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = '0s';
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observar elementos para animaciones
        document.querySelectorAll('.product-item, .feature-item, .blog-item').forEach(el => {
            observer.observe(el);
        });

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
        window.addEventListener("click", function(event) {
            if (!event.target.closest(".user-avatar")) {
                const dropdown = document.getElementById("dropdownMenu");
                const userAvatar = document.querySelector(".user-avatar");
                dropdown.classList.remove("show");
                userAvatar.setAttribute("aria-expanded", "false");
            }
        });

        // Cerrar menú móvil al cambiar el tamaño de ventana
        window.addEventListener("resize", function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        // Cerrar menú móvil con tecla Escape
        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeMobileMenu();
            }
        });

        // Mejorar navegación por teclado
        document.addEventListener("keydown", function(event) {
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

        //Motrar alerta de suscripción exitosa o error
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('subscribe') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Suscripción exitosa!',
                        text: data.message,
                        confirmButtonText: 'Aceptar'
                    });

                    form.reset(); // Limpia el formulario
                })
                .catch(error => {
                    if (error.errors && error.errors.email) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.errors.email[0],
                            confirmButtonText: 'Cerrar'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error inesperado',
                            text: 'Ocurrió un problema al procesar tu solicitud.',
                            confirmButtonText: 'Cerrar'
                        });
                    }
                });
        });
    </script>
</body>