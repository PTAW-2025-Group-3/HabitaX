<div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-transform hover:scale-[1.01] border border-gray-200">
    <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-2/5 relative">
                <img src="{{ $ad->property->images[0] }}" alt="{{ $ad['title'] }}" class="h-64 md:h-full w-full object-cover">
                @if(isset($ad['featured']) && $ad['featured'])
                    <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">Destaque</div>
                @endif
            </div>
            <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        {{-- Titulo e Localização --}}
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 leading-tight">{{ $ad['title'] }}</h3>
                            <p class="text-sm text-gray-700 font-medium flex items-center mt-1">
                                <i class="bi bi-geo-alt text-secondary"></i>
                                <span class="ml-1">{{ \App\Models\Parish::find($ad->property->parish_id)->name }}</span>
                            </p>
                        </div>
                        {{-- Favorito e Share --}}
                        <div class="flex space-x-1 ">
                            @php
                                $isFavorite = auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id);
                            @endphp

                            <button
                                data-ad-id="{{ $ad->id }}"
                                class="favorite-btn transition-colors h-10 w-10 rounded-full hover:bg-gray-100 {{ $isFavorite ? 'text-red-500' : 'text-gray-500' }}">
                                <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                            </button>
                            <button class="text-gray-500 hover:text-gray-900 transition-colors h-10 w-10 rounded-full hover:bg-gray-100">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-blue-9000 mt-4">{{ $ad['price'] }}</p>
                    <div class="flex items-center space-x-4 mt-4">
                        <div class="flex items-center text-gray-700">
                            <i class="bi bi-house-door-fill text-secondary"></i>
                            <span class="text-sm font-medium ml-1">{{ $ad['details'] }}</span>
                        </div>
                    </div>
                    <p class="text-gray-700 mt-4 leading-relaxed line-clamp-3">{{ $ad['description'] }}</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between">
                    <img src="{{ asset($ad['logo']) }}" alt="{{ $ad['agency'] }}" class="h-8">
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-white text-blue-900 border border-blue-900 rounded-lg font-medium text-sm hover:bg-blue-50 transition-colors">Ver Telefone</button>
                        <button class="px-4 py-2 bg-blue-900 text-white rounded-lg font-medium text-sm hover:bg-blue-800 transition-colors">Contactar</button>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const favoriteButtons = document.querySelectorAll('.favorite-btn');

            favoriteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    @auth
                    const adId = this.dataset.adId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const heartIcon = this.querySelector('i');

                    // Evita cliques repetidos rápidos
                    if (this.dataset.loading === 'true') return;
                    this.dataset.loading = 'true';

                    fetch(`/advertisements/${adId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                            if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                            return response.json();
                        })
                        .then(data => {
                            if (data.success && heartIcon) {
                                if (data.isFavorite) {
                                    heartIcon.classList.replace('bi-heart', 'bi-heart-fill');
                                    this.classList.remove('text-gray-500');
                                    this.classList.add('text-red-500');
                                } else {
                                    heartIcon.classList.replace('bi-heart-fill', 'bi-heart');
                                    this.classList.remove('text-red-500');
                                    this.classList.add('text-gray-500');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao atualizar favorito:', error);
                        })
                        .finally(() => {
                            this.dataset.loading = 'false';
                        });
                    @else
                        window.location.href = "{{ route('login') }}?redirect={{ url()->current() }}";
                    @endauth
                });
            });
        });
    </script>
@endpush

