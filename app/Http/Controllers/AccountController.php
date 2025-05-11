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
        $user->show_email = $request->has('show_email') ? 1 : 0;
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

        $user->advertisements()->delete(); 
        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', 'Conta excluída com sucesso.');
    }
}
