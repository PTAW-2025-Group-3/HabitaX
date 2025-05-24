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
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Senha atual incorreta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Senha atualizada com sucesso.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Senha incorreta.']);
        }

        // Inicia uma transação para garantir a integridade
        \DB::beginTransaction();

        try {
            // Desativar propriedades
            $user->properties()->update(['is_active' => false]);

            // Suspender anúncios
            $user->advertisements()->update(['is_published' => false, 'is_suspended' => true]);

            // Eliminar pedidos de contato
            foreach ($user->advertisements as $advertisement) {
                $advertisement->requests()->delete();
            }
            \App\Models\ContactRequest::where('created_by', $user->id)->delete();

            // Remover as denúncias relacionadas aos anúncios
            foreach ($user->advertisements as $advertisement) {
                \App\Models\Denunciation::where('advertisement_id', $advertisement->id)->delete();
            }

            // Remover os favoritos
            $user->favorites()->delete();

            // Será que agora é removido este caralho?
            $user->delete();

            \DB::commit();
            Auth::logout();

            return redirect('/')->with('success', 'Conta excluída com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Não foi possível excluir a conta: ' . $e->getMessage());
        }
    }
}
