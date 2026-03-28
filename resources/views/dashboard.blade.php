@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight italic uppercase">Bienvenido, {{ auth()->user()->nombre }}</h2>
    <p class="text-azul-claro text-sm">Panel de control de EDU-SYS | Ciclo 2026</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-azul-marino p-8 rounded-3xl text-white shadow-xl relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-cafe-acento font-bold text-xs uppercase tracking-widest mb-2">Estatus Escolar</h3>
            <p class="text-2xl font-black">ACTIVO</p>
            <p class="text-azul-claro text-xs mt-4">Sistema actualizado hoy</p>
        </div>
        <div class="absolute -right-4 -bottom-4 text-white/5 text-8xl font-black group-hover:scale-110 transition-transform italic">EDU</div>
    </div>

    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-lg">
        <h3 class="text-azul-claro font-bold text-xs uppercase tracking-widest mb-2">Tu Rol</h3>
        <p class="text-2xl font-black text-azul-marino uppercase">{{ auth()->user()->rol }}</p>
        <p class="text-gris-escolar text-xs mt-4 italic">Clave: {{ auth()->user()->clave_institucional }}</p>
    </div>

    <div class="bg-cafe-acento p-8 rounded-3xl text-white shadow-xl">
        <h3 class="text-white/80 font-bold text-xs uppercase tracking-widest mb-2">Próxima Entrega</h3>
        <p class="text-2xl font-black">Pendiente</p>
        <a href="{{ route('tareas.index') }}" class="inline-block mt-4 text-[10px] font-bold uppercase underline underline-offset-4">Revisar mis tareas</a>
    </div>
</div>
@endsection