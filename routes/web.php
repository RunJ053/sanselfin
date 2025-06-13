<?php

use App\Http\Controllers\DatoUsuarioController;
use App\Http\Controllers\UsuarioController;
use App\Models\DatoUsuario;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//inicio de paginas
Route::get("/", function(){
    return view("index");
});

Route::get('/Finca_Al_Dia2', function () {
    return view('index2');
});

//inicio de sesion
Route::get("/incio_sesion", [UsuarioController::class,"index"])->name("login");
//Creacion de usuarios
Route::get('crear/usuario', [UsuarioController::class,"create"])->name("crearUsuario");
Route::post('usuario/registrar', [UsuarioController::class,"store"])->name("storeUsuario");

//Registro de usuario
Route::get("/usuario/registro", [DatoUsuarioController::class,"index"])->name("registro");
Route::post("/registrado", [DatoUsuarioController::class,"store"])->name("store");



