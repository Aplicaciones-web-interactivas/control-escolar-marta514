<x-guest-layout>
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

    <div class="min-h-screen bg-blanco-fondo flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="bg-azul-marino p-8 text-center">
                <div class="text-cafe-acento font-black text-3xl tracking-tighter mb-1">EDU-SYS</div>
                <h2 class="text-white font-bold text-lg uppercase tracking-widest">Crear Cuenta</h2>
                <p class="text-azul-claro text-xs mt-2">Sistema de Gestión Escolar</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf 

                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-1">Nombre Completo</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cafe-acento focus:border-transparent outline-none transition text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-azul-marino uppercase mb-1">Clave Institucional</label>
                        <input type="text" name="clave_institucional" maxlength="6" required
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cafe-acento focus:border-transparent outline-none transition text-sm font-mono">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-azul-marino uppercase mb-1">Contraseña</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cafe-acento outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-azul-marino uppercase mb-1">Confirmar</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cafe-acento outline-none text-sm">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1 uppercase text-xs tracking-widest">
                            Registrarse ahora
                        </button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="mt-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-xs text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-6 text-center border-t border-gray-100 pt-4">
                    <p class="text-xs text-gris-escolar">
                        ¿Ya eres parte de la institución? 
                        <a href="{{ route('login') }}" class="text-azul-marino font-bold hover:underline">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>