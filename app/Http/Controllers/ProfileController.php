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

        $messages = [
            'name.regex' => 'O nome deve conter apenas letras, espaços e hífens.',
            'telephone.regex' => 'O número de telefone deve ser um número português válido.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.unique' => 'Este email já está a ser utilizado por outra conta.',
        ];

        $request->validate([
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s\-]+$/u', // Permite apenas letras, espaços e hífens
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'telephone' => [
                'nullable',
                'string',
                'regex:/^(\+351|00351)?[2,3,6,9][0-9]{8}$/', // Formato português melhorado
            ],
            'bio' => 'nullable|string|max:1000',
            'uploaded_picture' => 'nullable|string',
        ], $messages);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
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

        return redirect()->route('settings')->with('success', 'A senha foi atualizada com sucesso!');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'A sua conta foi excluída com sucesso.');
    }

    public function settings()
    {
        return view('account.settings');
    }
}
