<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index() {
        // Traemos los grupos con su horario y la materia de ese horario
        $grupos = Grupo::with('horario.materia')->get();
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