<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Redireciona o usuário não autenticado.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Para APIs, retornamos null para evitar redirecionamento HTML
        if (! $request->expectsJson()) {
            return route('login'); // só usado em rotas web, opcional
        }

        return null;
    }
}
