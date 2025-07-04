<?php

use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
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
Route::get('/inicio_admin', [InventarioController::class, 'index'])->name('inventario.index');


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