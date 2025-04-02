@extends('layout.app')

@section('title', 'Register')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-white px-4 py-12">
        <div class="relative w-full max-w-md bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-8 overflow-hidden animate-fade-in">

            {{-- Decorative Blur --}}
            <div class="absolute -top-12 -left-12 w-40 h-40 bg-indigo-300 opacity-20 rounded-full filter blur-2xl z-0"></div>
            <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-purple-300 opacity-20 rounded-full filter blur-2xl z-0"></div>

            {{-- Title --}}
            <h2 class="relative text-3xl font-bold text-center text-gray-800 dark:text-white mb-6 z-10">Criar uma Conta</h2>
            <p class="text-center text-sm text-gray-500 mb-6 z-10">Bem-vindo ao HabitaX</p>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="relative mb-4 text-sm text-red-600 z-10">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Registration Form --}}
            <form method="POST" action="{{ route('register') }}" class="relative space-y-5 z-10" novalidate>
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nome</label>
                    <input id="name" name="name" type="text" required
                           pattern="^[A-Za-zÀ-ÿ\s]{3,50}$"
                           title="Name must be 3-50 characters and only letters"
                           placeholder="O seu nome"
                           class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('name') }}">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input id="email" name="email" type="email" required
                           pattern="^[\w\-.]+@([\w\-]+\.)+[\w\-]{2,4}$"
                           placeholder="oteu@email.com"
                           class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('email') }}">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    <input id="password" name="password" type="password" required
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                           title="Password must be at least 8 characters, including uppercase, lowercase, number, and special character"
                           placeholder="Introduz a tua password"
                           class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-300 space-y-1">
                        <p class="font-semibold text-gray-600 dark:text-gray-400">A password deve incluir:</p>
                        <ul class="list-disc list-inside">
                            <li>Minimo de 8 caracteres</li>
                            <li>1 maiúscula (A-Z)</li>
                            <li>1 minúscula (a-z)</li>
                            <li>1 número (0-9)</li>
                            <li>1 caracter especial (@$!%*#?&)</li>
                        </ul>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirme a Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           placeholder="Reintroduza a password"
                           class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Terms Checkbox --}}
                <div class="flex items-start gap-2">
                    <input id="terms" name="terms" type="checkbox" required
                           class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="terms" class="text-sm text-gray-600 dark:text-gray-300">
                        Eu aceito <a href="#" class="text-indigo-600 hover:underline">os termos de uso</a> e a
                        <a href="#" class="text-indigo-600 hover:underline">política de privacidade</a>
                    </label>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-xl shadow-md transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                        Criar
                    </button>
                </div>
            </form>

            {{-- Login Link --}}
            <div class="mt-6 text-center text-sm text-gray-500 dark:text-gray-300">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">LogIn</a>
            </div>

        </div>
    </section>
@endsection
