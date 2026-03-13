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

use App\Http\Controllers\GrupoController;

Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');
Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');

// Dashboard (Protegido)
Route::get('/dashboard', function () {
    return view('dashboard'); // <--- CAMBIA EL TEXTO POR ESTO
})->middleware(['auth'])->name('dashboard');

use App\Http\Controllers\MateriaController;

Route::middleware('auth')->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
});

Route::post('/logout', function() {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

use App\Http\Controllers\HorarioController;

Route::middleware('auth')->group(function () {
    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
    Route::post('/horarios', [HorarioController::class, 'store'])->name('horarios.store');
});