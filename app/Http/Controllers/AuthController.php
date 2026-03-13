<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // <-- ASEGÚRATE DE TENER ESTA LÍNEA
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'clave_institucional' => 'required|string|size:6|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'rol' => 'usuario',
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito.');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'clave_institucional' => 'required|string|size:6',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Si falla, volver atrás con error
        return back()->withErrors([
            'clave_institucional' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    } // <-- Aquí terminaba el método login
} // <-- Aquí termina la clase

