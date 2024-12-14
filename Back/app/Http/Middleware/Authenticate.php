<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Define qué hacer si el usuario no está autenticado.
     */
    protected function redirectTo($request)
    {
        // Si la solicitud no es JSON, puedes devolver null o redirigir.
        if (!$request->expectsJson()) {
            return null; // No redirige a la ruta 'login'
        }

        // Devuelve null para evitar redirección y manejarlo como API
        return null;
    }
}
