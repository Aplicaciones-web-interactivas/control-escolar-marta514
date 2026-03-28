<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index() {
        // Cambiamos .get() por .paginate(10)
        // Usamos latest() para que los grupos nuevos aparezcan siempre arriba
        $grupos = Grupo::with('horario.materia')
                        ->latest() 
                        ->paginate(10);
        
        // Los horarios para el select los dejamos con get() porque 
        // necesitamos que todos estén disponibles en el formulario
        $horarios = Horario::with('materia')->get();
        
        return view('grupos.index', compact('grupos', 'horarios'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'horario_id' => 'required|exists:horarios,id',
        ]);

        Grupo::create($request->all());

        return back()->with('success', 'Grupo creado con éxito.');
    }
}