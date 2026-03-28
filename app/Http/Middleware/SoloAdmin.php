<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificar si está logueado
        // 2. Verificar si su rol es 'admin'
        if (auth()->check() && auth()->user()->rol === 'admin') {
            return $next($request); // ¡Pase adelante!
        }

        // Si no es admin, lo mandamos al dashboard con un mensaje de error
        return redirect('/dashboard')->with('error', 'No tienes permisos de administrador.');
    }
}
