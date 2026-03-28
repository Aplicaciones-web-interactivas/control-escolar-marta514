<?php

namespace App\Http\Controllers;

use App\Models\Horario; 
use App\Models\Materia; 
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index() {
        // 1. CAMBIO AQUÍ: Usamos paginate(10) en lugar de get()
        // Solo traemos los horarios del usuario logueado
        $horarios = Horario::where('user_id', auth()->id())
                            ->with('materia')
                            ->latest()
                            ->paginate(10);

        // 2. Las materias para el select sí se quedan con all() 
        // para que aparezcan todas las opciones en el formulario
        $materias = Materia::all(); 
        
        return view('horarios.index', compact('horarios', 'materias'));
    }

    public function store(Request $request) {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dias' => 'required|array' 
        ]);

        Horario::create([
            'user_id' => auth()->id(),
            'materia_id' => $request->materia_id,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            // Convertimos el array en string para la base de datos
            'dias' => implode(', ', $request->dias), 
        ]);

        return back()->with('success', 'Horario guardado correctamente.');
    }
}