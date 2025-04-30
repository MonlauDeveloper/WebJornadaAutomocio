<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (auth()->check()) {
            $userRole = auth()->user()->idRole;

            // Verifica si el rol del usuario está en la lista de roles permitidos
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Redirige si no tiene permisos
        return redirect()->route('login')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}
