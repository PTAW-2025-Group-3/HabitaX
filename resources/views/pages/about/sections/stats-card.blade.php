@props(['valor', 'texto', 'icone'])

@php
    $icons = [
        'home' => 'house-door',
        'document' => 'file-text',
        'location' => 'geo-alt',
    ];
@endphp

<div class="bg-white rounded-xl shadow-lg p-8 transform hover:translate-y-[-10px] transition-all duration-300 border-t-4 border-secondary">
    <div class="text-center">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-{{ $icons[$icone] }} text-secondary text-3xl leading-none"></i>
        </div>
        <h3 class="text-5xl font-bold text-secondary mb-2">{{ $valor }}</h3>
        <p class="text-gray font-medium">{{ $texto }}</p>
    </div>
</div>

