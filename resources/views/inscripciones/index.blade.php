@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Inscripción de Alumnos</h2>
    <p class="text-azul-claro text-sm italic">Asigna estudiantes a sus respectivos grupos y materias</p>
</div>

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-sm">
        <div class="flex items-center">
            <span class="text-red-800 font-bold text-sm">¡Atención!</span>
        </div>
        <p class="text-xs text-red-600 mt-1">{{ $errors->first() }}</p>
    </div>
@endif

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-10">
    <div class="bg-azul-marino p-4">
        <h3 class="text-white font-bold text-xs uppercase tracking-widest flex items-center gap-2">
            <span class="w-2 h-2 bg-cafe-acento rounded-full"></span>
            Nueva Inscripción
        </h3>
    </div>
    
    <div class="p-8 bg-gray-50/50">
        <form action="{{ route('inscripciones.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Seleccionar Alumno</label>
                <select name="user_id" required 
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    <option value="">-- Elige un estudiante --</option>
                    @foreach($usuarios as $user)
                        <option value="{{ $user->id }}">{{ $user->nombre }} ({{ $user->clave_institucional }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Seleccionar Grupo</label>
                <select name="grupo_id" required 
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    <option value="">-- Elige un grupo --</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">
                            {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" 
                class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all duration-300 uppercase text-xs tracking-widest">
                Realizar Inscripción
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Alumno</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest text-center">Grupo</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Materia</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest text-right">Fecha</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($inscripciones as $inscripcion)
                <tr class="hover:bg-f5f6f3 transition-colors duration-200">
                    <td class="p-5">
                        <div class="font-bold text-azul-marino text-sm">{{ $inscripcion->usuario->nombre }}</div>
                        <div class="text-[10px] text-azul-claro font-mono">{{ $inscripcion->usuario->clave_institucional }}</div>
                    </td>
                    <td class="p-5 text-center">
                        <span class="inline-block px-3 py-1 bg-azul-claro/10 text-azul-marino rounded-lg font-black text-xs border border-azul-claro/20">
                            {{ $inscripcion->grupo->nombre }}
                        </span>
                    </td>
                    <td class="p-5">
                        <span class="text-gris-escolar font-medium text-sm">{{ $inscripcion->grupo->horario->materia->nombre }}</span>
                    </td>
                    <td class="p-5 text-right">
                        <span class="text-xs font-bold text-cafe-acento bg-f5f6f3 px-2 py-1 rounded">
                            {{ $inscripcion->created_at->format('d/m/Y') }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gris-escolar italic bg-gray-50">
                        No hay alumnos inscritos actualmente.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($inscripciones instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $inscripciones->links() }}
    </div>
@endif

@endsection