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
    <!-- OVERLAY DE LOADING MEJORADO -->
                <div id="loading-overlay"
                    class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex flex-col items-center justify-center z-[9999]">

                    <!-- Contenedor principal con glassmorphism -->
                    <div class="relative bg-white bg-opacity-10 backdrop-blur-md rounded-3xl p-12 border border-white border-opacity-20 shadow-2xl max-w-sm mx-auto">

                        <!-- Anillos de pulso en el fondo -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-32 h-32 rounded-full border-2 border-green-400 border-opacity-30 animate-pulse-ring"></div>
                            <div class="absolute w-32 h-32 rounded-full border-2 border-emerald-400 border-opacity-40 animate-pulse-ring" style="animation-delay: 0.5s;"></div>
                            <div class="absolute w-32 h-32 rounded-full border-2 border-green-300 border-opacity-20 animate-pulse-ring" style="animation-delay: 1s;"></div>
                        </div>

                        <!-- Contenedor del ícono con efectos -->
                        <div class="relative z-10 text-center">
                            <!-- Círculo de fondo con gradiente -->
                            <div class="relative mx-auto mb-8 w-24 h-24">
                                <div class="absolute inset-0 bg-gradient-to-br from-green-400 via-emerald-500 to-green-600 rounded-full animate-pulse shadow-lg shadow-green-500/30"></div>
                                <div class="absolute inset-0 bg-gradient-to-br from-green-400 via-emerald-500 to-green-600 rounded-full animate-float opacity-80"></div>

                                <!-- Carrito animado -->
                                <div class="relative z-10 flex items-center justify-center h-full">
                                    <svg class="w-12 h-12 text-white animate-bounce"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9h12l-2-9M9 21h.01M15 21h.01" />
                                    </svg>
                                </div>

                                <!-- Partículas flotantes -->
                                <div class="absolute -top-2 -right-2 w-3 h-3 bg-yellow-400 rounded-full animate-ping"></div>
                                <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-blue-400 rounded-full animate-ping" style="animation-delay: 0.5s;"></div>
                                <div class="absolute top-1 -left-3 w-1.5 h-1.5 bg-purple-400 rounded-full animate-ping" style="animation-delay: 1s;"></div>
                            </div>

                            <!-- Texto principal con efectos -->
                            <div class="space-y-3">
                                <h3 class="text-2xl font-bold text-white mb-2 animate-float" style="animation-delay: 0.2s;">
                                    Procesando...
                                </h3>
                                <p class="text-gray-200 text-base leading-relaxed animate-float" style="animation-delay: 0.4s;">
                                    Procesando tu compra, por favor espera...
                                </p>

                                <!-- Barra de progreso animada -->
                                <div class="mt-6 w-full bg-gray-700 bg-opacity-50 rounded-full h-2 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-400 to-emerald-500 rounded-full animate-shimmer"></div>
                                </div>

                                <!-- Puntos de carga -->
                                <div class="flex justify-center space-x-2 mt-4">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.3s;"></div>
                                </div>

                                <!-- Texto adicional -->
                                <p class="text-gray-400 text-sm mt-4 animate-pulse">
                                    No cierres esta ventana
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    <x-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
    <script src="{{ asset('js/hamburguesa.js')}}"></script>
</body>