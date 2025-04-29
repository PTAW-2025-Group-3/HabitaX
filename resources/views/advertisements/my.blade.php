@extends('account.account-layout')

@section('account-content')
<div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-primary">Meus Anúncios</h1>
        <a href="" class="btn-primary py-2 px-4 flex items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            Criar Anúncio
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <p class="text-gray">
            Aqui estão os anúncios que publicou na HabitaX.
        </p>

        <!-- Status Filter -->
        <div class="relative dropdown-wrapper w-full sm:w-64">
            <select id="status_filter" name="status_filter" class="dropdown-select py-2 pl-4 pr-10 w-full h-10 border border-gray-300 rounded-lg">
                <option value="all">Todos</option>
                <option value="active">Ativos</option>
                <option value="pending">Pendentes</option>
                <option value="inactive">Inativos</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($ads as $ad)
            @include('advertisements.ad-card', ['ad' => $ad])
        @endforeach
    </div>

    <!-- No ads message (hidden by default) -->
    <div id="no-ads" class="hidden text-center py-10">
        <i class="bi bi-megaphone text-gray-400 text-5xl mb-4"></i>
        <h3 class="text-lg font-medium text-gray-800">Nenhum anúncio encontrado</h3>
        <p class="text-gray-600 mt-2">Não foram encontrados anúncios com o status selecionado.</p>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status_filter');
        const adCards = document.querySelectorAll('[data-status]');
        const noAdsMessage = document.getElementById('no-ads');

        // Filter ads based on selection
        statusSelect.addEventListener('change', function() {
            const selectedStatus = this.value;
            let visibleCount = 0;

            adCards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');

                if (selectedStatus === 'all' || cardStatus === selectedStatus) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Show/hide "no ads" message
            if (visibleCount === 0) {
                noAdsMessage.classList.remove('hidden');
            } else {
                noAdsMessage.classList.add('hidden');
            }
        });
    });
</script>
@endpush
@endsection
