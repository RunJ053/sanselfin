<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

//inicio de paginas
Route::get("/", function(){
    return view("index");
});

Route::get('/Finca_Al_Dia2', function () {
    return view('index2');
});

//inicio de sesion
Route::get("/incio_sesion", [LoginController::class,"index"])->name("login");
Route::post("/login", [UsuarioController::class, "show"])->name("iniciarSesion");
Route::get("/logout", [UsuarioController::class, "logout"])->name("logout");

Route::get('/inicio_admin', [UsuarioController::class, 'inicioAdmin'])->name('inicioAdmin');

Route::get('/my-profile', [UsuarioController::class, 'myProfile'])->name('myProfile');

//Creacion de usuarios
Route::get('crear/usuario/{cliente_id}', [UsuarioController::class,"create"])->name("crearUsuario");
Route::post('usuario/registrar', [UsuarioController::class,"store"])->name("storeUsuario");

//Registro de usuario
Route::get("/usuario/registro", [DatoUsuarioController::class,"index"])->name("registro");
Route::post("/registrado", [DatoUsuarioController::class,"store"])->name("store");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
