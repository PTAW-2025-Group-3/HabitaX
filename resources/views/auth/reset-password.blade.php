@extends('layout.app')

@section('title', 'Redefinir Senha')

@section('content')
    <div class="w-full max-w-md mx-auto p-6 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token de Redefinição de Senha -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Endereço de E-mail -->
            <div>
                <div class="relative">
                    <label for="email"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">E-mail</label>
                    <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-envelope"></i>
                            </span>
                        <input id="email" name="email" type="email" required autofocus autocomplete="username"
                               pattern="^[\w\-.]+@([\w\-]+\.)+[\w\-]{2,4}$"
                               placeholder="seuemail@exemplo.com"
                               class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition @error('email') border-red-500 @enderror"
                               value="{{ old('email', $request->email) }}">
                    </div>
                    @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Senha -->
            <div class="mt-4">
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Senha</label>
                    <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-lock"></i>
                            </span>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                               title="Senha deve ter pelo menos 8 caracteres, incluindo maiúsculas, minúsculas, número e símbolo"
                               placeholder="Digite sua nova senha"
                               class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition @error('password') border-red-500 @enderror">
                    </div>
                    @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror

                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-300 space-y-1">
                        <p class="font-semibold text-gray-600 dark:text-gray-400">A password deve incluir:</p>
                        <ul class="list-disc list-inside">
                            <li>Mínimo de 8 caracteres</li>
                            <li>1 maiúscula (A-Z)</li>
                            <li>1 minúscula (a-z)</li>
                            <li>1 número (0-9)</li>
                            <li>1 símbolo especial (@$!%*#?&)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Confirmar Senha -->
            <div class="mt-4">
                <div class="relative">
                    <label for="password_confirmation"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirme a
                        Password</label>
                    <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                               placeholder="Digite sua senha novamente"
                               class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="btn-secondary w-full py-3">
                    Redefinir Password
                </button>
            </div>
        </form>
    </div>
@endsection
