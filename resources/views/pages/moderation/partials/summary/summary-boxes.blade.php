<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach ([
        ['label' => 'Anúncios Ativos', 'value' => $pendingCount ?? 0, 'icon' => 'flag', 'color' => 'red'],
        ['label' => 'Anúncios por Resolver', 'value' => $reportedCount ?? 0, 'icon' => 'clock', 'color' => 'yellow'],
        ['label' => 'Anúncios Resolvidos', 'value' => $resolvedCount ?? 0, 'icon' => 'check-circle', 'color' => 'green'],
        ['label' => 'Utilizadores Suspensos', 'value' => $suspendedUsersCount ?? 0, 'icon' => 'person-x', 'color' => 'blue']
    ] as $item)
        @include('pages.moderation.partials.summary.summary-box', ['item' => $item])
    @endforeach
</div>
