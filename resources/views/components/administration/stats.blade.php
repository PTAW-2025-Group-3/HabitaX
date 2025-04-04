@php
    $stats = [
        ['label' => 'Utilizadores Ativos', 'value' => 5320],
        ['label' => 'Anúncios Publicados', 'value' => 12540],
        ['label' => 'Anúncios Reportados', 'value' => 1520],
        ['label' => 'Utilizadores Registados', 'value' => 12],
    ];
@endphp

<div class="grid grid-cols-4 gap-4 text-center my-8">
    @foreach($stats as $stat)
        <div>
            <h3 class="text-sm font-semibold text-gray-600">{{ $stat['label'] }}</h3>
            <p class="text-2xl text-blue-600 font-bold">{{ $stat['value'] }}</p>
        </div>
    @endforeach
</div>
