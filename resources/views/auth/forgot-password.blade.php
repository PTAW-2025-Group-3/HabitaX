@extends('layout.app')

@section('title', 'Recuperar Password')

@section('content')
    <div class="w-full max-w-md mx-auto p-6 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Esqueceu a sua password? Informe-nos o seu endereço de e-mail e enviaremos um link de redefinição de password que permitirá escolher uma nova.
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="relative">
                <label for="email"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-200">E-mail</label>
                <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-envelope"></i>
                            </span>
                    <input id="email" name="email" type="email" required
                           pattern="^[\w\-.]+@([\w\-]+\.)+[\w\-]{2,4}$"
                           placeholder="seuemail@exemplo.com"
                           class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                           value="{{ old('email') }}">
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="btn-secondary w-full py-3">
                    Enviar Link de Recuperação
                </button>
            </div>
        </form>
    </div>
@endsection
