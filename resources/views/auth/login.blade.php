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

    <div class="min-h-screen bg-blanco-fondo flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            
            <div class="bg-azul-marino p-8 text-center">
                <div class="text-cafe-acento font-black text-3xl tracking-tighter mb-2">EDU-SYS</div>
                <h2 class="text-xl font-bold text-blanco-fondo uppercase tracking-wide">Inicio de Sesión</h2>
                <p class="text-azul-claro text-xs mt-2 italic">Acceso al Panel de Control Escolar</p>
            </div>

            <div class="p-8">
                <x-auth-session-status class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm border border-green-200" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-azul-marino mb-2">Clave Institucional</label>
                        <input type="text" name="clave_institucional" 
                            placeholder="6 dígitos" 
                            maxlength="6" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cafe-acento focus:border-cafe-acento outline-none transition bg-gray-50 font-mono tracking-widest" 
                            required autofocus>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-bold text-azul-marino">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-azul-claro hover:text-cafe-acento transition">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        <input type="password" name="password" 
                            placeholder="••••••••" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cafe-acento focus:border-cafe-acento outline-none transition bg-gray-50" 
                            required>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 rounded-lg shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 uppercase tracking-widest text-sm">
                            Entrar al Sistema
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gris-escolar">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-azul-marino font-bold hover:text-cafe-acento transition underline decoration-cafe-acento decoration-2 underline-offset-4">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>