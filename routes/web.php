<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/personas/nuevovisi', [PersonaController::class, 'nuevovisi'])
    ->name('personas.nuevovisi');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::get('/password/recover', [AuthController::class, 'recoverPassword'])->name('password.recover');

Route::middleware('auth')->group(function () {


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware('admin')->group(function () {
        Route::resource('personas', PersonaController::class);
        Route::resource('mascotas', MascotaController::class);
        Route::resource('adopciones', AdopcionController::class);
    });
});
