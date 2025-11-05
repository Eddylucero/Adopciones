<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdopcionController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/personas/nuevovisi', [PersonaController::class, 'nuevovisi'])->name('personas.nuevovisi');

Route::resource('personas', PersonaController::class);
Route::resource('mascotas', MascotaController::class);
Route::resource('adopciones', AdopcionController::class);
