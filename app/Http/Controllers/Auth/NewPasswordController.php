<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ], [
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um endereço de e-mail válido.',
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Mensagem personalizada para redirecionamento
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'A sua password foi redefinida com sucesso! Agora pode fazer login com sua nova senha.');
        }

        // Traduzindo mensagens comuns de erro
        $customMessages = [
            'passwords.token' => 'O link de redefinição de senha é inválido ou expirou.',
            'passwords.user' => 'Não encontramos um utilizador com esse endereço de e-mail.',
            'passwords.throttled' => 'Por favor, aguarde antes de tentar novamente.',
        ];

        $errorMessage = __($status);

        if (array_key_exists($status, $customMessages)) {
            $errorMessage = $customMessages[$status];
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $errorMessage]);
    }
}
