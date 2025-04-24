@extends('account.account-layout')

@section('title', 'Anúncios Favoritos')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-primary mb-6">Meus Favoritos</h1>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <p class="text-gray">
                    Aqui estão os imóveis que marcou como favoritos.
                </p>
                <div class="relative w-full sm:w-auto">
                    <select
                        id="sortFavorites"
                        class="dropdown-select py-2 pl-4 pr-10 w-full h-10">
                        <option disabled selected>Ordenar por</option>
                        <option value="price_asc">Preço: Menor para Maior</option>
                        <option value="price_desc">Preço: Maior para Menor</option>
                        <option value="date_desc">Data: Mais Recente</option>
                        <option value="date_asc">Data: Mais Antiga</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                        <i class="chevron bi bi-chevron-down transition-transform duration-300 ease-in-out"></i>
                    </div>
                </div>
            </div>

            <div id="favorites-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favorites as $favorite)
                    @php
                        $advertisement = optional($favorite->advertisement);
                        $property = optional($advertisement->property);
                        $image = $property->images[0] ?? asset('images/property-placeholder.jpg');
                        $title = $advertisement->title ?? 'Imóvel indisponível';
                        $parishName = optional($property->parish)->name ?? 'Localização indisponível';
                        $price = $advertisement->price ?? 0;
                    @endphp

                    <div class="home-ads-style favorite-card"
                         data-id="{{ $favorite->id }}"
                         data-price="{{ $price }}"
                         data-date="{{ $favorite->created_at->timestamp }}">
                        <div class="relative">
                            <img
                                src="{{ $image }}"
                                alt="{{ $title }}"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 flex items-center justify-center favorite-btn"
                                data-id="{{ $favorite->id }}"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-heart-fill text-red text-sm"></i>
                            </button>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-secondary">{{ $title }}</h3>
                            <p class="text-sm text-gray mb-2">{{ $parishName }}</p>
                            <p class="text-lg font-bold text-primary">{{ $price }}€</p>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="text-gray">Adicionado {{ $favorite->created_at->diffForHumans() }}</span>
                                <button class="text-red hover:text-red-700 font-medium transition-colors remove-favorite" data-id="{{ $favorite->id }}">Remover</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray mb-4">Não encontrou o que procura? Explore mais imóveis!</p>
                <a href="{{ route('advertisements.index') }}" class="btn-primary py-2 px-6">Ver Mais Imóveis</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function showToast(message, type = 'success') {
                let toastContainer = document.getElementById('toast-container');
                if (!toastContainer) {
                    toastContainer = document.createElement('div');
                    toastContainer.id = 'toast-container';
                    toastContainer.className = 'fixed bottom-4 right-4 z-50 flex flex-col gap-2';
                    document.body.appendChild(toastContainer);
                }

                const toast = document.createElement('div');
                toast.className = `py-2 px-4 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in max-w-xs text-sm font-medium bg-green-50 text-green-800 border-l-4 border-green-500`;
                toast.innerHTML = `<i class="bi bi-check-circle-fill text-green-500"></i> ${message}`;

                toastContainer.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('animate-fade-out');
                    setTimeout(() => {
                        toast.remove();
                        if (toastContainer.children.length === 0) {
                            toastContainer.remove();
                        }
                    }, 300);
                }, 3000);
            }

            // Ordenação
            const sortSelect = document.getElementById('sortFavorites');
            if (sortSelect) {
                sortSelect.addEventListener('change', function () {
                    const favoritesContainer = document.getElementById('favorites-container');
                    const favoriteCards = Array.from(document.querySelectorAll('.favorite-card'));
                    const sortValue = this.value;

                    favoriteCards.sort((a, b) => {
                        if (sortValue === 'price_asc') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        if (sortValue === 'price_desc') return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                        if (sortValue === 'date_desc') return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                        if (sortValue === 'date_asc') return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                        return 0;
                    });

                    favoriteCards.forEach(card => favoritesContainer.appendChild(card));
                });
            }

            // Remover favoritos
            const removeBtns = document.querySelectorAll('.remove-favorite, .favorite-btn');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', function (event) {
                    event.stopPropagation();

                    const favoriteId = this.dataset.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const favoriteCard = document.querySelector(`.favorite-card[data-id="${favoriteId}"]`);

                    if (!favoriteCard || favoriteCard.dataset.deleting === 'true') return;
                    favoriteCard.dataset.deleting = 'true';

                    // Animação + feedback
                    favoriteCard.classList.add('animate-fade-scale-out');
                    showToast('Anúncio removido dos favoritos');

                    fetch(`/favorites/${favoriteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                            if (response.ok) {
                                setTimeout(() => {
                                    favoriteCard.remove();
                                    const remainingFavorites = document.querySelectorAll('.favorite-card');
                                    if (remainingFavorites.length === 0) {
                                        document.getElementById('favorites-container').innerHTML = `
                                            <div class="col-span-full text-center py-8">
                                                <i class="bi bi-heart text-gray-300 text-5xl mb-4"></i>
                                                <p class="text-gray-400">Você não tem anúncios favoritos</p>
                                            </div>`;
                                    }
                                }, 300);
                            } else {
                                favoriteCard.classList.remove('animate-fade-scale-out');
                                favoriteCard.dataset.deleting = 'false';
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            favoriteCard.classList.remove('animate-fade-scale-out');
                            favoriteCard.dataset.deleting = 'false';
                        });
                }, { once: true }); // garante que só executa uma vez por botão
            });
        });
    </script>
@endpush

