<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// 🔹 Redirige según autenticación
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});

// 🔹 Rutas públicas (visitantes)
Route::get('/personas/nuevovisi', [PersonaController::class, 'nuevovisi'])->name('personas.nuevovisi');
Route::get('/adopvisi/{id}', [AdopcionController::class, 'adopvisi'])->name('adopvisi');

// 🔹 Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// 🔹 Área protegida (usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 🔹 Área de administrador
    Route::middleware('admin')->group(function () {

        // 🔹 Rutas resource con nombres únicos explícitos
        Route::resource('personas', PersonaController::class)
            ->names([
                'index' => 'personas.index',
                'create' => 'personas.create',
                'store' => 'personas.store',
                'show' => 'personas.show',
                'edit' => 'personas.edit',
                'update' => 'personas.update',
                'destroy' => 'personas.destroy',
            ]);

        Route::resource('mascotas', MascotaController::class)
            ->names([
                'index' => 'mascotas.index',
                'create' => 'mascotas.create',
                'store' => 'mascotas.store',
                'show' => 'mascotas.show',
                'edit' => 'mascotas.edit',
                'update' => 'mascotas.update',
                'destroy' => 'mascotas.destroy',
            ]);

        Route::resource('adopciones', AdopcionController::class)
            ->names([
                'index' => 'adopciones.index',
                'create' => 'adopciones.create',
                'store' => 'adopciones.store',
                'show' => 'adopciones.show',
                'edit' => 'adopciones.edit',
                'update' => 'adopciones.update',
                'destroy' => 'adopciones.destroy',
            ]);

        Route::resource('dashboard', DashboardController::class)
            ->names([
                'index' => 'dashboard.index',
                'create' => 'dashboard.create',
                'store' => 'dashboard.store',
                'show' => 'dashboard.show',
                'edit' => 'dashboard.edit',
                'update' => 'dashboard.update',
                'destroy' => 'dashboard.destroy',
            ]);

        // 🔹 Rutas personalizadas para adopciones
        Route::post('/adopciones/{id}/aprobar', [AdopcionController::class, 'aprobar'])
            ->name('adopciones.aprobar');
        Route::post('/adopciones/{id}/rechazar', [AdopcionController::class, 'rechazar'])
            ->name('adopciones.rechazar');
    });
});
