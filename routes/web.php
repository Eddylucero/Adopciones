<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});


Route::get('/personas/nuevovisi', [PersonaController::class, 'nuevovisi'])->name('personas.nuevovisi');
Route::post('/personas/store', [PersonaController::class, 'store'])->name('personas.store');


Route::get('/adopvisi/{id}', [AdopcionController::class, 'adopvisi'])->name('adopvisi');
Route::post('/adopciones/store', [AdopcionController::class, 'store'])->name('adopciones.store');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::middleware('admin')->group(function () {
        Route::resource('personas', PersonaController::class);
        Route::resource('mascotas', MascotaController::class);
        Route::resource('adopciones', AdopcionController::class);
        Route::resource('dashboard', DashboardController::class);

        Route::post('/adopciones/{id}/aprobar', [AdopcionController::class, 'aprobar'])->name('adopciones.aprobar');
        Route::post('/adopciones/{id}/rechazar', [AdopcionController::class, 'rechazar'])->name('adopciones.rechazar');
    });
});
