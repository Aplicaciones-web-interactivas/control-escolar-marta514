@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <p>¡Bienvenido de nuevo, {{ auth()->user()->nombre }}!</p>
        <p>Has iniciado sesión correctamente en el sistema escolar.</p>
    </div>
@endsection