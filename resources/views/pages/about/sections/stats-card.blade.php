@props(['valor', 'texto', 'icone'])

@php
    $icons = [
        'home' => '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
        'document' => '<path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
        'location' => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
    ];
@endphp

<div class="bg-white rounded-xl shadow-lg p-8 transform hover:translate-y-[-10px] transition-all duration-300 border-t-4 border-secondary">
    <div class="text-center">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {!! $icons[$icone] !!}
            </svg>
        </div>
        <h3 class="text-5xl font-bold text-secondary mb-2">{{ $valor }}</h3>
        <p class="text-gray font-medium">{{ $texto }}</p>
    </div>
</div>

