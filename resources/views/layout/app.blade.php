<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logos/habitaxLogo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-back">

{{-- Custom Navigation Bar --}}
@include('layout.header')

<div class="min-h-screen flex flex-col justify-between">
    {{-- Optional Page Header --}}
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Spacer --}}
    <div class="h-40 bg-back"></div>

    {{-- Main Page Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Global Footer --}}
    @include('layout.footer')
</div>

{{-- Page-specific JS Scripts --}}
@stack('scripts')

<script type="module">
    // Dropdown com chevron animado
    document.querySelectorAll('.dropdown-wrapper').forEach(wrapper => {
        const chevron = wrapper.querySelector('.chevron');

        wrapper.addEventListener('click', () => {
            chevron.classList.toggle('rotate-90');
        });

        document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) {
                chevron.classList.remove('rotate-90');
            }
        });
    });
</script>
</body>
</html>
