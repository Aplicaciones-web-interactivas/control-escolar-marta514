<div class="py-12 bg-[#1a1c15] min-h-screen text-[#cfb4ab]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('personas.store') }}" method="POST" class="bg-[#2d2f26] p-6 rounded-lg mb-6 border border-[#cfb4ab]/20">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre" class="bg-[#1a1c15] border-[#cfb4ab]/30 rounded text-[#cfb4ab]">
                <input type="text" name="apellido" placeholder="Apellido" class="bg-[#1a1c15] border-[#cfb4ab]/30 rounded text-[#cfb4ab]">
                <input type="text" name="direccion" placeholder="Dirección" class="bg-[#1a1c15] border-[#cfb4ab]/30 rounded text-[#cfb4ab] col-span-2">
                <input type="number" name="edad" placeholder="Edad" class="bg-[#1a1c15] border-[#cfb4ab]/30 rounded text-[#cfb4ab]">
                <button class="bg-[#b57873] text-white p-2 rounded hover:bg-[#a16661]">Guardar Persona</button>
            </div>
        </form>

        <div class="bg-[#2d2f26] rounded-lg overflow-hidden border border-[#cfb4ab]/20">
            <table class="w-full text-left">
                <thead class="bg-[#1a1c15]">
                    <tr>
                        <th class="p-4 text-[#b57873]">Nombre</th>
                        <th class="p-4">Edad</th>
                        <th class="p-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $persona)
                    <tr class="border-t border-[#cfb4ab]/10">
                        <td class="p-4">{{ $persona->nombre }} {{ $persona->apellido }}</td>
                        <td class="p-4">{{ $persona->edad }} años</td>
                        <td class="p-4">
                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>