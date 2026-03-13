<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index() {
        $personas = Persona::all();
        return view('dashboard', compact('personas'));
    }

    public function store(Request $request) {
        Persona::create($request->all());
        return redirect()->back();
    }

    public function destroy($id) {
        Persona::find($id)->delete();
        return redirect()->back();
    }
}
