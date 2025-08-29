<?php

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
use App\Http\Controllers\TareaController;
use App\Http\Controllers\NotificacionController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Models\Notificacion;

//inicio de paginas
Route::GET("/", function () {
    return view("index");
});

//Pagina de ayuda al cliente
Route::GET('/Ayuda-al-cliente', function () {
    return view('pages.ayudar_cliente');
})->name('ayuda_cliente');

//envio de correo
Route::POST('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Verificacion de usuario

Route::GET("/incio_sesion", [LoginController::class, "index"])->name("login");

Route::POST('/login', [AuthController::class, 'login'])->name('iniciarSesion');
Route::POST('/register/user', [AuthController::class, 'registerUser'])->name('register.user');
Route::POST('/register/empleado', [AuthController::class, 'registerEmpleado'])->name('register.empleado');
Route::POST('/verify-admin-code', [AuthController::class, 'verifyAdminCode'])->name('verifyAdminCode');

Route::POST('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth'); // Protege el logout

// Esta es la ruta que tu controlador de registro necesita
Route::GET('/check-email', [VerificationController::class, 'checkEmail'])->name('user.checkEmail');

// Esta es la ruta a la que el usuario hará clic en el correo
Route::GET('/verify/{token}', [VerificationController::class, 'verifyUser'])->name('verification.verify');

// NUEVAS RUTAS PARA RESTABLECIMIENTO DE CONTRASEÑA
Route::GET('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request'); // Muestra el formulario de email
Route::POST('/forgot-password', [AuthController::class, 'sendResetToken'])->name('password.email'); // Envía el token

//RESTABLECER LAS CONTRSEÑAS DESDE EL USURIO YA LOGUEADO
Route::GET('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset.form'); // Muestra el formulario de reset
Route::POST('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update'); // Procesa el reset

// ! Rutas protegidas por rol
Route::middleware(['auth'])->group(function () {

    Route::GET('/dashboard/user', function () {
        $productos = Producto::latest()->take(15)->get();
        $notificaciones = Notificacion::where('usuario_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('index2', compact('productos', 'notificaciones'));
    })->name('user.dashboard');

    // * Notificaciones
    Route::GET('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::patch('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
    Route::POST('/notificaciones', [NotificacionController::class, 'store'])->name('notificaciones.store');

    // ! Rutas de perfil de usuario
    Route::GET('/my-profile', [LoginController::class, 'myProfile'])->name('myProfile');
    Route::GET('/user/edit/{id}', [DatoUsuarioController::class, 'edit'])->name('user.edit');
    Route::PUT('/user/update/{id}', [DatoUsuarioController::class, 'update'])->name('user.update');
    Route::GET('/user/change-password', [DatoUsuarioController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::POST('/user/change-password', [DatoUsuarioController::class, 'changePassword'])->name('user.changePassword');

    // ? Ruta principal para mostrar productos con filtros y búsqueda
    Route::GET('/productos',[ProductoController::class, 'indexUsuarioPro'])->name('producto');

    // ? Ruta para obtener los detalles de un solo producto para el modal (si aún lo necesitas con AJAX)
    // ! Esta ruta devolverá JSON y será consumida por el JavaScript del modal.
    Route::GET('/productos/{id}/details', [ProductoController::class, 'showProductDetails'])->name('productos.details');

    // * Ruta para mostrar la vista del carrito
    Route::GET('/carrito', [CarritoCompraController::class, 'index'])->name('carrito.index');
    Route::patch('/update/{itemId}', [CarritoCompraController::class, 'update'])->name('carrito.update');
    Route::DELETE('/remove/{itemId}', [CarritoCompraController::class, 'remove'])->name('carrito.remove');

    // ! Rutas de la API del carrito (para JS)
    Route::prefix('api/carrito')->group(function () {
        Route::POST('/add', [CarritoCompraController::class, 'add'])->name('api.carrito.add'); // Añadir producto
        Route::GET('/count', [CarritoCompraController::class, 'GETCartCount'])->name('api.carrito.count'); // Obtener conteo
    });

    // * Rutas para la seleccion del destino de envio
    Route::GET('/seleccionar_destino', [OpcionEntregaController::class, 'index'])->name('seleccionar_destino');
    Route::POST('/guardar_destino', [OpcionEntregaController::class, 'store'])->name('procesar.entrega');

    // * Ruta para el metodo de pago
    Route::GET('/metodo_de_pago', [FormaPagoController::class, 'index'])->name('forma_de_pago');
    Route::GET('/checkout/efectivo', [FormaPagoController::class, 'pagarEfectivo'])->name('checkout.efectivo')->middleware('verificar.envio');
    Route::POST('/checkout/payu', [FormaPagoController::class, 'pagarPayU'])->name('checkout.payu')->middleware('verificar.envio');

    // ? Ruta para mostrar los servicios
    Route::GET('/Servicios', function () {
        $notificaciones = Notificacion::where('usuario_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('servicios', compact('notificaciones'));
    })->name('servicio');

    // ? Ruta para el acerca de
    Route::GET('/Acerca/de', function () {
        $notificaciones = Notificacion::where('usuario_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('acerca_de', compact('notificaciones'));
    })->name('acerca_de');

    Route::middleware(['is_admin_or_empleado'])->group(function () { // Usaremos un middleware para administradores
        Route::GET('/dashboard/admin', [InventarioController::class, 'index'])->name('admin.dashboard');

        //Productos
        // Listado de productos
        Route::GET('/inventario', [ProductoController::class, 'index'])->name('producto.index');

        // Formulario de creación
        Route::GET('/producto/create', [ProductoController::class, 'create'])->name('producto.create');

        // Guardar nuevo producto
        Route::POST('/producto/guardar', [ProductoController::class, 'store'])->name('producto.guardar');

        // Editar producto
        Route::GET('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');

        // Actualizar producto
        Route::PUT('/actualizar_producto/{producto}', [ProductoController::class, 'update'])->name('productos.update');

        // Eliminar producto
        Route::DELETE('/productos/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

        //reporte dela admin
        Route::GET('/galeria-productos', [InventarioController::class, 'galeria'])->name('dashboard.index');
    });
});

//tareadel admin
//Route::GET('/dashboard', [TareaController::class, 'index'])->name('dashboard.index');
Route::POST('/dashboard/tareas', [TareaController::class, 'store'])->name('tarea.store');
Route::GET('/dashboard/tareas/hecha/{id}', [TareaController::class, 'marcarHecha'])->name('tarea.hecha');
Route::GET('/dashboard/tareas/eliminar/{id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar');
