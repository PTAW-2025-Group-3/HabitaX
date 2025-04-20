<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModeratorMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->user_type !== 'moderator' && auth()->user()->user_type !== 'admin') {
            return redirect('/')->with('error', 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
