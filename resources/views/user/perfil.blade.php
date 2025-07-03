@extends('layouts.users.perfil_Layout')

@section('title', 'Perfil de Usuario')

@section('nav')

@section('content')

<div class="main-container">
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-menu-grid">
            <button class="mobile-menu-item active" onclick="showModule('overview')">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </button>
            <button class="mobile-menu-item" onclick="showModule('cart')">
                <i class="fas fa-shopping-cart"></i>
                <span>Mi Carrito</span>
                <span class="badge">3</span>
            </button>
            <button class="mobile-menu-item" onclick="showModule('orders')">
                <i class="fas fa-box"></i>
                <span>Mis Pedidos</span>
            </button>
            <button class="mobile-menu-item" onclick="showModule('profile')">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
            </button>
            <button class="mobile-menu-item" onclick="showModule('addresses')">
                <i class="fas fa-map-marker-alt"></i>
                <span>Direcciones</span>
            </button>
            <button class="mobile-menu-item" onclick="showModule('notifications')">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
            </button>
        </div>
    </div>

    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-content">
                <h2 class="sidebar-title">Navegación</h2>
                <nav class="nav-menu">
                    <button class="nav-item active" onclick="showModule('overview')">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </button>
                    <button class="nav-item" onclick="showModule('cart')">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Mi Carrito</span>
                        <span class="badge">3</span>
                    </button>
                    <button class="nav-item" onclick="showModule('orders')">
                        <i class="fas fa-box"></i>
                        <span>Mis Pedidos</span>
                    </button>
                    <button class="nav-item" onclick="showModule('profile')">
                        <i class="fas fa-user"></i>
                        <span>Mi Perfil</span>
                    </button>
                    <button class="nav-item" onclick="showModule('addresses')">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Direcciones</span>
                    </button>
                    <button class="nav-item" onclick="showModule('notifications')">
                        <i class="fas fa-bell"></i>
                        <span>Notificaciones</span>
                    </button>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Overview Module -->
            <div id="overview-content" class="module-content">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h2 class="welcome-title">¡Hola, <?php echo session('nombre_usuario') ? session('nombre_usuario') : 'Invitado'; ?> 👋</h2>
                    <p class="welcome-subtitle">Bienvenida a tu dashboard de verduras frescas</p>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <p class="stat-label">Pedidos este mes</p>
                            <p class="stat-value">8</p>
                        </div>
                        <div class="stat-card">
                            <p class="stat-label">Ahorro total</p>
                            <p class="stat-value">$45.000</p>
                        </div>
                        <div class="stat-card">
                            <p class="stat-label">Puntos acumulados</p>
                            <p class="stat-value">320</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Access Modules -->
                <div class="modules-grid">
                    <div class="module-card" onclick="showModule('cart')">
                        <div class="module-header">
                            <div class="module-icon module-cart">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span class="module-badge">3</span>
                        </div>
                        <h3 class="module-title">Mi Carrito</h3>
                        <div class="module-footer">
                            <span>Ver detalles</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="module-card" onclick="showModule('orders')">
                        <div class="module-header">
                            <div class="module-icon module-orders">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                        <h3 class="module-title">Mis Pedidos</h3>
                        <div class="module-footer">
                            <span>Ver detalles</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="module-card" onclick="showModule('profile')">
                        <div class="module-header">
                            <div class="module-icon module-profile">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <h3 class="module-title">Mi Perfil</h3>
                        <div class="module-footer">
                            <span>Ver detalles</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="content-section">
                    <h3 class="section-title">Actividad Reciente</h3>
                    <div class="activity-item success">
                        <div class="activity-icon success">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Pedido #1234 entregado</h4>
                            <p>2 horas ago</p>
                        </div>
                    </div>
                    <div class="activity-item info">
                        <div class="activity-icon info">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Nuevo cupón disponible: 15% OFF</h4>
                            <p>1 día ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Module -->
            <div id="cart-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Mi Carrito de Compras</h2>

                    <div class="cart-item">
                        <div class="cart-item-left">
                            <div class="cart-item-image">
                                <i class="fas fa-carrot"></i>
                            </div>
                            <div class="cart-item-info">
                                <h3>Zanahorias Orgánicas</h3>
                                <p>1 kg</p>
                            </div>
                        </div>
                        <div class="cart-item-right">
                            <p class="cart-item-price">$3.500</p>
                            <p class="cart-item-quantity">Cantidad: 2</p>
                        </div>
                    </div>

                    <div class="cart-item">
                        <div class="cart-item-left">
                            <div class="cart-item-image">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="cart-item-info">
                                <h3>Espinacas Frescas</h3>
                                <p>500 gr</p>
                            </div>
                        </div>
                        <div class="cart-item-right">
                            <p class="cart-item-price">$2.800</p>
                            <p class="cart-item-quantity">Cantidad: 1</p>
                        </div>
                    </div>

                    <div class="cart-total">
                        <div class="cart-total-row">
                            <span class="cart-total-label">Total:</span>
                            <span class="cart-total-value">$9.800</span>
                        </div>
                        <button class="checkout-btn">Proceder al Pago</button>
                    </div>
                </div>
            </div>

            <!-- Other Modules (placeholder) -->
            <div id="orders-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Mis Pedidos</h2>
                    <p>Aquí verás el historial de todos tus pedidos realizados...</p>
                </div>
            </div>

            <div id="profile-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Mi Perfil</h2>
                    <p>Gestiona tu información personal y preferencias...</p>
                    <br>
                    <hr><br>
                    <div class="profile-info">
                        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                        <p><strong>Apellidos:</strong> {{ $usuario->apellidos }}</p>
                        <p><strong>Dirección:</strong> {{ $usuario->direccion }}</p>
                        <p><strong>Tipo de Documento:</strong> {{ $usuario->tipoDocumento->descripcion ?? 'No especificado' }}</p>
                        <p><strong>Número de Documento:</strong> {{ $usuario->documento }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->edad }}</p>
                        <p><strong>Número Telefónico:</strong> {{ $usuario->telefono }}</p>
                        <p><strong>Email:</strong> {{ $usuario->email }}</p>
                        <p><strong>Localidad:</strong> {{ $usuario->datosLocalidad->descripcion ?? 'No especificada' }}</p>
                        <p><strong>Orientación sexual:</strong> {{ $usuario->genero->descripcion_gen ?? 'No especificada' }}</p>
                        <p><strong>Verificado:</strong> {{ $usuario->is_verified ? 'Sí' : 'No' }}</p>
                        <p><strong>Imagen de Usuario:</strong>
                            @if($usuario->user_img)
                                <img src="{{ asset('img/usuario_img/' . $usuario->user_img) }}" alt="Imagen de Perfil" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                            @else
                                No se ha subido imagen de perfil.
                            @endif
                        </p>
                        <p><strong>Imagen del Documento:</strong>
                            @if($usuario->nom_imgs)
                            @php
                                $extension = pathinfo($usuario->nom_imgs, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('img/documents/' . $usuario->nom_imgs) }}" alt="Imagen del Documento" style="max-width: 200px; height: auto;">
                            @elseif($extension == 'pdf')
                                <a href="{{ asset('img/documents/' . $usuario->nom_imgs) }}" target="_blank">Ver Documento PDF</a>
                            @else
                                Tipo de archivo no soportado.
                            @endif
                            @else
                                No se ha subido documento.
                            @endif
                        </p>
                    </div>
                    <div class="profile-actions">
                        <button class="edit-profile-btn"><a href="{{ route('user.edit', $usuario->id) }}">Editar Perfil</a></button>
                        <button class="change-password-btn"><a href="{{ route('user.changePasswordForm', $usuario->id) }}">Cambiar Contraseña</a></button>
                    </div>
                </div>
            </div>

            <div id="favorites-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Mis Favoritos</h2>
                    <p>Productos que has marcado como favoritos...</p>
                </div>
            </div>

            <div id="addresses-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Mis Direcciones</h2>
                    <img style="position: absolute; top: 0; right: 0; width: 22%; height: 40%;" src="{{asset('img/logo/icon.png')}}" alt="Logo">
                    <p>Gestiona las direcciones de entrega...</p>
                    <hr>
                    <p class="profile-info">Agrega, edita o elimina tus direcciones de envío desde tú perfil para facilitar tus compras.</p>
                    <p>Cuando soicites tu pedido te lo enviaremos a la siguiente dirección:</p>
                    </hr>
                    </br>
                    <div class="profile-info">  
                        <p><strong>Tu dirección actual es:</strong> {{ $usuario->direccion }}</p>
                        <p><strong>En la localidad de:</strong> {{ $usuario->datosLocalidad->descripcion ?? 'No especificada' }}</p>
                    </div>
                </div>
            </div>

            <div id="payments-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Métodos de Pago</h2>
                    <p>Administra tus tarjetas y métodos de pago...</p>
                </div>
            </div>

            <div id="notifications-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Notificaciones</h2>
                    <p>Revisa todas tus notificaciones...</p>
                </div>
            </div>

            <div id="settings-content" class="module-content hidden">
                <div class="content-section">
                    <h2 class="section-title">Configuración</h2>
                    <p>Ajusta las configuraciones de tu cuenta...</p>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection