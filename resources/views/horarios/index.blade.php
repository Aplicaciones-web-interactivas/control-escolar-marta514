@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Gestión de Horarios</h2>
    <p class="text-azul-claro text-sm italic">Define los bloques de tiempo para las materias del ciclo escolar</p>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-10">
    <div class="bg-azul-marino p-4">
        <h3 class="text-white font-bold text-xs uppercase tracking-widest flex items-center gap-2">
            <span class="w-2 h-2 bg-cafe-acento rounded-full"></span>
            Registrar Nuevo Bloque de Clase
        </h3>
    </div>
    
    <div class="p-8 bg-gray-50/50">
        <form action="{{ route('horarios.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Materia</label>
                    <select name="materia_id" required 
                        class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                        <option value="">-- Selecciona una materia --</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }} ({{ $materia->clave_materia }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Hora Inicio</label>
                        <input type="time" name="hora_inicio" required
                            class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Hora Fin</label>
                        <input type="time" name="hora_fin" required
                            class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-3">Días de Clase</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                        <label class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-lg cursor-pointer hover:border-cafe-acento transition">
                            <input type="checkbox" name="dias[]" value="{{ $dia }}" class="w-4 h-4 text-cafe-acento rounded border-gray-300 focus:ring-cafe-acento">
                            <span class="text-sm text-gris-escolar font-medium">{{ $dia }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" 
                    class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all duration-300 uppercase text-xs tracking-widest">
                    Guardar en Horarios
                </button>
            </div>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Materia</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Clave</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest text-center">Horario</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Días</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($horarios as $horario)
                <tr class="hover:bg-f5f6f3 transition-colors duration-200">
                    <td class="p-5">
                        <span class="font-bold text-azul-marino uppercase text-xs">{{ $horario->materia->nombre }}</span>
                    </td>
                    <td class="p-5">
                        <span class="bg-gray-100 text-gris-escolar px-2 py-1 rounded text-[10px] font-mono border border-gray-200">
                            {{ $horario->materia->clave_materia }}
                        </span>
                    </td>
                    <td class="p-5 text-center">
                        <div class="text-sm font-bold text-cafe-acento">
                            {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
                        </div>
                    </td>
                    <td class="p-5">
                        <div class="flex flex-wrap gap-1">
                            @php
                                // Suponiendo que los días vienen como string separado por comas o array
                                $diasArr = is_array($horario->dias) ? $horario->dias : explode(',', str_replace(['[', ']', '"'], '', $horario->dias));
                            @endphp
                            @foreach($diasArr as $d)
                                <span class="px-2 py-0.5 bg-azul-claro/10 text-azul-claro rounded text-[10px] font-bold uppercase border border-azul-claro/20">
                                    {{ trim($d) }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gris-escolar italic bg-gray-50">
                        No se han asignado materias este semestre.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($horarios instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $horarios->links() }}
    </div>
@endif

@endsection