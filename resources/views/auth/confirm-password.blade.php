@extends('layout.app')

@section('title', 'Confirm Password')

@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
            <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-lock"></i>
                            </span>
                <input id="password" name="password" type="password" required
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                       title="Password deve ter pelo menos 8 caracteres, incluindo maiúsculas, minúsculas, número e símbolo"
                       placeholder="Introduz a tua password"
                       class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition">
            </div>

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
                Submit
            </button>
        </div>
    </form>
@endsection
