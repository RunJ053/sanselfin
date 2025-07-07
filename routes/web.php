<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoCompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//inicio de paginas
Route::get("/", function () {
    return view("index");
});

Route::get('/Ayuda-al-cliente', function () {
    return view('pages.ayudar_cliente');
})->name('ayuda_cliente');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Verificacion de usuario

Route::get("/incio_sesion", [LoginController::class, "index"])->name("login");

Route::post('/login', [AuthController::class, 'login'])->name('iniciarSesion');
Route::post('/register', [AuthController::class, 'register'])->name('registrarUsuario');
Route::post('/verify-admin-code', [AuthController::class, 'verifyAdminCode'])->name('verifyAdminCode');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth'); // Protege el logout

// NUEVAS RUTAS PARA RESTABLECIMIENTO DE CONTRASEÑA
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request'); // Muestra el formulario de email
Route::post('/forgot-password', [AuthController::class, 'sendResetToken'])->name('password.email'); // Envía el token
//RESTABLECER LAS CONTRSEÑAS DESDE EL USURIO YA LOGUEADO
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset.form'); // Muestra el formulario de reset
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update'); // Procesa el reset

// Rutas protegidas por rol
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/user', function () {
        return view('index2');
    })->name('user.dashboard');

    //Rutas de perfil de usuario
    Route::get('/my-profile', [LoginController::class, 'myProfile'])->name('myProfile');
    Route::get('/user/edit/{id}', [DatoUsuarioController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [DatoUsuarioController::class, 'update'])->name('user.update');
    Route::get('/user/change-password', [DatoUsuarioController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::post('/user/change-password', [DatoUsuarioController::class, 'changePassword'])->name('user.changePassword');

    // Ruta principal para mostrar productos con filtros y búsqueda
    Route::get('/productos', [ProductoController::class, 'indexUsuarioPro'])->name('producto');

    // Ruta para obtener los detalles de un solo producto para el modal (si aún lo necesitas con AJAX)
    // Esta ruta devolverá JSON y será consumida por el JavaScript del modal.
    Route::get('/productos/{id}/details', [ProductoController::class, 'showProductDetails'])->name('productos.details');

    // Ruta para mostrar la vista del carrito (no es una API, es una vista)
    Route::get('/carrito', function () {
        return view('productos.carrito_de_comprar'); // Asegúrate de que 'pages.carrito_compra' sea la ruta correcta a tu vista del carrito
    })->name('carrito.index');

    // Rutas de la API del carrito (para JS)
    Route::prefix('api/carrito')->group(function () {
        Route::get('/', [CarritoCompraController::class, 'index'])->name('api.carrito.index'); // Obtener todos los ítems
        Route::post('/add', [CarritoCompraController::class, 'add'])->name('api.carrito.add'); // Añadir producto
        Route::get('/count', [CarritoCompraController::class, 'getCartCount'])->name('api.carrito.count'); // Obtener conteo
        Route::post('/update/{itemId}', [CarritoCompraController::class, 'update'])->name('api.carrito.update'); // ¡Asegúrate de tener el método update en el controlador!
        // Nueva ruta para eliminar un ítem
        Route::post('/remove/{itemId}', [CarritoCompraController::class, 'remove'])->name('api.carrito.remove'); // <<< --- ¡PEGA ESTA LÍNEA AQUÍ!
        // Añade aquí rutas para actualizar cantidad, eliminar, etc. si las implementas.
    });

    //Ruta para mostrar los servicios
    Route::get('/Servicios', function () {
        return view('servicios');
    })->name('servicio');

    //Ruta para el acerca de
    Route::get('/Acerca/de', function () {
        return view('acerca_de');
    })->name('acerca_de');

    Route::middleware(['is_admin'])->group(function () { // Usaremos un middleware para administradores
        Route::get('/dashboard/admin', [InventarioController::class, 'index'])->name('admin.dashboard');

        //Productos
        // Listado de productos
        Route::get('/inventario', [ProductoController::class, 'index'])->name('producto.index');

        // Formulario de creación
        Route::get('/producto/create', [ProductoController::class, 'create'])->name('producto.create');

        // Guardar nuevo producto
        Route::post('/producto/guardar', [ProductoController::class, 'store'])->name('producto.guardar');

        // Editar producto
        Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');

        // Actualizar producto
        Route::put('/actualizar_producto/{producto}', [ProductoController::class, 'update'])->name('productos.update');

        // Eliminar producto
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

        //reporte dela admin

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});