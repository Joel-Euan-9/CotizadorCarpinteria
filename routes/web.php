<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CotizadorController;
use App\Livewire\QuotationList;
use App\Livewire\Cotizador;

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
Route::get('/cotizador', Cotizador::class)->name('cotizador');

// Ruta para la lista de cotizaciones
//Route::get('/cotizaciones', [CotizadorController::class, 'list'])
     //->name('cotizaciones.list');

// Ruta para el panel de usuarios
Route::get('/usuarios', [CotizadorController::class, 'users'])
     ->name('usuarios.users');

// Ruta para el panel de inventario
Route::get('/inventario', [CotizadorController::class, 'invents'])
     ->name('inventario.invents');

// Nueva ruta para el panel de lista de cotizaciones
Route::get('/quotations', QuotationList::class)->name('quotations.list');


// --- RUTAS DE LÓGICA DE AUTENTICACIÓN ---
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');