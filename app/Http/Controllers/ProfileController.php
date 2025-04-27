<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('account.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')
            ->store('profile_images', 'public') : null;

        $user->update([
            'profile_picture_path' => $imagePath,
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('settings')->with('success', 'Senha atualizada com sucesso!');
    }

    public function updateNotifications(Request $request)
    {
        $request->validate([
            'email_notifications' => ['boolean'],
            'message_notifications' => ['boolean'],
        ]);

        Auth::user()->update([
            'email_notifications' => $request->email_notifications ?? false,
            'message_notifications' => $request->message_notifications ?? false,
        ]);

        return redirect()->route('settings')->with('success', 'Configurações de notificação atualizadas com sucesso!');
    }

    public function updatePrivacy(Request $request)
    {
        $request->validate([
            'public_profile' => ['boolean'],
            'show_email' => ['boolean'],
        ]);

        Auth::user()->update([
            'public_profile' => $request->public_profile ?? false,
            'show_email' => $request->show_email ?? false,
        ]);

        return redirect()->route('settings')->with('success', 'Configurações de privacidade atualizadas com sucesso!');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'Sua conta foi excluída com sucesso.');
    }

    public function settings()
    {
        return view('account.settings');
    }
}
