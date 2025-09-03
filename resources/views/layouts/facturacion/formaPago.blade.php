<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/NAV.css')}}">
    <link rel="stylesheet" href="{{ asset('css/FORMA_PAGO.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-subtle': 'bounce 2s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .payment-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .payment-card:hover {
            transform: translateY(-8px) scale(1.03);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.25);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-green-50 min-h-screen">
    @yield('content')
    <x-navbar :notificaciones="$notificaciones" />
    <script src="{{ asset('js/hamburguesa.js')}}"></script>
    <script>
        // Manejar el envío del formulario de efectivo
        Swal.fire({
            title: 'Procesando tu pago',
            html: `<div class="cart-loader">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" class="cart-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9h12l-2-9M9 21h.01M15 21h.01" />
            </svg>
        </div>
        <p class="mt-3">Por favor espera...</p>
    `,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                // Nada, el carrito se mueve solo con CSS
            }
        });

        // Añadir efecto de hover suave a las tarjetas
        document.querySelectorAll('.group').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>