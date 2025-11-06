<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AuthController;

// Página principal → redirige a login
Route::get('/', function () {
    return redirect()->route('login');
});

// Ruta pública para visitantes
Route::get('/personas/nuevovisi', [PersonaController::class, 'nuevovisi'])
    ->name('personas.nuevovisi');

// ======================
// AUTENTICACIÓN
// ======================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================
// REGISTRO
// ======================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// ======================
// RECUPERAR CONTRASEÑA (solo mensaje)
// ======================
Route::get('/password/recover', [AuthController::class, 'recoverPassword'])->name('password.recover');

// ======================
// ÁREA PRIVADA
// ======================
Route::middleware('auth')->group(function () {

    // Home para usuarios visitantes
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas solo para admin
    Route::middleware('admin')->group(function () {
        Route::resource('personas', PersonaController::class);
        Route::resource('mascotas', MascotaController::class);
        Route::resource('adopciones', AdopcionController::class);
    });
});
