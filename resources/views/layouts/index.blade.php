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

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>

    </style>

</head>

<body>
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/hamburguesa.js')}}"></script>
    <script src="{{ asset('https://unpkg.com/aos@2.3.1/dist/aos.js')}}"></script>
    <script>
        AOS.init();
    </script>

    <script>
        // Función para mostrar alerta
        function showAlert() {
            alert('Empieza registrandote primero. ¡Y así puedes realizar compras!');
        }

        // Carrusel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('carousel');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const productWidth = 380; // Ancho de cada producto + margen

            prevBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: -productWidth,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: productWidth,
                    behavior: 'smooth'
                });
            });

            // Opcional: Deshabilitar botones cuando no hay más scroll
            carousel.addEventListener('scroll', () => {
                const maxScroll = carousel.scrollWidth - carousel.clientWidth;
                prevBtn.disabled = carousel.scrollLeft <= 0;
                nextBtn.disabled = carousel.scrollLeft >= maxScroll;
            });
        });
    </script>
</body>