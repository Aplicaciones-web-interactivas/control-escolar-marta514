@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Gestión de Calificaciones</h2>
    <p class="text-azul-claro text-sm italic">Asigna y supervisa el rendimiento académico de los alumnos</p>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-12">
    <div class="bg-azul-marino p-4">
        <h3 class="text-white font-bold text-sm uppercase tracking-widest flex items-center gap-2">
            <span class="w-2 h-2 bg-cafe-acento rounded-full"></span>
            Asignar Nueva Nota
        </h3>
    </div>
    
    <div class="p-8 bg-gray-50/50">
        <form action="{{ route('calificaciones.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf
            
            <div class="md:col-span-1">
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Alumno e Inscripción</label>
                <select name="user_id_grupo_id" required 
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    <option value="">-- Selecciona --</option>
                    @foreach($usuarios as $user)
                        @foreach($user->inscripciones as $inscripcion)
                            <option value="{{ $user->id }}|{{ $inscripcion->grupo?->id }}">
    {{ $user->nombre }} → {{ $inscripcion->grupo?->horario?->materia?->nombre ?? 'Sin Materia' }} ({{ $inscripcion->grupo?->nombre ?? 'Sin Grupo' }})
</option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Calificación (0 - 10)</label>
                <input type="number" name="calificacion" step="0.1" min="0" max="10" placeholder="0.0" required
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm font-bold text-center">
            </div>

            <button type="submit" 
                class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all duration-300 uppercase text-xs tracking-widest">
                Guardar Calificación
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Alumno</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Grupo</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Materia</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest text-center">Nota</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
    @foreach($calificaciones as $cal)
        <tr class="hover:bg-f5f6f3 transition-colors">
            <td class="p-5">
                <span class="font-bold text-azul-marino uppercase text-xs">{{ $cal->usuario?->nombre ?? 'Usuario Eliminado' }}</span>
            </td>
            <td class="p-5">
                <span class="text-azul-claro font-medium text-sm">{{ $cal->grupo?->nombre ?? 'N/A' }}</span>
            </td>
            <td class="p-5">
                <span class="text-gris-escolar text-sm italic">{{ $cal->grupo?->horario?->materia?->nombre ?? 'Sin Materia' }}</span>
            </td>
            <td class="p-5 text-center">
                <span class="inline-block min-w-[40px] px-2 py-1 bg-white border border-cafe-acento rounded-lg font-black text-cafe-acento shadow-sm">
                    {{ number_format($cal->calificacion, 1) }}
                </span>
            </td>
        </tr>
    @endforeach
</tbody>
    </table>
</div>
<div class="mt-6">
    {{ $calificaciones->links() }}
</div>
@endsection