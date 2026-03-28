<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'azul-marino': '#2f3a55',
                        'azul-claro': '#5c6b8a',
                        'gris-escolar': '#6e6f73',
                        'cafe-acento': '#9f9b75',
                        'blanco-fondo': '#f5f6f3',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-blanco-fondo text-gris-escolar font-sans">

    <nav class="bg-azul-marino p-4 shadow-md text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span class="text-cafe-acento font-black text-xl tracking-tighter">EDU-SYS</span>
            
            <div class="flex flex-wrap gap-4 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-cafe-acento transition">Inicio</a>
                
                @if(auth()->user()->rol === 'admin')
                    <a href="{{ route('materias.index') }}" class="hover:text-cafe-acento">Materias</a>
                    <a href="{{ route('horarios.index') }}" class="hover:text-cafe-acento">Horarios</a>
                    <a href="{{ route('grupos.index') }}" class="hover:text-cafe-acento">Grupos</a>
                    <a href="{{ route('inscripciones.index') }}" class="hover:text-cafe-acento">Inscripciones</a>
                    <a href="{{ route('calificaciones.admin') }}" class="hover:text-cafe-acento">Calificaciones</a>
                @else
                    {{-- Corregimos el nombre de la ruta aquí abajo --}}
                    <a href="{{ route('horarios.horarios') }}" class="hover:text-cafe-acento">Mi Horario</a>
                    <a href="{{ route('calificaciones.alumno') }}" class="hover:text-cafe-acento">Mis Notas</a>
                @endif
                <a href="{{ route('tareas.index') }}" class="hover:text-cafe-acento">Tareas</a>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-azul-claro hover:bg-red-500 px-3 py-1 rounded text-xs transition">Salir</button>
        </form>
    </div>
</nav>

    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

</body>
</html>