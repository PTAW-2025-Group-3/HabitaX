<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function settings()
    {
        return view('account.settings');
    }

    public function updatePrivacy(Request $request)
    {
        $user = Auth::user();
        $user->show_email = $request->has('show_email');
        $user->show_telephone = $request->has('show_telephone');
        $user->save();

        return redirect()->back()->with('success', 'As configurações de privacidade foram atualizadas com sucesso.');
    }

    public function updatePassword(Request $request)
    {
        $messages = [
            'password.regex' => 'A senha deve conter no mínimo 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial (@$!%*#?&).'
        ];

        $request->validate([
            'current_password' => 'required|string',
            'password' => [
                'required',
                'string',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
        ], $messages);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Armazenar a mensagem em uma variável de sessão que persiste após o logout
        $request->session()->put('password_changed', true);

        // Logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('password.changed');
    }

    public function passwordChanged()
    {
        if (!session('password_changed')) {
            return redirect('/');
        }

        // Remover a flag da sessão
        session()->forget('password_changed');

        return redirect('/')->with('success', 'A sua senha foi atualizada com sucesso. Por favor, faça login novamente.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'delete_password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->delete_password, $user->password)) {
            return back()->withErrors(['delete_password' => 'Senha incorreta.']);
        }

        // Remover todas as mídias da coleção "picture"
        if ($user->hasMedia('picture')) {
            $user->clearMediaCollection('picture');
        }

        // Marca como arquivado + limpa dados
        $user->update([
            'name' => 'Utilizador Eliminado',
            'email' => 'deleted_' . $user->id . '@' . parse_url(config('app.url'), PHP_URL_HOST),
            'telephone' => null,
            'profile_photo_path' => null,
            'show_email' => false,
            'show_telephone' => false,
            'password' => Hash::make(''), // Limpa a senha
            'public_profile' => false,
            'message_notifications' => false,
            'bio'=> null,
            'state' => 'archived',
        ]);

        // Flash antes do logout
        session()->flash('success', 'Conta desativada com sucesso.');

        // Logout total
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
