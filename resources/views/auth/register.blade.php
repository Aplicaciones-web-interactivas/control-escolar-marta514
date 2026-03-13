<h2>Registro de Sistema Escolar</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf 
    <input type="text" name="nombre" placeholder="Nombre completo" value="{{ old('nombre') }}" required>
    
    <input type="text" name="clave_institucional" placeholder="Clave Institucional (6 números)" maxlength="6" required>
    
    <input type="password" name="password" placeholder="Contraseña" required>
    
    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>

    <button type="submit">Registrarse</button>
</form>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif