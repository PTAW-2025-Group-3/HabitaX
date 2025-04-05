@php
    $stats = [
        ['label' => 'Utilizadores Ativos', 'value' => 5320],
        ['label' => 'Anúncios Publicados', 'value' => 12540],
        ['label' => 'Anúncios Reportados', 'value' => 1520],
        ['label' => 'Utilizadores Registados', 'value' => 12],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 my-8 animate-fade-in">
    @foreach($stats as $stat)
        <div class="bg-white p-5 rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <h3 class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</h3>
            <p class="text-3xl font-bold text-primary mt-1">{{ number_format($stat['value'], 0, ',', '.') }}</p>
        </div>
    @endforeach
</div>
