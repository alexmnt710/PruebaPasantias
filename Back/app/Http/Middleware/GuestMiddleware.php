<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario está autenticado, devolver respuesta JSON con 403
        if (Auth::check()) {
            return response()->json(['success'=> true ,'message' => 'Ya estás autenticado'], 403);
        }

        // Continuar con la solicitud si no está autenticado
        return $next($request);
    }
}
