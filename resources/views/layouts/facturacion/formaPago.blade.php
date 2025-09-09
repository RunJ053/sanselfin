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

        /* Estilo para el overlay*/
        @keyframes pulse-ring {
            0% { transform: scale(0.33); }
            80%, 100% { transform: scale(1.2); opacity: 0; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .animate-pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-green-50 min-h-screen">
    @yield('content')
    <x-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
    <script src="{{ asset('js/hamburguesa.js')}}"></script>
</body>