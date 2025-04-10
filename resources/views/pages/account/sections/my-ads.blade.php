@extends('pages.account.account')

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
        {{-- Ad Card 1 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="active">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                     alt="Ad"
                     class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    Ativo
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-primary">Moradia T4 com Piscina - Venda</h3>
                <p class="text-sm text-gray mb-2">Porto, Portugal</p>
                <p class="text-lg font-bold text-secondary">495.000€</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray">Publicado há 2 dias</span>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-pencil text-secondary"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ad Card 2 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="pending">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                     alt="Ad"
                     class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Pendente
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-primary">Apartamento T2 Moderno - Arrendamento</h3>
                <p class="text-sm text-gray mb-2">Lisboa, Portugal</p>
                <p class="text-lg font-bold text-secondary">1.200€/mês</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray">Publicado há 1 semana</span>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-pencil text-secondary"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ad Card 3 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="inactive">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                     alt="Ad"
                     class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                    Inativo
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-primary">Estúdio no Centro - Arrendamento</h3>
                <p class="text-sm text-gray mb-2">Braga, Portugal</p>
                <p class="text-lg font-bold text-secondary">650€/mês</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray">Publicado há 3 dias</span>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-pencil text-secondary"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ad Card 4 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="active">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                     alt="Ad"
                     class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    Ativo
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-primary">Loja Comercial no Centro - Arrendamento</h3>
                <p class="text-sm text-gray mb-2">Porto, Portugal</p>
                <p class="text-lg font-bold text-secondary">1.800€/mês</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray">Publicado há 5 dias</span>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-pencil text-secondary"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ad Card 5 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="active">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                     alt="Ad"
                     class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    Ativo
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-primary">Moradia de Luxo T5 - Venda</h3>
                <p class="text-sm text-gray mb-2">Cascais, Portugal</p>
                <p class="text-lg font-bold text-secondary">1.250.000€</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray">Publicado há 1 dia</span>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-pencil text-secondary"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
        // Setup dropdown for status filtering
        const statusSelect = document.getElementById('status_filter');
        const adCards = document.querySelectorAll('[data-status]');
        const noAdsMessage = document.getElementById('no-ads');

        // Rotate chevron when dropdown is active
        statusSelect.addEventListener('focus', function() {
            this.nextElementSibling.querySelector('.chevron').classList.add('rotate-90');
        });

        statusSelect.addEventListener('blur', function() {
            this.nextElementSibling.querySelector('.chevron').classList.remove('rotate-90');
        });

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
