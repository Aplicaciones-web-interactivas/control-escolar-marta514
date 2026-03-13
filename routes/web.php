<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ruta raíz
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Autenticación (Asegúrate de que apunten a TU controlador)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Dashboard (Protegido)
Route::middleware('auth')->get('/dashboard', function () {
    return "Bienvenido " . auth()->user()->nombre;
})->name('dashboard');

use App\Http\Controllers\MateriaController;

Route::middleware('auth')->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
});