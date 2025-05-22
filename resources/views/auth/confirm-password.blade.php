@extends('layout.app')

@section('title', 'Confirmar Senha')

@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Esta é uma área segura da aplicação. Por favor, confirme a sua palavra-passe antes de continuar.
    </div>

    @if ($errors->any())
        <div class="mb-4 font-medium text-sm text-red-600 dark:text-red-400 p-4 bg-red-100 dark:bg-red-800/30 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Senha -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Senha</label>
            <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-lock"></i>
                            </span>
                <input id="password" name="password" type="password" required
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                       title="A senha deve ter pelo menos 8 caracteres, incluindo maiúsculas, minúsculas, número e símbolo"
                       placeholder="Digite sua senha"
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

        <div class="flex justify-end mt-4">
            <button type="submit"
                    class="btn-secondary w-full py-3">
                Confirmar
            </button>
        </div>
    </form>
@endsection
