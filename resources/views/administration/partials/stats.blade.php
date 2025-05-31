@php
    $stats = [
        [
            'label' => 'Utilizadores Ativos',
            'value' => $activeUsers ?? 0,
            'icon' => 'person-check-fill',
            'color' => 'green'
        ],
        [
            'label' => 'Anúncios Publicados',
            'value' => $publishedAds ?? 0,
            'icon' => 'house-check-fill',
            'color' => 'blue'
        ],
        [
            'label' => 'Anúncios Reportados',
            'value' => $reportedAds ?? 0,
            'icon' => 'exclamation-triangle-fill',
            'color' => 'yellow'
        ],
        [
            'label' => 'Utilizadores Registados',
            'value' => $totalUsers ?? 0,
            'icon' => 'people-fill',
            'color' => 'blue'
        ],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 my-8">
    @foreach($stats as $stat)
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-bold mt-1
                        @if($stat['color'] === 'red') text-red-600
                        @elseif($stat['color'] === 'yellow') text-amber-500
                        @elseif($stat['color'] === 'green') text-emerald-600
                        @else text-blue-600
                        @endif">
                        {{ number_format($stat['value'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full flex items-center justify-center
                    @if($stat['color'] === 'red') bg-red-100 text-red-600
                    @elseif($stat['color'] === 'yellow') bg-amber-100 text-amber-600
                    @elseif($stat['color'] === 'green') bg-emerald-100 text-emerald-600
                    @else bg-blue-100 text-blue-600
                    @endif">
                    <i class="bi bi-{{ $stat['icon'] }} text-xl"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>
