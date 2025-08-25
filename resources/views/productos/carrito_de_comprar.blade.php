<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Es CRUCIAL para peticiones AJAX --}}
    <title>Tu Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/CARRITO.css')}}">
    <link rel="stylesheet" href="{{asset('css/NAV.css')}}">
</head>

<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <!-- Logo -->
        <div class="nav-left">
            <a href="{{ route('user.dashboard') }}" class="logo-link">
                <img src="{{asset ('img/logo/icon.png')}}" alt="Logo de La Finca al Día" width="120" height="40">
            </a>
        </div>

        <!-- Enlaces de navegación centrales -->
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="{{ route('user.dashboard') }}" role="menuitem">Inicio</a></li>
                <li role="none"><a href="{{ route('producto') }}" role="menuitem">Productos</a></li>
                <li role="none"><a href="{{ route('servicio')}}" role="menuitem">Servicios</a></li>
                <li role="none"><a href="{{ route('acerca_de')}}" role="menuitem">Acerca de</a></li>
            </ul>
        </div>

        <!-- Acciones de la derecha -->
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="/notificaciones" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
                <li role="none">
                    <a href="/carrito" role="menuitem" aria-label="Carrito de Compras">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="visually-hidden">Carrito</span>
                    </a>
                </li>
                <li role="none">
                    <a href="/ayuda" role="menuitem" aria-label="Ayuda">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Ayuda</span>
                    </a>
                </li>
            </ul>

            <!-- Avatar de usuario -->
            <div class="user-avatar" onclick="toggleDropdown()" role="button" aria-haspopup="true" aria-expanded="false">
                @auth <!-- Verificamos que el usuario esté autenticado -->
                @if (Auth::user()->user_img)
                <img src="{{ asset('img/usuario_img/' . Auth::user()->user_img) }}"
                    alt="Avatar de {{ Auth::user()->nombre }}"
                    class="avatar-image">
                @else
                <i class="fas fa-user"></i>
                @endif
                @endauth

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('myProfile') }}" class="dropdown-item">Mi Perfil</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>

                </div>
            </div>

            <!-- Botón hamburguesa -->
            <button class="menu-toggle" onclick="toggleMobileMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Overlay para móvil -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

    <!-- Menú móvil -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <button class="mobile-menu-close" onclick="closeMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Enlaces de navegación móvil -->
        <ul class="mobile-nav-links">
            <li><a href="{{ route('user.dashboard') }}">Inicio</a></li>
            <li><a href="{{ route('producto') }}">Productos</a></li>
            <li><a href="{{ route('servicio')}}">Servicios</a></li>
            <li><a href="{{ route('acerca_de')}}">Acerca de</a></li>
        </ul>

        <!-- Acciones móvil -->
        <ul class="mobile-nav-actions">
            <li>
                <a href="/notificaciones">
                    <i class="fas fa-bell"></i>
                    <span>Notificaciones</span>
                </a>
            </li>
            <li>
                <a href="/carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrito de Compras</span>
                </a>
            </li>
            <li>
                <a href="{{ route('ayuda_cliente') }}">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Necesito Ayuda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
    <section data-aos="zoom-in-down" class="hero">
        <div class="container">
            <div class="hero-text">
                <h2>La Finca al Día te Da La Bienvenida a</h2>
                <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Tu Carrito Unico y Exclusivo</h1>
            </div>
        </div>
    </section>
    <div class="carrito-contenedor">
        <h1>🌿 Tu Mercado Verde de la Finca 🥕</h1>
        <div class="productos" id="lista-productos">
            {{-- Aquí se cargarán los productos del carrito dinámicamente --}}
            <p id="carrito-vacio-mensaje" style="text-align: center; color: #777; font-style: italic; display: none;">
                Tu carrito está vacío. ¡Explora nuestros productos y añade algo delicioso!
            </p>
        </div>

        <div class="resumen-carrito">
            <h2>Resumen de Compra</h2>
            <div class="lista-items" id="items-carrito">
                {{-- Aquí se cargarán los subtotales de cada producto y el total --}}
            </div>

            <div class="descuentos">
                <input type="text" id="codigo-descuento" placeholder="Código de descuento">
                <button class="boton-descuento" onclick="aplicarDescuento()">Aplicar Cupón</button>
            </div>

            <div class="total-seccion">
                <span>Total:</span>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <span id="total-compra" class="input-group-text">0.00</span>
                </div>
            </div>
            <div class="total-seccion">
                <span>¡Ya está tu carrito Listo!</span>
                <button class="boton-descuento"><a style="text-decoration: none; color: beige;" href="../facturacion/FORMA_PAGO.html">Ir al pago</a></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const listaProductosDiv = document.getElementById('lista-productos');
        const itemsCarritoDiv = document.getElementById('items-carrito');
        const totalCompraSpan = document.getElementById('total-compra');
        const carritoVacioMensaje = document.getElementById('carrito-vacio-mensaje');

        document.addEventListener('DOMContentLoaded', () => {
            loadCartItems();
        });

        /**
         * Carga los ítems del carrito desde el servidor y los muestra en la vista.
         */
        async function loadCartItems() {
            try {
                const response = await fetch('{{ route("api.carrito.index") }}', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Error al cargar el carrito.');
                }

                renderCart(data.items, data.total);

            } catch (error) {
                console.error('Error al cargar el carrito:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error al cargar carrito',
                    text: error.message || 'No se pudieron cargar los productos de tu carrito.',
                });
                renderCart([], 0); // Muestra un carrito vacío en caso de error
            }
        }

        /**
         * Renderiza los productos y el resumen del carrito en la interfaz.
         * @param {Array} items - Array de objetos de productos en el carrito.
         * @param {number} total - El total de la compra.
         */
        function renderCart(items, total) {
            listaProductosDiv.innerHTML = ''; // Limpia el contenedor de productos
            itemsCarritoDiv.innerHTML = ''; // Limpia el resumen del carrito

            if (items.length === 0) {
                carritoVacioMensaje.style.display = 'block'; // Muestra el mensaje de carrito vacío
            } else {
                carritoVacioMensaje.style.display = 'none'; // Oculta el mensaje
                items.forEach(item => {
                    const productoHtml = `
                        <div class="producto-item">
                            <img src="${item.producto.imagen || 'ruta/a/imagen/por/defecto.jpg'}" alt="${item.producto.nombre}">
                            <div class="producto-details">
                                <h3>${item.producto.nombre}</h3>
                                <p>Categoría: ${item.producto.categoria?.nombre || 'Sin categoría'}</p>
                            </div>
                            <div class="producto-quantity">
                                <button onclick="updateQuantity(${item.id}, ${item.cantidad - 1})">-</button>
                                <input type="number" value="${item.cantidad}" min="1"
                                    onchange="updateQuantity(${item.id}, this.value)">
                                <button onclick="updateQuantity(${item.id}, ${item.cantidad + 1})">+</button>
                            </div>
                            <span class="producto-price">$${parseFloat(item.subtotal).toFixed(2)}</span>
                            <button class="remove-item-button" onclick="removeItem(${item.id})">x</button>
                        </div>
                    `;
                    listaProductosDiv.innerHTML += productoHtml;

                    const resumenItemHtml = `
                        <div>
                            <span>${item.cantidad} x ${item.producto.nombre}</span>
                            <span>$${parseFloat(item.subtotal).toFixed(2)}</span>
                        </div>
                    `;
                    itemsCarritoDiv.innerHTML += resumenItemHtml;
                });
            }

            totalCompraSpan.textContent = parseFloat(total).toFixed(2);
        }

        /**
         * Actualiza la cantidad de un producto en el carrito.
         * @param {number} itemId - El ID del ítem en el carrito (registro de la tabla carrito_compras).
         * @param {number} newQuantity - La nueva cantidad deseada.
         */
        async function updateQuantity(itemId, newQuantity) {
            newQuantity = parseInt(newQuantity);
            if (isNaN(newQuantity) || newQuantity < 1) {
                Swal.fire('Cantidad inválida', 'La cantidad debe ser al menos 1.', 'warning');
                loadCartItems(); // Recargar para restaurar la cantidad anterior
                return;
            }

            try {
                const response = await fetch(`/api/carrito/update/${itemId}`, { // Necesitarás crear esta ruta
                    method: 'POST', // O PUT/PATCH si tu API REST lo prefiere
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        cantidad: newQuantity
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Error al actualizar la cantidad.');
                }

                Swal.fire('¡Actualizado!', data.message, 'success');
                loadCartItems(); // Recargar el carrito para ver los cambios

            } catch (error) {
                console.error('Error al actualizar cantidad:', error);
                Swal.fire('Error', error.message || 'No se pudo actualizar la cantidad.', 'error');
                loadCartItems(); // Recargar para restaurar la cantidad
            }
        }

        /**
         * Elimina un producto del carrito.
         * @param {number} itemId - El ID del ítem en el carrito (registro de la tabla carrito_compras).
         */
        async function removeItem(itemId) {
            Swal.fire({
                // ... (tu código de confirmación de SweetAlert) ...
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        // *** ¡ASEGÚRATE DE USAR LA FUNCIÓN route() DE BLADE AQUÍ! ***
                        const response = await fetch(`{{ route("api.carrito.remove", ["itemId" => "ITEM_ID_PLACEHOLDER"]) }}`.replace('ITEM_ID_PLACEHOLDER', itemId), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN,
                                'Content-Type': 'application/json' // Es buena práctica si no envías formData
                            }
                            // No necesitas body si solo envías el ID en la URL
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Error al eliminar el producto.');
                        }

                        Swal.fire('¡Eliminado!', data.message, 'success');
                        loadCartItems(); // Recargar el carrito para ver los cambios
                        // Opcional: Actualizar el conteo del carrito en el nav si la API lo devuelve
                        if (data.cart_count !== undefined) {
                            // Esta función `updateCartCount` debe ser global o accesible aquí
                            // Si no la tienes, simplemente omite esta línea o implementa una simple aquí
                            // const cartCountElement = document.querySelector('.nav-actions a[href="/carrito"] .cart-count');
                            // if (cartCountElement) { cartCountElement.textContent = data.cart_count; }
                        }

                    } catch (error) {
                        console.error('Error al eliminar producto:', error);
                        Swal.fire('Error', error.message || 'No se pudo eliminar el producto.', 'error');
                    }
                }
            });
        }


        // Función dummy para aplicar descuento (requeriría lógica de backend)
        function aplicarDescuento() {
            const codigo = document.getElementById('codigo-descuento').value;
            Swal.fire('Función no implementada', `Aplicar descuento para "${codigo}" (requiere lógica de backend)`, 'info');
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../js/carrito.js"></script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
</body>

</html>