@php use App\Enums\AttributeType; @endphp
@extends('layout.app')

@section('title', $ad->title)
@section('before-content')
    @if(isset($showUnpublishedAlert) && $showUnpublishedAlert)
        <div class="max-w-screen-xl mx-auto p-2 md:p-4 mb-4">
            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-lg shadow-sm animate-fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-exclamation-triangle text-amber-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-amber-700">
                            <strong>Atenção:</strong> Este anúncio não está publicado. Apenas você pode vê-lo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('content')
    <div class="max-w-screen-xl mx-auto p-2 md:p-4 space-y-6 animate-fade-in">
        @if(isset($showUnpublishedAlert) && $showUnpublishedAlert)
            <div class="max-w-screen-xl mx-auto p-2 md:p-4 mb-4">
                <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-lg shadow-sm animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-triangle text-amber-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-amber-700">
                                <strong>Atenção:</strong> Este anúncio não está publicado. Apenas você pode vê-lo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            <!-- Header do anúncio redesenhado -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Banner superior com gradiente subtil -->
                <div class="bg-gradient-to-r from-primary/10 to-secondary/10 px-6 py-4">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <!-- Informações principais -->
                        <div class="space-y-2">
                            <div class="inline-flex items-center gap-2 text-sm font-medium px-3 py-1 bg-primary/10 text-primary rounded-full">
                                <i class="bi bi-arrow-left-right"></i>
                                <span>{{ $ad->transaction_type === 'sale' ? 'Compra' : 'Aluguer' }}</span>
                            </div>
                            <div class="inline-flex items-center gap-2 text-sm font-medium px-3 py-1 bg-secondary/10 text-secondary rounded-full">
                                <i class="bi bi-house"></i>
                                <span>{{ $property->property_type->name }}</span>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                                {{ $ad->title }}
                            </h1>

                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="bi bi-geo-alt-fill text-secondary"></i>
                                <span>{{ $property->parish->name }}, {{ $property->parish->municipality->name }}, {{ $property->country }}</span>
                            </div>
                        </div>

                        <!-- Preço destacado -->
                        <div class="flex flex-col items-end">
                            <div class="text-sm text-gray-500 font-medium">Preço</div>
                            <div class="flex items-baseline text-secondary">
                                <span class="text-3xl md:text-4xl font-extrabold">{{ number_format($ad->price, 0, ',', '.') }}€</span>
                                @if($ad->transaction_type === 'rent')
                                    <span class="text-sm md:text-base text-gray-500 font-medium ml-0.5">/mês</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 mt-1">Publicado {{ $ad->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

                <!-- Barra de informações do anunciante e botões de ação juntos -->
                <div class="px-6 py-3 border-b border-gray-200 bg-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                        <!-- Informações do anunciante -->
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
                                <img src="{{ $ad->creator->getProfilePictureUrl() }}" alt="Foto de {{ $ad->creator->name }}" class="w-full h-full object-cover">
                            </div>

                            <div>
                                <div class="font-medium text-gray-800">{{ $ad->creator->name }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    <span>Última atualização: {{ $ad->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de ação -->
                        <div class="flex flex-wrap gap-2">
                            @if($ad->is_published)
                                <button id="shareBtn" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-lg transition-colors">
                                    <i class="bi bi-share-fill"></i>
                                    <span class="text-sm font-medium">Partilhar</span>
                                </button>
                            @endif

                            @if(auth()->check() && auth()->id() == $ad->created_by)
                                <a href="{{ route('advertisements.edit', $ad->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-lg transition-colors">
                                    <i class="bi bi-pencil-square"></i>
                                    <span class="text-sm font-medium">Editar Anúncio</span>
                                </a>
                            @else
                                <button id="favoriteBtn" data-ad-id="{{ $ad->id }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 hover:bg-rose-50 text-rose-600 rounded-lg transition-colors">
                                    <i class="bi {{ auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                    <span class="text-sm font-medium">{{ auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id) ? 'Adicionado' : 'Favoritos' }}</span>
                                </button>

                                <button id="reportBtn" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-lg transition-colors">
                                    <i class="bi bi-flag"></i>
                                    <span class="text-sm font-medium">Reportar</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <!-- Galeria -->
        @php
            $images = $property->getMedia('images');
        @endphp
        <div id="gallery" class="gallery-container grid grid-cols-12 gap-2 md:gap-4 relative">
            <!-- Visible part -->
            <a href="{{ $property->getFirstMediaUrl('images', 'watermark') }}"
               class="col-span-12 md:col-span-6 h-[300px] md:h-[500px]">
                <img src="{{ $property->getFirstMediaUrl('images', 'preview') }}"
                     class="w-full h-full object-cover rounded-lg shadow" alt="Imagem Principal">
            </a>

            <div class="col-span-12 md:col-span-6 grid grid-cols-2 grid-rows-2 gap-2 h-[300px] md:h-[500px]">
                @foreach($images as $image)
                    @if(!$loop->first && $loop->index < 5)
                        @if($loop->index == 4 && count($images) > 5)
                            <!-- Última imagem visível com overlay e "+X" -->
                            <div class="relative">
                                <a href="{{ $image->getUrl('watermark') }}" class="block w-full h-full">
                                    <img src="{{ $image->getUrl('preview') }}"
                                         class="w-full h-full object-cover rounded-lg shadow" loading="lazy" alt="Miniatura">
                                    <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center rounded-lg hover:bg-opacity-70 transition-all">
                                        <span class="text-3xl md:text-4xl font-bold text-white">+{{ count($images) - 5 }}</span>
                                        <span class="text-xs md:text-sm text-white mt-1">Ver todas as fotos</span>
                                    </div>
                                </a>
                            </div>
                        @else
                            <a href="{{ $image->getUrl('watermark') }}">
                                <img src="{{ $image->getUrl('preview') }}"
                                     class="w-full h-full object-cover rounded-lg shadow" loading="lazy" alt="Miniatura">
                            </a>
                        @endif
                    @endif
                @endforeach

                @for($i = count($images); $i < 5; $i++)
                    <div class="bg-gray-100 rounded-lg shadow"></div>
                @endfor
            </div>

            <!-- Hidden links for LightGallery -->
            <div class="hidden">
                @foreach($images as $image)
                    @if($loop->index >= 5)
                        <a href="{{ $image->getUrl('watermark') }}">
                            <img src="{{ $image->getUrl('thumb') }}" loading="lazy" alt="Miniatura oculta" class="hidden">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <div class="col-span-1 md:col-span-2 space-y-4">
                <section class="space-y-2">
                    <h2 class="text-lg md:text-xl font-semibold">Comentário do Anunciante</h2>
                    <p class="text-gray-700 text-sm md:text-base">{{ $ad->description }}</p>
                </section>

                <section class="space-y-2 mb-4">
                    <h2 class="text-lg md:text-xl font-semibold">Características do Imóvel</h2>

                    <!-- Características em formato de lista vertical -->
                    <div class="space-y-2 mb-4">
                        @php
                            $displayedCount = 0;
                            $maxDisplayed = 4;
                            $path = 'advertisements.individual.parameters.';
                            $attributeIncludes = [
                                AttributeType::TEXT->value => $path. 'text',
                                AttributeType::LONG_TEXT->value => $path . 'long-text',
                                AttributeType::INT->value => $path . 'int',
                                AttributeType::FLOAT->value => $path . 'float',
                                AttributeType::BOOLEAN->value => $path . 'boolean',
                                AttributeType::DATE->value => $path . 'date',
                                AttributeType::SELECT_SINGLE->value => $path . 'select-single',
                                AttributeType::SELECT_MULTIPLE->value => $path . 'select-multiple',
                            ];

                            // Obter todos os parâmetros disponíveis
                            $allParameters = collect([]);
                            $groupedParameters = $groupedParameters ?? collect([]);
                            foreach($groupedParameters as $groupId => $parameters) {
                                $allParameters = $allParameters->merge($parameters);
                            }

                            $priorityParameters = $allParameters->take($maxDisplayed);
                        @endphp

                        @foreach($priorityParameters as $parameter)
                            @if(isset($attributeIncludes[$parameter->attribute->type->value]) && $displayedCount < $maxDisplayed)
                                <div class="flex items-center px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-100">
                                    <i class="bi bi-info-circle text-blue-500 mr-3"></i>
                                    <div class="text-sm">
                                        <span class="font-medium">{{ $parameter->attribute->name }}:</span>
                                        <span class="font-semibold text-gray-800 ml-1">
                        @php
                            // Obter o valor correto com base no tipo de atributo
                            $value = match($parameter->attribute->type->value) {
                                AttributeType::TEXT->value, AttributeType::LONG_TEXT->value => $parameter->text_value,
                                AttributeType::INT->value => number_format($parameter->int_value, 0, ',', '.'),
                                AttributeType::FLOAT->value => number_format($parameter->float_value, 2, ',', '.'),
                                AttributeType::BOOLEAN->value => $parameter->boolean_value ? 'Sim' : 'Não',
                                AttributeType::DATE->value => $parameter->date_value->format('d/m/Y'),
                                AttributeType::SELECT_SINGLE->value => \App\Models\PropertyAttributeOption::find($parameter->select_value)->name,
                                AttributeType::SELECT_MULTIPLE->value => implode(', ', $parameter->options->pluck('option.name')->toArray()),
                                default => 'N/A'
                            };
                        @endphp
                                            {{ $value }}
                                        </span>
                                    </div>
                                </div>
                                @php $displayedCount++; @endphp
                            @endif
                        @endforeach
                    </div>

                    <!-- Botão "Ver mais características" -->
                    <div class="my-4 flex justify-start">
                        <button id="showAllFeaturesBtn"
                                class="btn-secondary gap-2 px-4 py-2.5">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <span class="text-sm font-medium">Mostrar todas as {{ $allParameters->count() }} características</span>
                        </button>
                    </div>
                </section>
                @include('advertisements.individual.price-history', ['ad' => $ad])
                @include('advertisements.individual.market-stats', ['ad' => $ad])
                @if($ad->transaction_type === 'rent')
                    @include('advertisements.individual.rent-simulator', ['ad' => $ad])
                @else
                    @include('advertisements.individual.loan-simulator', ['ad' => $ad])
                @endif
                @include('advertisements.individual.ad-stats', ['ad' => $ad])
                @include('advertisements.individual.about-advertiser', ['ad' => $ad])
            </div>

            <div class="space-y-6 animate-fade-in">
                <!-- Mapa da freguesia com tooltip no ícone de informação -->
                <div class="bg-gradient-to-tr from-indigo-50 to-white rounded-2xl shadow-md overflow-hidden">
                    <div class="h-48 md:h-56 relative">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($property->parish->name . ', ' . $property->parish->municipality->name . ', ' . $property->country) }}&output=embed"
                            class="w-full h-full border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                        <div class="absolute top-2 right-2 group">
                            <div
                                class="bg-white bg-opacity-80 rounded-full w-8 h-8 flex items-center justify-center shadow cursor-help">
                                <i class="bi bi-info-circle text-gray-700"></i>
                            </div>
                            <div
                                class="absolute right-0 top-full mt-2 hidden group-hover:block bg-white text-gray-700 text-xs md:text-sm px-3 py-2 rounded shadow-lg w-52 z-10">
                                Apenas a freguesia é exibida por questões de segurança.
                            </div>
                        </div>
                    </div>
                    <a
                        href="https://www.google.com/maps?q={{ urlencode($property->parish->name . ', ' . $property->parish->municipality->name . ', ' . $property->country) }}"
                        target="_blank"
                        class="w-full text-blue-600 hover:text-blue-700 bg-white text-sm md:text-base font-semibold py-3 border-t border-indigo-100 transition block text-center">
                        <i class="bi bi-geo-alt-fill mr-1"></i> Ver no mapa
                    </a>
                </div>

                @include('advertisements.individual.contact-form', ['ad' => $ad])
            </div>

        </div>
    </div>
@endsection
@include('advertisements.individual.modals.all_photos', ['images' => $images])
@include('advertisements.individual.modals.denunciation', ['adId' => $ad->id])
@include('advertisements.individual.modals.share', ['ad' => $ad])
@include('advertisements.individual.modals.favorites-viewer', ['ad' => $ad])
@include('advertisements.individual.modals.features', ['groupedParameters' => $groupedParameters, 'groups' => $groups])
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal de fotos - elementos
            const photosModal = document.getElementById('photos-modal');
            const closePhotosModal = document.getElementById('closePhotosModal');
            const photoItems = document.querySelectorAll('.photo-item');

            // Função para abrir o modal de fotos
            function openPhotosModal() {
                photosModal.classList.remove('hidden');
                photosModal.classList.add('modal-visible');
                document.body.classList.add('modal-open');
            }

            // Função para fechar o modal de fotos
            function closePhotosModalFunction() {
                photosModal.classList.add('hidden');
                photosModal.classList.remove('modal-visible');
                document.body.classList.remove('modal-open');
            }

            // Modificar os eventos de clique nas imagens da galeria
            const galleryTriggers = document.querySelectorAll('#gallery a');
            galleryTriggers.forEach((trigger, index) => {
                // Verificar se esta é a imagem com o overlay "+X"
                const hasOverlay = trigger.querySelector('.absolute.inset-0') !== null;

                trigger.addEventListener('click', function (e) {
                    e.preventDefault();

                    if (hasOverlay) {
                        // Se for a imagem com "+X", abre o modal com todas as fotos
                        openPhotosModal();
                    } else {
                        // Para as outras imagens, abre diretamente o lightGallery no slide correspondente
                        gallery.openGallery(index);
                    }
                });
            });

            // Eventos para fechar o modal
            if (closePhotosModal) {
                closePhotosModal.addEventListener('click', function () {
                    closePhotosModalFunction();
                });
            }

            // Fechar modal ao clicar fora
            if (photosModal) {
                photosModal.addEventListener('click', function (e) {
                    if (e.target === photosModal) {
                        closePhotosModalFunction();
                    }
                });
            }

            // Fechar modal com tecla ESC
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && photosModal && !photosModal.classList.contains('hidden')) {
                    closePhotosModalFunction();
                }
            });

            // Abrir galeria somente quando uma foto for clicada no modal
            photoItems.forEach(item => {
                item.addEventListener('click', function () {
                    const index = parseInt(this.dataset.index);
                    setTimeout(() => {
                        gallery.openGallery(index);
                    }, 100);
                });
            });

            // Report button handler
            const reportBtn = document.getElementById('reportBtn');
            if (reportBtn) {
                reportBtn.addEventListener('click', function () {
                    if (typeof openReportModal === 'function') {
                        openReportModal();
                    } else {
                        console.error('openReportModal function not found');
                    }
                });
            }

            const shareBtn = document.getElementById('shareBtn');
            if (shareBtn) {
                shareBtn.addEventListener('click', function () {
                    if (typeof openShareModal === 'function') {
                        openShareModal();
                    } else {
                        console.error('openShareModal function not found');
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
                switch (type) {
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
                favoriteBtn.addEventListener('click', function () {
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
                        this.classList.add('bg-rose-50');
                        buttonText.textContent = 'Adicionado';
                        showToast('Anúncio adicionado aos favoritos!', 'success');
                    } else {
                        heartIcon.classList.replace('bi-heart-fill', 'bi-heart');
                        this.classList.remove('bg-rose-50');
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

            const gallery = lightGallery(document.getElementById('gallery'), {
                selector: 'a',
                plugins: [lgThumbnail, lgZoom],
                loop: true,
                hideScrollbar: true,
                mode: 'lg-fade',
                speed: 500,
                dynamic: true,
                dynamicEl: Array.from(document.querySelectorAll('#gallery a')).map(a => {
                    return {
                        src: a.getAttribute('href'),
                        thumb: a.querySelector('img').getAttribute('src')
                    };
                })
            });

            // "Mais X imagens" button now opens the modal instead
            const openGalleryButton = document.getElementById('openGalleryButton');
            if (openGalleryButton) {
                openGalleryButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    openPhotosModal();
                });
            }
        });
    </script>
@endpush
