<div class="space-y-4">
    @if($advertisements->isEmpty())
        <p>Nenhum anúncio encontrado.</p>
    @else
        @foreach($advertisements as $ad)
            <div
                class="bg-white rounded-2xl border border-gray-200 p-4 shadow hover:shadow-md transition-all duration-300">
                <div class="flex flex-col md:flex-row gap-4 items-stretch">
                    <div
                        class="md:w-2/5 w-full flex-shrink-0 relative group overflow-hidden rounded-xl swiper-ad-list-container">
                        <div class="swiper swiper-ad-list-{{ $ad->id }} aspect-[4/3] w-full">
                            <div class="swiper-wrapper">
                                @php
                                    $totalImages = $ad->property->getMedia('images')->count();
                                @endphp
                                @if($totalImages > 0)
                                    @foreach($ad->property->getMedia('images') as $index => $image)
                                        <div class="swiper-slide">
                                            <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                               class="block h-full">
                                                <div class="image-overlay"></div>
                                                <div class="aspect-[4/3] w-full relative">
                                                    <img src="{{ $image->getUrl('preview') }}"
                                                         alt="{{ $ad['title'] }}" loading="lazy"
                                                         class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                                    @if($totalImages > 1)
                                                        <div class="image-counter">
                                                            <span>{{ $index + 1 }}</span>/<span>{{ $totalImages }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                           class="block h-full">
                                            <div class="image-overlay"></div>
                                            <div class="aspect-[4/3] w-full relative">
                                                <img src="{{ asset('images/property-placeholder.png') }}"
                                                     alt="{{ $ad['title'] }}" loading="lazy"
                                                     class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        @if(isset($ad['featured']) && $ad['featured'])
                            <div class="feature-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                     fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <span>Destaque</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow flex flex-col">
                        <div class="space-y-2 flex-grow">
                            <div class="flex justify-between items-start">
                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                   class="block">
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight hover:text-blue-700 transition-colors">{{ $ad['title'] }}</h3>
                                </a>
                                <div class="flex space-x-1">
                                    @php
                                        $isOwner = auth()->check() && auth()->id() == $ad->created_by;
                                        $isFavorite = auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id);
                                    @endphp
                                    @if(!$isOwner)
                                        <button
                                            data-ad-id="{{ $ad->id }}"
                                            class="favorite-btn transition-colors h-8 w-8 rounded-full hover:bg-gray-100 {{ $isFavorite ? 'text-red-500' : 'text-gray-500' }}">
                                            <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <p class="flex items-center text-sm text-gray-500 mt-0.5">
                                <i class="bi bi-geo-alt-fill text-secondary mr-1"></i>
                                {{ $ad->property && $ad->property->parish ? $ad->property->parish->name : '—' }}
                            </p>
                            <p class="text-2xl font-extrabold text-blue-800 mt-2">{{ number_format($ad['price'], 0, ',', '.') }}
                                €</p>
                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">
                                @php
                                    $attributeIdsToShow = $ad->property->type
                                        ->attributes()
                                        ->wherePivot('show_in_list', true)
                                        ->pluck('property_attributes.id')
                                        ->toArray();
                                    $parameters = $ad->property->parameters()
                                        ->whereIn('attribute_id', $attributeIdsToShow)
                                        ->with('attribute') // eager-load the attribute
                                        ->get();
                                @endphp
                                <div class="flex flex-wrap items-center gap-2 mt-1">
                                    <i class="bi bi-house-door-fill text-secondary mr-1"></i>
                                    @foreach($parameters as $parameter)
                                        @if($parameter->attribute)
                                            <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-lg">
                                                {{ $parameter->attribute->name }}:
                                                {{ $parameter->attribute->type->value === 'boolean'
                                                    ? ($parameter->getValue($parameter->attribute->type) ? 'Sim' : 'Não')
                                                    : $parameter->getValue($parameter->attribute->type) }}
                                                {{ $parameter->attribute->unit }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-gray-700 line-clamp-2 leading-relaxed">{{ $ad['description'] }}</p>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-4 border-t border-gray-100 mt-4 gap-2">
                            <div class="flex items-center gap-2">
                                    <img src="{{ $ad->creator->getProfilePictureUrl() }}"
                                         alt="Foto de {{ $ad->creator->name }}"
                                         loading="lazy"
                                         class="h-9 w-9 rounded-full object-cover shadow-sm">
                                <span class="text-sm font-semibold text-gray-700">
                                                {{ $ad->creator->name ?? 'Anunciante' }}
                                            </span>
                            </div>
                            @php
                                $isOwner = auth()->check() && auth()->id() == $ad->created_by;
                            @endphp
                            @if(!$isOwner)
                            <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                                <button
                                    data-advertiser-id="{{ $ad->creator->id ?? 0 }}"
                                    class="phone-button px-4 py-2 bg-white text-blue-900 border border-blue-900 rounded-lg text-sm font-semibold hover:bg-blue-50 hover:text-blue-700 transition-all duration-300">
                                    Ver Telefone
                                </button>
                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                   class="px-4 py-2 bg-blue-900 text-white rounded-lg text-sm font-semibold hover:bg-blue-800 transition-all duration-300 text-center">
                                    Contactar
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
