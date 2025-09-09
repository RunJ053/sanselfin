<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','La Finca al Día - Frutas y Verduras Frescas')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/styleII.css') }}">
    <link rel="stylesheet" href="{{ asset('css/NAV.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        class ProductCarousel {
            constructor() {
                this.carousel = document.querySelector('.carousel-container');
                this.track = document.querySelector('.carousel-track');
                this.prevButton = document.querySelector('.carousel-controls.prev');
                this.nextButton = document.querySelector('.carousel-controls.next');
                this.indicators = document.querySelector('.carousel-indicators');
                this.products = document.querySelectorAll('.product-item');

                this.currentIndex = 0;
                this.itemsPerView = this.getItemsPerView();
                this.maxIndex = Math.max(0, this.products.length - this.itemsPerView);

                this.init();
            }

            init() {
                this.createIndicators();
                this.bindEvents();
                this.updateCarousel();
                this.startAutoPlay();

                // Actualizar en resize
                window.addEventListener('resize', () => {
                    this.itemsPerView = this.getItemsPerView();
                    this.maxIndex = Math.max(0, this.products.length - this.itemsPerView);
                    this.currentIndex = Math.min(this.currentIndex, this.maxIndex);
                    this.updateCarousel();
                });
            }

            getItemsPerView() {
                const containerWidth = this.carousel.offsetWidth;
                const itemWidth = 280 + 16; // ancho del item + gap
                return Math.floor(containerWidth / itemWidth) || 1;
            }

            createIndicators() {
                const indicatorCount = this.maxIndex + 1;
                this.indicators.innerHTML = '';

                for (let i = 0; i < indicatorCount; i++) {
                    const indicator = document.createElement('div');
                    indicator.className = 'indicator';
                    indicator.addEventListener('click', () => this.goToSlide(i));
                    this.indicators.appendChild(indicator);
                }
            }

            bindEvents() {
                this.prevButton.addEventListener('click', () => this.prevSlide());
                this.nextButton.addEventListener('click', () => this.nextSlide());

                // Touch/swipe support
                let startX = 0;
                let startY = 0;
                let isDragging = false;

                this.track.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                    isDragging = true;
                    this.pauseAutoPlay();
                });

                this.track.addEventListener('touchmove', (e) => {
                    if (!isDragging) return;
                    e.preventDefault();
                });

                this.track.addEventListener('touchend', (e) => {
                    if (!isDragging) return;

                    const endX = e.changedTouches[0].clientX;
                    const endY = e.changedTouches[0].clientY;
                    const diffX = startX - endX;
                    const diffY = startY - endY;

                    // Solo si el movimiento es más horizontal que vertical
                    if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                        if (diffX > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }

                    isDragging = false;
                    this.startAutoPlay();
                });

                // Pausar autoplay al hover
                this.carousel.addEventListener('mouseenter', () => this.pauseAutoPlay());
                this.carousel.addEventListener('mouseleave', () => this.startAutoPlay());
            }

            updateCarousel() {
                const translateX = -(this.currentIndex * (280 + 16)); // ancho + gap
                this.track.style.transform = `translateX(${translateX}px)`;

                // Actualizar indicadores
                const indicatorElements = this.indicators.querySelectorAll('.indicator');
                indicatorElements.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === this.currentIndex);
                });

                // Actualizar estado de los botones
                this.prevButton.style.opacity = this.currentIndex === 0 ? '0.5' : '1';
                this.nextButton.style.opacity = this.currentIndex === this.maxIndex ? '0.5' : '1';
            }

            nextSlide() {
                if (this.currentIndex < this.maxIndex) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0; // Loop al inicio
                }
                this.updateCarousel();
            }

            prevSlide() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.maxIndex; // Loop al final
                }
                this.updateCarousel();
            }

            goToSlide(index) {
                this.currentIndex = Math.max(0, Math.min(index, this.maxIndex));
                this.updateCarousel();
            }

            startAutoPlay() {
                this.pauseAutoPlay(); // Limpiar cualquier intervalo existente
                this.autoPlayInterval = setInterval(() => {
                    this.nextSlide();
                }, 4000); // Cambiar cada 4 segundos
            }

            pauseAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            }
        }

        // Inicializar el carrusel cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', () => {
            new ProductCarousel();
        });

        // Animación de aparición progresiva
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observar elementos cuando se carga la página
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.animate-fade-in-up');
            animatedElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                el.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(el);
            });
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