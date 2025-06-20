<?php

use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Models\DatoUsuario;
use App\Models\Inventario;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

//inicio de paginas
Route::get("/", function(){
    return view("index");
});

Route::get('/Finca_Al_Dia2', function () {
    return view('index2');
});

//inicio de sesion
Route::get("/incio_sesion", [UsuarioController::class,"index"])->name("login");
Route::post("/login", [UsuarioController::class, "show"])->name("iniciarSesion");
Route::get("/logout", [UsuarioController::class, "logout"])->name("logout");

//Creacion de usuarios
Route::get('crear/usuario', [UsuarioController::class,"create"])->name("crearUsuario");
Route::post('usuario/registrar', [UsuarioController::class,"store"])->name("storeUsuario");

//Registro de usuario
Route::get("/usuario/registro", [DatoUsuarioController::class,"index"])->name("registro");
Route::post("/registrado", [DatoUsuarioController::class,"store"])->name("store");

//inventario
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');


//Productos
Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/create', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto/guardar', [ProductoController::class, 'store'])->name('Producto.guardar'); 