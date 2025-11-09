<?php

use App\Livewire\UserAccount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CotizadorController;
use App\Livewire\QuotationList;

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

// --- RUTAS DE LÓGICA DE AUTENTICACIÓN ---
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');


// RUTAS DE LOS MODULOS DEL COTIZADOR
Route::middleware('auth')->group(function(){

     //Ruta vista de inicio
     Route::view('/inicio', "inicio")->name('inicio');

     //Ruta vista de formulario de cotizador
     
     Route::get('/cotizador', [CotizadorController::class, 'show'])
         ->name('cotizador.show');

     // Ruta para el panel de usuarios
     //Route::get('/usuarios', [CotizadorController::class, 'users'])
         //->name('usuarios.users');

     // Ruta para el panel de inventario
     Route::get('/inventario', [CotizadorController::class, 'invents'])
         ->name('inventario.invents');

     // Nueva ruta para el panel de lista de cotizaciones
     Route::get('/quotations', QuotationList::class)->name('quotations.list');

     // Ruta para el panel de usuarios(Mi Cuenta)
     Route::get('/Mi-Cuenta', UserAccount::class)->name('Mi-Cuenta');


});
