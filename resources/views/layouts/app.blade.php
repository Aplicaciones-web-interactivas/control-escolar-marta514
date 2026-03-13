<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <style>
        nav { background: #333; padding: 15px; color: white; }
        nav a { color: white; text-decoration: none; margin-right: 15px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .container { padding: 20px; font-family: sans-serif; }
        .logout-btn { background: #ff4444; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('dashboard') }}">Inicio</a> | 
<a href="{{ route('materias.index') }}">Materias</a> | 
<a href="{{ route('horarios.index') }}">Horarios</a> | 
<a href="{{ route('grupos.index') }}">Grupos</a>

    <div style="float: right;">
        <span style="color: white; margin-right: 10px;">{{ auth()->user()->nombre }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>