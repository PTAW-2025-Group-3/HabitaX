@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-4 py-12">
  <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 transition-all duration-300">

    {{-- Title --}}
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Create Account</h2>
    <p class="text-center text-sm text-gray-500 mb-6">Welcome to HabitaX</p>

    {{-- Validation Errors --}}
    @if ($errors->any())
      <div class="mb-4 text-sm text-red-600">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Registration Form --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
      @csrf

      {{-- Name --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input id="name" name="name" type="text" required
               pattern="^[A-Za-zÀ-ÿ\s]{3,50}$"
               title="Name must be 3-50 characters and only letters"
               placeholder="John Doe"
               class="w-full mt-1 px-4 py-2 border border-gray-300 bg-white text-gray-800 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
               value="{{ old('name') }}">
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required
               pattern="^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$"
               placeholder="you@example.com"
               class="w-full mt-1 px-4 py-2 border border-gray-300 bg-white text-gray-800 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
               value="{{ old('email') }}">
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
          title="Password must be at least 8 characters, including uppercase, lowercase, number, and special character"
          placeholder="Enter your password"
          class="w-full mt-1 px-4 py-2 border border-gray-300 bg-white text-gray-800 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
        >
      
        <div class="mt-2 text-xs text-gray-500 space-y-1">
          <p class="font-semibold text-gray-600">Password must include:</p>
          <ul class="list-disc list-inside">
            <li>✅ Minimum 8 characters</li>
            <li>✅ 1 uppercase (A-Z)</li>
            <li>✅ 1 lowercase (a-z)</li>
            <li>✅ 1 number (0-9)</li>
            <li>✅ 1 special character (@$!%*#?&)</li>
          </ul>
          <p class="pt-2 text-gray-500">Examples:</p>
          <code class="block text-indigo-600">Xh@82!kL</code>
          <code class="block text-indigo-600">SafePass@123</code>
        </div>
      </div>      
      {{-- Confirm Password --}}
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required
               placeholder="Re-enter password"
               class="w-full mt-1 px-4 py-2 border border-gray-300 bg-white text-gray-800 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
      </div>

      {{-- Terms Checkbox --}}
      <div class="flex items-start gap-2">
        <input id="terms" name="terms" type="checkbox" required
               class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded">
        <label for="terms" class="text-sm text-gray-600">
          I accept the <a href="#" class="text-indigo-600 hover:underline">terms of use</a> and
          <a href="#" class="text-indigo-600 hover:underline">privacy policy</a>
        </label>
      </div>

      {{-- Submit --}}
      <div>
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-md transition-all duration-300">
          Register
        </button>
      </div>
    </form>

    {{-- Login Link --}}
    <div class="mt-6 text-center text-sm text-gray-500">
      Already have an account?
      <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Sign In</a>
    </div>

  </div>
</section>
@endsection
