<div class="space-y-4">
    @if($advertisements->isEmpty())
        <div class="flex items-center justify-center p-8 bg-gray-50 rounded-xl">
            <p class="text-gray-500 font-medium">Nenhum anúncio encontrado.</p>
        </div>
    @else
        @foreach($advertisements as $ad)
            <div class="bg-white rounded-2xl border border-gray-200 shadow hover:shadow-md transition-all duration-300">
                <div class="flex flex-col md:flex-row gap-3 items-stretch">
                    <!-- Seção da imagem -->
                    <div class="md:w-2/5 w-full flex-shrink-0 relative group overflow-hidden rounded-tl-2xl rounded-bl-2xl">
                        <div class="swiper swiper-ad-list-{{ $ad->id }} aspect-[4/3] md:aspect-[16/10] w-full">
                            <div class="swiper-wrapper">
                                @php
                                    $totalImages = $ad->property->getMedia('images')->count();
                                @endphp
                                @if($totalImages > 0)
                                    @foreach($ad->property->getMedia('images') as $index => $image)
                                        <div class="swiper-slide">
                                            <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block h-full">
                                                <div class="aspect-[4/3] md:aspect-[16/10] w-full relative">
                                                    <img src="{{ $image->getUrl('preview') }}"
                                                         alt="{{ $ad['title'] }}" loading="lazy"
                                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                    @if($totalImages > 1)
                                                        <div class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-md backdrop-blur-sm">
                                                            <span>{{ $index + 1 }}</span>/<span>{{ $totalImages }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block h-full">
                                            <div class="aspect-[4/3] md:aspect-[16/10] w-full relative">
                                                <img src="{{ asset('images/property-placeholder.png') }}"
                                                     alt="{{ $ad['title'] }}" loading="lazy"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-pagination !bottom-3"></div>
                            <div class="swiper-button-next !w-8 !h-8 !bg-white/80 !rounded-full !text-blue-900 !right-3"></div>
                            <div class="swiper-button-prev !w-8 !h-8 !bg-white/80 !rounded-full !text-blue-900 !left-3"></div>
                        </div>

                        @if(isset($ad['featured']) && $ad['featured'])
                            <div class="absolute top-3 left-3 bg-gradient-to-r from-amber-500 to-yellow-400 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-md flex items-center space-x-1 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                     fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <span>Destaque</span>
                            </div>
                        @endif
                    </div>

                    <!-- Conteúdo do anúncio -->
                    <div class="flex-grow flex flex-col p-3">
                        <div class="space-y-2.5 flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
                                        <h3 class="text-xl font-bold text-gray-900 leading-tight hover:text-blue-700 transition-colors">{{ $ad['title'] }}</h3>
                                    </a>
                                    <p class="flex items-center text-sm text-gray-500 mt-0.5">
                                        <i class="bi bi-geo-alt-fill text-blue-700 mr-1"></i>
                                        @if($ad->property && $ad->property->parish)
                                            {{ $ad->property->parish->name }},
                                            {{ $ad->property->parish->municipality->name }}
                                        @else
                                            —
                                        @endif
                                    </p>
                                </div>
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

                            <p class="text-2xl font-extrabold text-blue-800">{{ number_format($ad['price'], 0, ',', '.') }} €</p>

                            <!-- Badges tipo de imóvel e tipo de transação (texto com ícones Bootstrap) -->
                            <div class="flex flex-wrap gap-3 text-sm">
                                <div class="text-indigo-700 font-medium">
                                    <i class="bi bi-arrow-left-right mr-1"></i>
                                    {{ $ad->transaction_type === 'sale' ? 'Compra' : 'Aluguer' }}
                                </div>
                                <div class="text-gray-700 font-medium">
                                    <i class="bi bi-house mr-1"></i>
                                    {{ $ad->property->property_type->name }}
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mt-1">
                                @php
                                    $attributeIdsToShow = $ad->property->type
                                        ->attributes()
                                        ->wherePivot('show_in_list', true)
                                        ->pluck('property_attributes.id')
                                        ->toArray();
                                    $parameters = $ad->property->parameters()
                                        ->whereIn('attribute_id', $attributeIdsToShow)
                                        ->with('attribute')
                                        ->get();
                                @endphp
                                <div class="flex flex-wrap items-center gap-2">
                                    <i class="bi bi-house-door-fill text-blue-700"></i>
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

                        <!-- Info anunciante + botões -->
                        <div class="flex items-center flex-wrap gap-2 mt-3 pt-3 border-t border-gray-100">
                            @php
                                $isOwner = auth()->check() && auth()->id() == $ad->created_by;
                            @endphp

                            <img src="{{ $ad->creator->getProfilePictureUrl() }}"
                                 alt="Foto de {{ $ad->creator->name }}"
                                 loading="lazy"
                                 class="h-9 w-9 rounded-full object-cover shadow-sm">

                            <span class="text-sm font-semibold text-gray-700">
                                {{ $ad->creator->name ?? 'Anunciante' }}
                            </span>

                            <div class="flex-grow"></div>

                            @if(!$isOwner)
                                @if($ad->creator->show_telephone)
                                    <button
                                        data-advertiser-id="{{ $ad->creator->id ?? 0 }}"
                                        class="phone-button px-3 py-1.5 bg-white text-blue-700 border border-blue-200 rounded-lg text-sm font-semibold hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 whitespace-nowrap">
                                        <i class="bi bi-telephone-fill mr-1"></i>
                                        Ver Telefone
                                    </button>
                                @endif

                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                   class="px-3 py-1.5 bg-blue-900 text-white rounded-lg text-sm font-semibold hover:bg-blue-800 transition-all duration-200 whitespace-nowrap">
                                    <i class="bi bi-chat-dots-fill mr-1"></i>
                                    Contactar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
