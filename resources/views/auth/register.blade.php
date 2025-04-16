@extends('layout.app')

@section('title', 'Register')

@section('content')
    <section class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div
            class="w-full max-w-6xl flex flex-col lg:flex-row bg-white dark:bg-gray-900 rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden animate-fade-in">

            {{-- Image Section (Left) --}}
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                    alt="Modern apartment interior"
                    class="object-cover w-full h-full">
            </div>

            {{-- Form Section (Right) --}}
            <div class="w-full lg:w-1/2 p-5 sm:p-8 lg:p-12 relative">
                {{-- Decorative Blur --}}
                <div
                    class="absolute -top-12 -left-12 w-32 sm:w-40 h-32 sm:h-40 bg-indigo-300 opacity-20 rounded-full filter blur-2xl z-0"></div>
                <div
                    class="absolute -bottom-12 -right-12 w-32 sm:w-40 h-32 sm:h-40 bg-purple-300 opacity-20 rounded-full filter blur-2xl z-0"></div>

                {{-- Title --}}
                <div class="text-center mb-6 relative z-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">HabitaX | Criar uma
                        Conta</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Bem-vindo à HabitaX — começa hoje a tua
                        jornada.</p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="relative mb-4 p-3 bg-red-50 text-xs sm:text-sm text-red-600 rounded-lg z-10">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Registration Form --}}
                <form method="POST" action="{{ route('register') }}" class="relative space-y-4 sm:space-y-5 z-10"
                      novalidate>
                    @csrf

                    {{-- Name --}}
                    <div class="relative">
                        <label for="name"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nome</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-person"></i>
                            </span>
                            <input id="name" name="name" type="text" required
                                   pattern="^[A-Za-zÀ-ÿ\s]{3,50}$"
                                   title="Nome deve ter entre 3 e 50 letras"
                                   placeholder="O seu nome"
                                   class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                                   value="{{ old('name') }}">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="relative">
                        <label for="email"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" name="email" type="email" required
                                   pattern="^[\w\-.]+@([\w\-]+\.)+[\w\-]{2,4}$"
                                   placeholder="oteu@email.com"
                                   class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                                   value="{{ old('email') }}">
                        </div>
                    </div>


                    {{-- Password --}}
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

                    {{-- Confirm Password --}}
                    <div class="relative">
                        <label for="password_confirmation"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirme a
                            Password</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   placeholder="Reintroduza a password"
                                   class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition">
                        </div>
                    </div>


                    {{-- Terms Checkbox --}}
                    <div class="flex items-start gap-2">
                        <input id="terms" name="terms" type="checkbox" required
                               class="mt-1 h-4 w-4 text-secondary border-gray-300 rounded">
                        <label for="terms" class="text-xs sm:text-sm text-gray dark:text-gray-300">
                            Eu aceito <a href="#" class="text-secondary hover:underline">os termos de uso</a> e a
                            <a href="#" class="text-secondary hover:underline">política de privacidade</a>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit"
                                class="btn-secondary w-full py-3">
                            Criar
                        </button>
                    </div>
                </form>

                {{-- Login Link --}}
                <div class="mt-5 sm:mt-6 text-center text-sm text-gray-500 dark:text-gray-300">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-secondary font-medium hover:underline">Login</a>
                </div>
            </div>
        </div>
    </section>
@endsection
