@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-white to-gray-100 px-4 py-12">
  <div class="relative w-full max-w-md bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-8 overflow-hidden animate-fade-in">
    
    {{-- Decorative Blur --}}
    <div class="absolute -top-12 -left-12 w-40 h-40 bg-indigo-300 opacity-20 rounded-full filter blur-2xl z-0"></div>
    <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-purple-300 opacity-20 rounded-full filter blur-2xl z-0"></div>

    {{-- Title --}}
    <h2 class="relative text-3xl font-bold text-center text-gray-800 dark:text-white mb-6 z-10">
      Welcome Back
    </h2>

    {{-- Flash Message --}}
    @if(session('status'))
      <div class="relative mb-4 text-sm text-green-600 z-10">
        {{ session('status') }}
      </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
      <div class="relative mb-4 text-sm text-red-600 z-10">
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
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
        <input id="email" name="email" type="email" required autofocus
               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
        <input id="password" name="password" type="password" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
      </div>

      {{-- Remember Me --}}
      <div class="flex items-center justify-between">
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
          <span class="text-sm text-gray-600 dark:text-gray-300">Remember me</span>
        </label>
        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
      </div>

      {{-- Submit --}}
      <div>
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-xl shadow-md transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
          Sign In
        </button>
      </div>
    </form>

    {{-- Divider --}}
    <div class="mt-6 text-center text-sm text-gray-500 dark:text-gray-300">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
    </div>

  </div>
</section>
@endsection
