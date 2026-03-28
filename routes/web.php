<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;

// --- RUTAS PÚBLICAS (Invitados) ---
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// --- RUTAS PROTEGIDAS (Solo Usuarios Logueados) ---
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cerrar Sesión
    Route::post('/logout', function() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    // Ruta para Alumnos (Ver sus propias notas)
    Route::get('/mis-notas', [CalificacionController::class, 'misCalificaciones'])->name('calificaciones.alumno');
    Route::get('/mis-horarios', [InscripcionController::class, 'misHorarios'])->name('horarios.horarios');
    // --- RUTAS DE ADMINISTRADOR (Profesores) ---
    Route::middleware(['admin'])->group(function () {
        
        // Materias
        Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
        Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');

        // Horarios
        Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
        Route::post('/horarios', [HorarioController::class, 'store'])->name('horarios.store');

        // Grupos
        Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');
        Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');

        // Inscripciones
        Route::get('/inscripciones', [InscripcionController::class, 'index'])->name('inscripciones.index');
        Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');

        // Gestión de Calificaciones
        Route::get('/admin/calificaciones', [CalificacionController::class, 'gestion'])->name('calificaciones.admin');
        Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
    });

});