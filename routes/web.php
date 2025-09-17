<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoCompraController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\OpcionEntregaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\FacturaDetalleController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ResenaProductoController;
use App\Http\Controllers\NotiController;
use App\Http\Controllers\PedidoController;
use App\Models\{Promocion, Producto, Notificacion, ResenaProducto, CarritoCompra};

// =======================
//  RUTAS PÚBLICAS
// =======================

// Página principal
Route::get("/", function () {
    return view("index");
});

// Página de ayuda al cliente
Route::get('/Ayuda-al-cliente', function () {
    return view('pages.ayudar_cliente');
})->name('ayuda_cliente');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

// =======================
//  AUTENTICACIÓN Y VERIFICACIÓN
// =======================
Route::get("/incio_sesion", [LoginController::class, "index"])->name("login");

Route::post('/login', [AuthController::class, 'login'])->name('iniciarSesion');
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user');
Route::post('/register/empleado', [AuthController::class, 'registerEmpleado'])->name('register.empleado');
Route::post('/verify-admin-code', [AuthController::class, 'verifyAdminCode'])->name('verifyAdminCode');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Verificación
Route::get('/check-email', [VerificationController::class, 'checkEmail'])->name('user.checkEmail');
Route::get('/verify/{token}', [VerificationController::class, 'verifyUser'])->name('verification.verify');

// Restablecimiento de contraseña
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetToken'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// =======================
//  RUTAS PROTEGIDAS (Usuarios Autenticados)
// =======================
Route::middleware(['auth'])->group(function () {

    // Dashboard usuario
    Route::get('/dashboard/user', function () {
        $productos = Producto::latest()->take(15)->get();
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $promociones = Promocion::latest()->take(3)->get();
        $carritoCount = CarritoCompra::where('usuario', auth()->id())->count();
        $resenas = ResenaProducto::with('usuario', 'producto')->latest()->take(10)->get();

        return view('index2', compact('productos', 'notificaciones', 'promociones', 'carritoCount', 'resenas'));
    })->name('user.dashboard');

    // Notificaciones
    Route::get('/notificacion', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::post('/notificacion', [NotificacionController::class, 'store'])->name('notificaciones.store');
    Route::patch('/notificaciones/marcar-todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.marcarTodasLeidas');
    Route::delete('/notificaciones/eliminar-todas', [NotificacionController::class, 'eliminarTodas'])->name('notificaciones.eliminarTodas');
    Route::delete('/notificaciones/eliminar-seleccionadas', [NotificacionController::class, 'eliminarSeleccionadas'])->name('notificaciones.eliminarSeleccionadas');
    Route::patch('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
    Route::delete('/notificaciones/{id}', [NotificacionController::class, 'destroy'])->name('notificaciones.destroy');


    // Perfil de usuario
    Route::get('/my-profile', [LoginController::class, 'myProfile'])->name('myProfile');
    Route::get('/user/edit/{id}', [DatoUsuarioController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [DatoUsuarioController::class, 'update'])->name('user.update');
    Route::get('/user/change-password', [DatoUsuarioController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::post('/user/change-password', [DatoUsuarioController::class, 'changePassword'])->name('user.changePassword');
    Route::get('/user/mi_historial', [DatoUsuarioController::class, 'miHistorial'])->name('user.mi_historial');
    Route::post('/user/mi_historial', [DatoUsuarioController::class, 'miHistorial'])->name('facturacion.verFactura');

    // Productos
    Route::get('/productos', [ProductoController::class, 'indexUsuarioPro'])->name('producto');
    Route::get('/productos/{id}/details', [ProductoController::class, 'showProductDetails'])->name('productos.details');

    // Carrito
    Route::get('/carrito', [CarritoCompraController::class, 'index'])->name('carrito.index');
    Route::patch('/update/{itemId}', [CarritoCompraController::class, 'update'])->name('carrito.update');
    Route::delete('/remove/{itemId}', [CarritoCompraController::class, 'remove'])->name('carrito.remove');
    Route::delete('/carrito/vaciar', [CarritoCompraController::class, 'vaciar'])->name('carrito.vaciar');

    // API Carrito
    Route::prefix('api/carrito')->group(function () {
        Route::POST('/add', [CarritoCompraController::class, 'add'])->name('api.carrito.add');
        Route::GET('/count', [CarritoCompraController::class, 'GETCartCount'])->name('api.carrito.count');
    });

    // Opción entrega
    Route::get('/seleccionar_destino', [OpcionEntregaController::class, 'index'])->name('seleccionar_destino');
    Route::post('/guardar_destino', [OpcionEntregaController::class, 'store'])->name('procesar.entrega');

    // Métodos de pago
    Route::get('/metodo_de_pago', [FormaPagoController::class, 'index'])->name('forma_de_pago');
    Route::get('/checkout/efectivo', [FormaPagoController::class, 'pagarEfectivo'])->name('checkout.efectivo')->middleware('verificar.envio');

    // PayU
    Route::post('/checkout/payu', [FormaPagoController::class, 'pagarPayU'])->name('checkout.payu')->middleware('verificar.envio');
    Route::get('/checkout/payu/response', function () {
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', auth()->id())->count();
        return view('facturacion.respuestaPayu', compact('notificaciones', 'carritoCount'));
    })->name('checkout.payu.response');
    Route::post('/checkout/payu/confirmation', [FormaPagoController::class, 'confirmarPayU'])->name('checkout.payu.confirmation');

    // Facturas
    Route::get('/factura/{pedido}', [FacturaDetalleController::class, 'verFactura'])->name('facturacion.verFacturaCompra');
    Route::get('/factura/{pedido}/pdf', [FacturaDetalleController::class, 'verFacturaPdf'])->name('facturacion.verFacturaPdf');

    // Reseñas
    Route::prefix('resenas')->group(function () {
        Route::get('/', [ResenaProductoController::class, 'index'])->name('resenas.index');
        Route::post('/{producto}', [ResenaProductoController::class, 'store'])->name('resenas.store');
        Route::get('/{resena}/edit', [ResenaProductoController::class, 'edit'])->name('resenas.edit');
        Route::put('/{resena}', [ResenaProductoController::class, 'update'])->name('resenas.update');
        Route::delete('/{resena}', [ResenaProductoController::class, 'destroy'])->name('resenas.destroy');
    });

    // Servicios
    Route::get('/Servicios', function () {
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', auth()->id())->count();
        return view('servicios', compact('notificaciones', 'carritoCount'));
    })->name('servicio');

    // Acerca de
    Route::get('/Acerca/de', function () {
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', auth()->id())->count();
        return view('acerca_de', compact('notificaciones', 'carritoCount'));
    })->name('acerca_de');

    // Contacto
    Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

    // =======================
    //  RUTAS DE ADMINISTRACIÓN
    // =======================
    Route::middleware(['is_admin_or_empleado'])->group(function () {

        Route::get('/dashboard/admin', [InventarioController::class, 'index'])->name('admin.dashboard');

        // Productos
        Route::get('/inventario', [ProductoController::class, 'index'])->name('producto.index');
        Route::get('/producto/create', [ProductoController::class, 'create'])->name('producto.create');
        Route::post('/producto/guardar', [ProductoController::class, 'store'])->name('producto.guardar');
        Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
        Route::put('/actualizar_producto/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

        // Reportes
        Route::get('/galeria-productos', [InventarioController::class, 'galeria'])->name('galeria.index');

        // Tarjetas
        Route::post('/tarjetas/productos', [AdminController::class, 'tarjetaProducto'])->name('tarjeta.Producto');
        Route::post('/tarjetas/stock', [AdminController::class, 'tarjetaStock'])->name('tarjeta.Stock');
        Route::post('/tarjetas/pedidos', [AdminController::class, 'tarjetaPedido'])->name('tarjeta.Pedido');

        // Usuarios
        Route::get('/usuarios', [AdminController::class, 'index'])->name('usuario.index');
        Route::get('/usuarios/create', [AdminController::class, 'create'])->name('usuario.create');
        Route::post('/usuarios', [AdminController::class, 'store'])->name('usuario.store');
        Route::get('/usuarios/{id}/edit', [AdminController::class, 'edit'])->name('usuario.edit');
        Route::put('/usuarios/{id}', [AdminController::class, 'update'])->name('usuario.update');
        Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('usuario.destroy');

        //pedidos y notificaciones
        Route::get('/notificaciones', [NotiController::class, 'index'])->name('admin.noti_admin');
        Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::put('/admin/pedidos/{pedido}/estado', [PedidoController::class, 'cambiarEstado'])->name('admin.pedidos.cambiarEstado');

        //Reportes de ventas, perdidas y ganancias
        Route::prefix('reportes')->group(function () {
            Route::get('/', [ReporteController::class, 'financieros'])->name('reportes.financieros');
            Route::post('/registrar-gasto', [ReporteController::class, 'storeGasto'])->name('reportes.storeGasto');
            Route::post('/registrar-perdida', [ReporteController::class, 'storePerdida'])->name('reportes.storePerdida');
            Route::post('/registrar-ingreso', [ReporteController::class, 'storeIngreso'])->name('reportes.storeIngreso');
            Route::get('/reportes/export-excel', [ReporteController::class, 'exportExcel'])->name('reportes.exportExcel');
            Route::get('/reportes/export-pdf', [ReporteController::class, 'exportPdf'])->name('reportes.exportPdf');
        });

        Route::get('/reportes/pdf', [ReporteController::class, 'exportPdf'])->name('reportes.pdf');

        //Route::get('/dashboard', [TareaController::class, 'index'])->name('dashboard.index');
        Route::post('/dashboard/tareas', [TareaController::class, 'store'])->name('tarea.store');
        Route::get('/dashboard/tareas/hecha/{id}', [TareaController::class, 'marcarHecha'])->name('tarea.hecha');
        Route::get('/dashboard/tareas/eliminar/{id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar');
    });
});
