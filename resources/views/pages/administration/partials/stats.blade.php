@php
    $stats = [
        ['label' => 'Utilizadores Ativos', 'value' => $activeUsers ?? 0],
        ['label' => 'Anúncios Publicados', 'value' => $publishedAds ?? 0],
        ['label' => 'Anúncios Reportados', 'value' => $reportedAds ?? 0],
        ['label' => 'Utilizadores Registados', 'value' => $totalUsers ?? 0],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 my-8">
    @foreach($stats as $stat)
        <div class="bg-white p-5 rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <h3 class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</h3>
            <p class="text-3xl font-bold text-primary mt-1">{{ number_format($stat['value'], 0, ',', '.') }}</p>
        </div>
    @endforeach
</div>
