<div>
    @if($advertisements->isEmpty())
        <p>Nenhum anúncio encontrado.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($advertisements as $ad)
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow hover:shadow-md transition-all duration-300 h-full flex flex-col overflow-hidden">
                    <div class="relative group overflow-hidden">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <div class="swiper swiper-ad-{{ $ad->id }} h-[220px]">
                                <div class="swiper-wrapper">
                                    @php
                                        $totalImages = $ad->property->getMedia('images')->count();
                                    @endphp
                                    @if($totalImages > 0)
                                        @foreach($ad->property->getMedia('images') as $index => $image)
                                            <div class="swiper-slide">
                                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block h-full">
                                                    <div class="image-overlay"></div>
                                                    <img src="{{ $image->getUrl('thumb') }}"
                                                         alt="{{ $ad['title'] }}" loading="lazy"
                                                         class="h-full w-full object-cover">
                                                    @if($totalImages > 1)
                                                        <div class="image-counter">
                                                            <span>{{ $index + 1 }}</span>/<span>{{ $totalImages }}</span>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block h-full">
                                                <div class="image-overlay"></div>
                                                <img src="{{ asset('images/property-placeholder.png') }}"
                                                     alt="{{ $ad['title'] }}" loading="lazy"
                                                     class="h-full w-full object-cover">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                                         class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327
                                                     4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <span>Destaque</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex justify-between items-start">
                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
                                    <h3 class="text-lg font-bold text-gray-900 leading-tight line-clamp-2 hover:text-blue-700 transition-colors">
                                        {{ $ad['title'] }}
                                    </h3>
                                </a>
                                <div class="flex">
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

                            <p class="flex items-center text-sm text-gray-500 mt-1">
                                <i class="bi bi-geo-alt-fill text-secondary mr-1"></i>
                                {{ $ad->property && $ad->property->parish ? $ad->property->parish->name : '—' }}
                            </p>

                            <p class="text-xl font-extrabold text-blue-800 mt-2">
                                {{ number_format($ad['price'], 0, ',', '.') }} €
                            </p>

                            {{--                                        <div class="flex items-center mt-1 flex-wrap">--}}
                            {{--                                            <i class="bi bi-house-door-fill text-secondary mr-1"></i>--}}
                            {{--                                            @php--}}
                            {{--                                                $attributeIdsToShow = $ad->property->type--}}
                            {{--                                                    ->attributes()--}}
                            {{--                                                    ->wherePivot('show_in_list', true)--}}
                            {{--                                                    ->pluck('property_attributes.id')--}}
                            {{--                                                    ->toArray();--}}
                            {{--                                                $parameters = $ad->property->parameters()--}}
                            {{--                                                    ->whereIn('attribute_id', $attributeIdsToShow)--}}
                            {{--                                                    ->with('attribute') // eager-load the attribute--}}
                            {{--                                                    ->get();--}}
                            {{--                                            @endphp--}}
                            {{--                                            @foreach($parameters as $parameter)--}}
                            {{--                                                @if($parameter->attribute->type->value != 'select_multiple')--}}
                            {{--                                                    <span class="text-sm font-medium">--}}
                            {{--                                                        {{ $parameter->attribute->name }}: {{ $parameter->getValue($parameter->attribute->type) }}--}}
                            {{--                                                        {{ $parameter->attribute->unit }}--}}
                            {{--                                                    </span>--}}
                            {{--                                                    @if(!$loop->last)--}}
                            {{--                                                        <span class="mx-1">|</span>--}}
                            {{--                                                    @endif--}}
                            {{--                                                @endif--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </div>--}}

                            <p class="text-gray-700 mt-2 leading-relaxed line-clamp-3 text-sm flex-grow">
                                {{ $ad['description'] }}
                            </p>

                            {{--                                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">--}}
                            {{--                                            <div>--}}
                            {{--                                                @if($ad->creator && $ad->creator->profile_picture_path)--}}
                            {{--                                                    <img src="{{ Storage::url($ad->creator->profile_picture_path) }}"--}}
                            {{--                                                         alt="{{ $ad->creator->name }}" loading="lazy"--}}
                            {{--                                                         class="h-8 w-8 rounded-full object-cover shadow-sm">--}}
                            {{--                                                @else--}}
                            {{--                                                    <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 shadow-sm">--}}
                            {{--                                                        <i class="bi bi-person text-sm"></i>--}}
                            {{--                                                    </div>--}}
                            {{--                                                @endif--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="flex space-x-2">--}}
                            {{--                                                <button--}}
                            {{--                                                    data-advertiser-id="{{ $ad->creator->id ?? 0 }}"--}}
                            {{--                                                    class="phone-button px-3 py-1 bg-white text-blue-900 border border-blue-900 rounded-md text-xs font-semibold hover:bg-blue-50 hover:text-blue-700 transition-all duration-300">--}}
                            {{--                                                    Ver Telefone--}}
                            {{--                                                </button>--}}
                            {{--                                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"--}}
                            {{--                                                   class="px-3 py-1 bg-blue-900 text-white rounded-md text-xs font-semibold hover:bg-blue-800 transition-all duration-300 text-center">--}}
                            {{--                                                    Contactar--}}
                            {{--                                                </a>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
