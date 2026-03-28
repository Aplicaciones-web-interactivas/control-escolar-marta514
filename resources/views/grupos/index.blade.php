@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Gestión de Grupos</h2>
    <p class="text-azul-claro text-sm italic">Organiza las secciones y asigna sus horarios correspondientes</p>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-10">
    <div class="bg-azul-marino p-4">
        <h3 class="text-white font-bold text-xs uppercase tracking-widest flex items-center gap-2">
            <span class="w-2 h-2 bg-cafe-acento rounded-full animate-pulse"></span>
            Crear Nuevo Grupo
        </h3>
    </div>
    
    <div class="p-8 bg-gray-50/50">
        <form action="{{ route('grupos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Identificador (ej: 1A)</label>
                <input type="text" name="nombre" placeholder="Nombre del Grupo" required
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Asignar Horario y Materia</label>
                <select name="horario_id" required 
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
                    <option value="">-- Selecciona --</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id }}">
                            {{ $horario->materia->nombre }} | {{ $horario->dias }} ({{ $horario->hora_inicio }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" 
                class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all duration-300 uppercase text-xs tracking-widest">
                Crear Grupo
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Nombre del Grupo</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Materia Asignada</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Horario y Días</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($grupos as $grupo)
                <tr class="hover:bg-f5f6f3 transition-colors duration-200">
                    <td class="p-5">
                        <span class="inline-block px-3 py-1 bg-azul-claro/10 text-azul-marino rounded-lg font-black text-sm border border-azul-claro/20">
                            {{ $grupo->nombre }}
                        </span>
                    </td>
                    <td class="p-5 font-bold text-azul-marino">
                        {{ $grupo->horario->materia->nombre }}
                    </td>
                    <td class="p-5">
                        <div class="text-sm text-gris-escolar">
                            <span class="font-bold text-cafe-acento">{{ $grupo->horario->dias }}</span>
                            <span class="mx-1 text-gray-300">|</span>
                            {{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-10 text-center text-gris-escolar italic bg-gray-50">
                        No hay grupos registrados en este momento.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($grupos instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $grupos->links() }}
    </div>
@endif

@endsection