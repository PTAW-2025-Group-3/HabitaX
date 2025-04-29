@extends('layout.app')

@section('title', 'Advertisement Details')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 md:p-4 space-y-6 animate-fade-in">

        <!-- Header do anúncio  -->
        <div class="bg-gradient-to-r bg-white rounded-2xl shadow-md p-5 md:p-7 space-y-4 mt-6 md:mt-12">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div class="space-y-1">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-primary flex items-center gap-2">
                        <i class="bi bi-house-door-fill text-secondary"></i>
                        {{ $ad->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-2 text-sm md:text-base text-gray-600">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-geo-alt text-secondary"></i> {{ $property->country }}
                </span>
                        <span class="inline-flex items-center gap-1">
                    <i class="bi bi-geo-alt text-secondary"></i> {{ $property->parish->name }}, {{ $property->parish->municipality->name }}
                </span>
                        <span class="inline-flex items-center gap-1">
                    <i class="bi bi-arrow-left-right text-secondary"></i> {{ $ad->transaction_type }}
                </span>
                    </div>
                </div>
                <div class="text-3xl md:text-4xl font-bold text-secondary">
                    {{ number_format($ad->price, 0, ',', '.') }}€
                </div>
            </div>

            <!-- Botões de ação - adicionados aqui -->
            <div class="flex flex-wrap justify-end gap-2 pt-3 border-t border-gray-100 mt-4">
                <button id="shareBtn" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors">
                    <i class="bi bi-share-fill"></i>
                    <span class="text-sm font-medium">Partilhar</span>
                </button>

                <button id="favoriteBtn"
                        data-ad-id="{{ $ad->id }}"
                        class="inline-flex items-center gap-1 px-3 py-1.5 {{ auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id) ? 'bg-rose-100 text-rose-600' : 'bg-rose-50 hover:bg-rose-100 text-rose-600' }} rounded-lg transition-colors">
                    <i class="bi {{ auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                    <span class="text-sm font-medium">{{ auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id) ? 'Adicionado' : 'Favoritos' }}</span>
                </button>

                <button id="reportBtn" class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg transition-colors">
                    <i class="bi bi-flag"></i>
                    <span class="text-sm font-medium">Reportar</span>
                </button>
            </div>
        </div>

        <!-- Galeria -->
        <div id="lightgallery" class="grid grid-cols-12 gap-2 md:gap-4 relative">
            <!-- Visible part -->
            <a href="{{ $property->images[0] }}" class="col-span-12 md:col-span-6 h-[300px] md:h-[500px]">
                <img src="{{ $property->images[0] }}"
                     class="w-full h-full object-cover rounded-lg shadow" alt="Imagem Principal">
            </a>

            <div class="col-span-12 md:col-span-6 grid grid-cols-2 grid-rows-2 gap-2 h-[300px] md:h-[500px]">
                @foreach($property->images as $image)
                    @if(!$loop->first && $loop->index < 5)
                        <a href="{{ $image }}">
                            <img src="{{ $image }}"
                                 class="w-full h-full object-cover rounded-lg shadow" alt="Miniatura">
                        </a>
                    @endif
                @endforeach

                @for($i = count($property->images); $i < 5; $i++)
                    <div class="bg-gray-100 rounded-lg shadow"></div>
                @endfor
            </div>

            <!-- Hidden links for LightGallery -->
            <div class="hidden">
                @foreach($property->images as $image)
                    @if($loop->index >= 5)
                        <a href="{{ $image }}">
                            <img src="{{ $image }}" alt="Miniatura oculta" class="hidden">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Botão separado! -->
        @if(count($property->images) > 5)
            <div class="mt-4 text-right">
                <button id="openGalleryButton"
                        class="inline-block bg-white bg-opacity-80 backdrop-blur px-4 py-2 text-sm rounded shadow text-gray-700 font-semibold hover:bg-opacity-100 transition">
                    Mostrar todas as fotos
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <div class="col-span-1 md:col-span-2 space-y-4">
                <section class="space-y-2">
                    <h2 class="text-lg md:text-xl font-semibold">Comentário do Anunciante</h2>
                    <p class="text-gray-700 text-sm md:text-base">{{ $ad->description }}</p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 md:p-4 rounded shadow">
                        <h3 class="font-semibold">Equipamentos</h3>
                        <ul class="list-disc list-inside text-sm md:text-base">
                            {{--                            @foreach($ad->equipments as $eq)--}}
                            {{--                                <li>{{ $eq }}</li>--}}
                            {{--                            @endforeach--}}
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-3 md:p-4 rounded shadow">
                        <h3 class="font-semibold">Características Específicas</h3>
                        <ul class="list-disc list-inside text-sm md:text-base">
                            @foreach($attributes as $attribute)
                                <li>{{ $attribute['name'] }}: {{ $attribute['value'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                @include('advertisements.individual.price-history', ['ad' => $ad])
                @include('advertisements.individual.loan-simulator', ['ad' => $ad])
            </div>

            <div class="space-y-6 animate-fade-in">
                <!-- Mapa com estilo moderno -->
                <div class="bg-gradient-to-tr from-indigo-50 to-white rounded-2xl shadow-md overflow-hidden">
                    <div class="h-48 md:h-56">
                        <iframe
                            src="https://www.google.com/maps/embed?..."
                            class="w-full h-full border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                    <button
                        class="w-full text-blue-600 hover:text-blue-700 bg-white text-sm md:text-base font-semibold py-3 border-t border-indigo-100 transition">
                        <i class="bi bi-geo-alt-fill mr-1"></i> Ver no mapa
                    </button>
                </div>

                @include('advertisements.individual.contact-form', ['ad' => $ad])
            </div>

        </div>
    </div>
@endsection
@include('advertisements.individual.modals.denunciation', ['denunciationReasons' => $denunciationReasons, 'adId' => $ad->id])
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Report button handler
            const reportBtn = document.getElementById('reportBtn');
            if (reportBtn) {
                reportBtn.addEventListener('click', function() {
                    if (typeof openReportModal === 'function') {
                        openReportModal();
                    } else {
                        console.error('openReportModal function not found');
                    }
                });
            }

            // Toast notification function
            function showToast(message, type = 'info') {
                // Create toast container if it doesn't exist
                let toastContainer = document.getElementById('toast-container');
                if (!toastContainer) {
                    toastContainer = document.createElement('div');
                    toastContainer.id = 'toast-container';
                    toastContainer.className = 'fixed bottom-4 right-4 z-50 flex flex-col gap-2';
                    document.body.appendChild(toastContainer);
                }

                // Create toast
                const toast = document.createElement('div');
                toast.className = `py-2 px-4 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in max-w-xs text-sm font-medium`;

                // Set color based on type
                switch(type) {
                    case 'success':
                        toast.classList.add('bg-green-50', 'text-green-800', 'border-l-4', 'border-green-500');
                        toast.innerHTML = `<i class="bi bi-check-circle-fill text-green-500"></i> ${message}`;
                        break;
                    case 'error':
                        toast.classList.add('bg-red-50', 'text-red-800', 'border-l-4', 'border-red-500');
                        toast.innerHTML = `<i class="bi bi-x-circle-fill text-red-500"></i> ${message}`;
                        break;
                    default:
                        toast.classList.add('bg-blue-50', 'text-blue-800', 'border-l-4', 'border-blue-500');
                        toast.innerHTML = `<i class="bi bi-info-circle-fill text-blue-500"></i> ${message}`;
                }

                // Add to container
                toastContainer.appendChild(toast);

                // Remove after delay
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

            // Favorite button handler
            const favoriteBtn = document.getElementById('favoriteBtn');
            if (favoriteBtn) {
                favoriteBtn.addEventListener('click', function() {
                    @auth
                    const adId = this.dataset.adId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Store button elements and current state
                    const heartIcon = this.querySelector('i');
                    const buttonText = this.querySelector('span');
                    const isCurrentlyFavorite = heartIcon.classList.contains('bi-heart-fill');

                    // Animate heart immediately
                    if (!isCurrentlyFavorite) {
                        heartIcon.classList.replace('bi-heart', 'bi-heart-fill');
                        this.classList.replace('bg-rose-50', 'bg-rose-100');
                        buttonText.textContent = 'Adicionado';
                        showToast('Anúncio adicionado aos favoritos!', 'success');
                    } else {
                        heartIcon.classList.replace('bi-heart-fill', 'bi-heart');
                        this.classList.replace('bg-rose-100', 'bg-rose-50');
                        buttonText.textContent = 'Favoritos';
                        showToast('Anúncio removido dos favoritos', 'info');
                    }

                    // Use FormData instead of JSON
                    const formData = new FormData();
                    formData.append('_token', csrfToken);

                    fetch(`/advertisements/${adId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    })
                        .then(response => {
                            console.log('Response status:', response.status);
                            // Just handle based on status code, don't try to parse JSON
                            if (response.ok) {
                                console.log('Favorite toggled successfully');
                            } else {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Only revert UI changes on error
                            if (isCurrentlyFavorite) {
                                heartIcon.classList.replace('bi-heart', 'bi-heart-fill');
                                this.classList.replace('bg-rose-50', 'bg-rose-100');
                                buttonText.textContent = 'Adicionado';
                            } else {
                                heartIcon.classList.replace('bi-heart-fill', 'bi-heart');
                                this.classList.replace('bg-rose-100', 'bg-rose-50');
                                buttonText.textContent = 'Favoritos';
                            }
                            showToast('Ocorreu um erro. Tente novamente.', 'error');
                        });
                    @else
                        window.location.href = "{{ route('login') }}?redirect={{ url()->current() }}";
                    @endauth
                });
            }

            const gallery = lightGallery(document.getElementById('lightgallery'), {
                selector: 'a',
                plugins: [lgThumbnail],
                thumbnail: true,
                download: false,
                zoom: true,
                fullScreen: true,
                autoplayControls: false,
                share: false,
                loop: true,
                mode: 'lg-fade',
                speed: 500,
            });
            document.getElementById('openGalleryButton').addEventListener('click', function() {
                gallery.openGallery(0);
            });

        });
    </script>
@endpush
