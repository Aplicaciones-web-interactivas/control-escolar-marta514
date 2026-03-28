@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Módulo de Tareas</h2>
    <p class="text-azul-claro text-sm italic">Gestión de actividades y entregas en formato PDF</p>
</div>

@if(auth()->user()->rol === 'admin')
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-10">
        <div class="bg-azul-marino p-4">
            <h3 class="text-white font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                <span class="w-2 h-2 bg-cafe-acento rounded-full"></span>
                Asignar Nueva Actividad
            </h3>
        </div>
        <div class="p-8 bg-gray-50/50">
            <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Grupo Destino</label>
                        <select name="grupo_id" class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none text-sm" required>
                            <option value="">-- Selecciona el grupo --</option>
                            @foreach($grupos as $g)
                                <option value="{{ $g->id }}">{{ $g->nombre }} - {{ $g->horario->materia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Fecha Límite</label>
                        <input type="date" name="fecha_entrega" class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none text-sm" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Título de la Tarea</label>
                    <input type="text" name="titulo" placeholder="Ej: Ensayo sobre Laravel" class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Instrucciones</label>
                    <textarea name="descripcion" rows="3" class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none text-sm" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all uppercase text-xs tracking-widest">
                        Publicar Tarea
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 gap-6">
    @forelse($tareas as $tarea)
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-azul-claro/10 text-azul-claro text-[10px] font-bold px-2 py-0.5 rounded uppercase border border-azul-claro/20">
                        {{ $tarea->grupo->horario->materia->nombre }} ({{ $tarea->grupo->nombre }})
                    </span>
                    <span class="text-red-500 text-[10px] font-bold uppercase italic">
                        Límite: {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}
                    </span>
                </div>
                <h3 class="text-xl font-bold text-azul-marino">{{ $tarea->titulo }}</h3>
                <p class="text-gris-escolar text-sm mt-1">{{ $tarea->descripcion }}</p>
            </div>

            <div class="w-full md:w-auto">
                @if(auth()->user()->rol === 'alumno')
                    @php
                        // Buscamos si el alumno logueado ya tiene una entrega para esta tarea
                        $miEntrega = $tarea->entregas->where('user_id', auth()->id())->first();
                    @endphp

                    @if($miEntrega)
                        <div class="bg-green-50 border border-green-200 px-6 py-4 rounded-xl text-center shadow-inner min-w-[200px]">
                            <div class="text-green-700 font-bold text-xs uppercase tracking-widest">Entregada</div>
                            <div class="text-green-600 text-[10px] mt-1 font-mono">
                                {{ $miEntrega->created_at->format('d/m/Y H:i') }}
                            </div>
                            
                            <form action="{{ route('tareas.entregar', $tarea) }}" method="POST" enctype="multipart/form-data" class="mt-3 pt-3 border-t border-green-200/50">
                                @csrf
                                <label class="cursor-pointer text-[10px] text-green-700 font-bold hover:text-cafe-acento transition">
                                    Actualizar Archivo
                                    <input type="file" name="archivo" accept=".pdf" class="hidden" onchange="this.form.submit()">
                                </label>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('tareas.entregar', $tarea) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 min-w-[200px]">
                            @csrf
                            <div class="relative">
                                <input type="file" name="archivo" accept=".pdf" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-f5f6f3 file:text-azul-marino hover:file:bg-gray-200" required>
                            </div>
                            <button type="submit" class="bg-azul-marino text-white px-4 py-2 rounded-lg text-xs font-bold uppercase hover:bg-cafe-acento transition">
                                Entregar PDF
                            </button>
                        </form>
                    @endif
                @else
                    {{-- El maestro ve el botón para revisar --}}
                    <a href="{{ route('tareas.ver_entregas', $tarea) }}" class="inline-block bg-cafe-acento text-white px-6 py-2 rounded-lg text-xs font-bold uppercase shadow hover:bg-azul-marino transition text-center min-w-[150px]">
                        Ver Entregas
                    </a>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 col-span-1">
            <p class="text-gris-escolar italic">No hay tareas pendientes en este momento.</p>
        </div>
    @endforelse
</div>
@endsection