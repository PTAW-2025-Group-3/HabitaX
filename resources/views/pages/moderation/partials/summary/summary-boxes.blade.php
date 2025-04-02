<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach ([
        ['label' => 'Anúncios Reportados', 'value' => 23, 'icon' => 'flag', 'color' => 'red'],
        ['label' => 'Anúncios por Resolver', 'value' => 17, 'icon' => 'clock', 'color' => 'yellow'],
        ['label' => 'Anúncios Resolvidos', 'value' => 6, 'icon' => 'check-circle', 'color' => 'green'],
        ['label' => 'Utilizadores Suspensos', 'value' => 12, 'icon' => 'user-slash', 'color' => 'blue']
    ] as $item)
        @include('pages.moderation.partials.summary.summary-box', ['item' => $item])
    @endforeach
</div>
