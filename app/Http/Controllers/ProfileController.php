<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'uploaded_picture' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        if ($request->has('uploaded_picture')) {
            $filename = trim(basename($request->uploaded_picture), "\"'");

            if ($filename == '') {
                $user->clearMediaCollection('picture');
            } else {
                $tempPath = storage_path('app/public/tmp/uploads/' . $filename);
                if (file_exists($tempPath)) {
                    $user->clearMediaCollection('picture');

                    $user->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection('picture');
                    unlink($tempPath);
                }
            }
        }

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
