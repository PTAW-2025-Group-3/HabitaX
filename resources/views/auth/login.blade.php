@extends('layout.app')

@section('title', 'Login')

@section('content')
    <section class="min-h-screen grid place-content-start justify-center pt-16 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl flex flex-col lg:flex-row bg-white dark:bg-gray-900 rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden animate-fade-in">
            {{-- Image Section (Left) --}}
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img src="{{ asset('images/login-side.avif') }}"
                     alt="Modern apartment living room"
                     class="object-cover w-full h-full">
            </div>

            {{-- Form Section (Right) --}}
            <div class="w-full lg:w-1/2 p-5 sm:p-8 lg:p-12 relative">
                {{-- Decorative Blur --}}
                <div class="absolute -top-12 -left-12 w-32 sm:w-40 h-32 sm:h-40 bg-indigo-300 opacity-20 rounded-full filter blur-2xl z-0"></div>
                <div class="absolute -bottom-12 -right-12 w-32 sm:w-40 h-32 sm:h-40 bg-purple-300 opacity-20 rounded-full filter blur-2xl z-0"></div>

                {{-- Title --}}
                <div class="text-center mb-6 relative z-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">
                        HabitaX | Login
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Faça login para retomar a sua experiência.
                    </p>
                </div>

                {{-- Flash Message --}}
                @if(session('status'))
                    <div class="relative mb-4 p-3 bg-green-50 text-xs sm:text-sm text-green-600 rounded-lg z-10">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="relative mb-4 p-3 bg-red-50 text-xs sm:text-sm text-red-600 rounded-lg z-10">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="relative space-y-5 z-10">
                    @csrf

                    {{-- Email --}}
                    <div class="relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" name="email" type="email" required autofocus
                                   class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                                   placeholder="seu@email.com">
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
                                   class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                                   placeholder="••••••••">
                        </div>
                    </div>


                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember"
                                   class="h-4 w-4 text-secondary border-gray-300 rounded">
                            <span class="text-sm text-white">Guardar Autenticação</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-secondary hover:underline">
                            Esqueceu a password?
                        </a>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit"
                                class="btn-secondary w-full py-3">
                            Login
                        </button>
                    </div>
                </form>

                {{-- Divider --}}
                <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-300">
                    Não tem conta ainda?
                    <a href="{{ route('register') }}" class="text-secondary font-medium hover:underline">Registar</a>
                </div>
            </div>
        </div>
    </section>
@endsection
