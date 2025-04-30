<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario tiene el status "approved"
        if (auth()->user()->status !== 'approved') {
            // Redirigir a la página deseada si el status no es "approved"
            return redirect()->to('ver-estado')->with('error', 'No tienes permisos para acceder a esta página.');        }

        return $next($request);
    }
}
