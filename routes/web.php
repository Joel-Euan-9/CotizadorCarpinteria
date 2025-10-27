<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
// ¡AQUÍ! Importa el nuevo controlador
use App\Http\Controllers\CotizadorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS DE VISTAS ESTÁTICAS ---
Route::view('/login', "login")->name('login');
Route::view('/register', "register")->name('register');
Route::view('/registro', "register")->name('registro');
Route::view('/privada', "secret")->middleware('auth')->name('privada');


// --- RUTAS DE CONTENIDO PRINCIPAL ---

Route::view('/inicio', "inicio")->name('inicio');

// Ruta para el formulario del cotizador
Route::get('/cotizador', [CotizadorController::class, 'show'])
     ->name('cotizador.show');

// Ruta para la lista de cotizaciones
Route::get('/cotizaciones', [CotizadorController::class, 'list'])
     ->name('cotizaciones.list');


// --- RUTAS DE LÓGICA DE AUTENTICACIÓN ---
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');