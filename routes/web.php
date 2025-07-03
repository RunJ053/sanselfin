<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DatoUsuarioController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//inicio de paginas
Route::get("/", function () {
    return view("index");
});

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

    // Rutas para el carrito de compras
    Route::get('/producto', function () {
        return view('producto'); // Vista del carrito de compras
    })->name('producto');

    Route::middleware(['is_admin'])->group(function () { // Usaremos un middleware para administradores
        Route::get('/dashboard/admin', function () {
            return view('admin.factura'); // Vista para administradores
        })->name('admin.dashboard');
    });
});



// Puedes definir una ruta para el formulario si lo necesitas aparte, o solo usar la raíz
// Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth.form');
