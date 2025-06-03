@php use Illuminate\Support\Facades\Storage; @endphp
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
                <div class="relative dropdown-wrapper w-full sm:w-auto">
                    <form action="{{ route('favorites.index') }}" method="GET" id="sortForm">
                        <select id="sortFavorites" name="sort" class="dropdown-select py-2 pl-4 pr-10 w-full h-10" onchange="document.getElementById('sortForm').submit()">
                            <option disabled {{ !request('sort') ? 'selected' : '' }}>Ordenar por</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Preço: Menor para Maior</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preço: Maior para Menor</option>
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Data: Mais Recente</option>
                            <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Data: Mais Antiga</option>
                        </select>
                    </form>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                        <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                    </div>
                </div>
            </div>

            <div id="favorites-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($favorites->isEmpty())
                    <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="bi bi-heart text-gray-300 text-2xl"></i>
                            </div>
                            <p class="text-gray-400">Você não tem anúncios favoritos</p>
                        </div>
                    </div>
                @else
                    @foreach($favorites as $favorite)
                        @php
                            $advertisement = optional($favorite->advertisement);
                            $property = optional($advertisement->property);
                            $image = $property->getFirstMediaUrl('images', 'thumb') ?? asset('images/property-placeholder.png');
                            $title = $advertisement->title ?? 'Imóvel indisponível';
                            $parishName = optional($property->parish)->name ?? 'Localização indisponível';
                            $price = $advertisement->price ?? 0;
                            $creator = optional($advertisement->creator);
                            $creatorImage = $creator ? $creator->getProfilePictureUrl() : null;
                        @endphp

                        <div class="bg-white rounded-2xl border border-gray-200 shadow hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden group favorite-card"
                             data-id="{{ $favorite->id }}"
                             data-advertisement-id="{{ $advertisement->id ?? '' }}">

                            <div class="relative group overflow-hidden">
                                <img src="{{ $image }}" alt="{{ $title }}" class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-300">

                                <button class="absolute top-4 right-4 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 flex items-center justify-center remove-favorite" data-id="{{ $favorite->id }}">
                                    <i class="bi bi-heart-fill text-red-500 text-lg"></i>
                                </button>
                            </div>

                            <div class="flex flex-col p-4 flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800 leading-tight hover:text-primary transition-colors line-clamp-2 mb-1">
                                    {{ $title }}
                                </h3>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="bi bi-geo-alt mr-1"></i>
                                    <span>{{ $parishName }}</span>
                                </div>

                                <div class="flex items-center justify-between mt-2 mb-3">
                                    <p class="text-xl font-bold text-blue-800">{{ number_format($price, 0, ',', '.') }} €</p>
                                </div>

                                <div class="flex items-center justify-between text-xs text-gray-500 mt-auto border-t pt-3">
                                    <div class="flex items-center gap-2">
                                        @if($creatorImage)
                                            <img src="{{ $creatorImage }}" alt="{{ $creator->name }}" class="h-7 w-7 rounded-full object-cover shadow-sm">
                                        @else
                                            <div class="h-7 w-7 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 shadow-sm">
                                                <i class="bi bi-person text-xs"></i>
                                            </div>
                                        @endif
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-700 text-sm line-clamp-1">{{ $creator->name ?? 'Anunciante' }}</span>
                                            <span class="text-[11px] text-gray-400">{{ $favorite->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="mt-6">
                {{ $favorites->withQueryString()->links() }}
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

            document.querySelectorAll('.favorite-card').forEach(card => {
                card.addEventListener('click', function (e) {
                    if (e.target.closest('.remove-favorite')) return;
                    const advertisementId = this.dataset.advertisementId;
                    if (advertisementId) {
                        window.location.href = `/advertisements/${advertisementId}`;
                    }
                });
            });

            document.querySelectorAll('.remove-favorite').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const favoriteId = this.dataset.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const favoriteCard = document.querySelector(`.favorite-card[data-id="${favoriteId}"]`);

                    if (!favoriteCard || favoriteCard.dataset.deleting === 'true') return;
                    favoriteCard.dataset.deleting = 'true';

                    favoriteCard.classList.add('animate-fade-scale-out');

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
                                showToast('Anúncio removido dos favoritos');

                                setTimeout(() => {
                                    favoriteCard.remove();
                                    if (document.querySelectorAll('.favorite-card').length === 0) {
                                        document.getElementById('favorites-container').innerHTML = `
                                <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="bi bi-heart text-gray-300 text-2xl"></i>
                                        </div>
                                        <p class="text-gray-400">Você não tem anúncios favoritos</p>
                                    </div>
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
                });
            });
        });
    </script>
@endpush
