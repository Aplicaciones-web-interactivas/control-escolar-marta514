<?php

namespace App\Http\Controllers;
use App\Models\Horario; // <-- ESTA LÍNEA FALTA
use App\Models\Materia; // <-- TAMBIÉN NECESITARÁS ESTA PARA EL SELECT
use Illuminate\Http\Request;


class HorarioController extends Controller
{
    public function index() {
    // Obtenemos los horarios del usuario logueado con su materia
    $horarios = Horario::where('user_id', auth()->id())->with('materia')->get();
    $materias = Materia::all(); // Para el formulario
    
    return view('horarios.index', compact('horarios', 'materias'));
}

public function store(Request $request) {
    $request->validate([
        'materia_id' => 'required',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'dias' => 'required|array' // Validamos que sea un array
    ]);

    Horario::create([
        'user_id' => auth()->id(),
        'materia_id' => $request->materia_id,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $request->hora_fin,
        // Convertimos el array ['Lunes', 'Martes'] en el texto "Lunes, Martes"
        'dias' => implode(', ', $request->dias), 
    ]);

    return back()->with('success', 'Horario guardado');
}
}
