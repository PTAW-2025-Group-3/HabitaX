<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserState
{
    /**
     * Verifica se o utilizador está num estado válido.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Atualiza os dados do utilizador a partir da BD para ter o estado mais recente
            $user->refresh();

            $restrictedStates = ['suspended', 'banned', 'archived'];

            if (in_array($user->state, $restrictedStates)) {
                // Termina a sessão do utilizador
                Auth::logout();

                // Desvalida a sessão
                $request->session()->invalidate();

                // Regenera o token CSRF
                $request->session()->regenerateToken();

                // Redireciona para a página inicial com uma mensagem de erro
                return redirect()->route('home')->with('error',
                    'A sua conta foi ' . ($user->state === 'suspended' ? 'suspensa' : 'desativada') .
                    '. Por favor, contacte o administrador para mais informações.');
            }
        }

        return $next($request);
    }
}
