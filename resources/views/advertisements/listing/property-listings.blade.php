<div x-data="page" class="w-full md:w-3/4">
    <div class="property-listings-container">
        <!-- Header Section -->
        <h1 class="text-xl font-semibold mb-4">
            {{ $advertisements->total() }} anúncios encontrados, Moradias em Aveiro
        </h1>

        @include('advertisements.listing.view-toggle-and-sort')

        <template x-if="view === 'grid'">
            <div>
                @if($advertisements->isEmpty())
                    <p>Nenhum anúncio encontrado.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($advertisements as $ad)
                            <div class="bg-white rounded-2xl border border-gray-200 shadow hover:shadow-md transition-all duration-300 h-full flex flex-col overflow-hidden">
                                <div class="relative group overflow-hidden">
                                    <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}">
                                        <img src="{{ $ad->property->images[0] }}" alt="{{ $ad['title'] }}" class="h-52 w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </a>
                                    @if(isset($ad['featured']) && $ad['featured'])
                                        <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow-md">
                                            Destaque
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
                                            <h3 class="text-lg font-bold text-gray-900 leading-tight line-clamp-2 hover:text-blue-700 transition-colors">{{ $ad['title'] }}</h3>
                                        </a>
                                        <div class="flex">
                                            @php
                                                $isFavorite = auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id);
                                            @endphp
                                            <button
                                                data-ad-id="{{ $ad->id }}"
                                                class="favorite-btn transition-colors h-8 w-8 rounded-full hover:bg-gray-100 {{ $isFavorite ? 'text-red-500' : 'text-gray-500' }}">
                                                <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class="bi bi-geo-alt-fill text-secondary mr-1"></i>
                                        {{ \App\Models\Parish::find($ad->property->parish_id)->name }}
                                    </p>
                                    <p class="text-xl font-extrabold text-blue-800 mt-2">{{ number_format($ad['price'], 0, ',', '.') }} €</p>
                                    <div class="flex items-center mt-1">
                                        <i class="bi bi-house-door-fill text-secondary mr-1"></i>
                                        <span class="text-sm font-medium">{{ $ad['details'] }}</span>
                                    </div>
                                    <p class="text-gray-700 mt-2 leading-relaxed line-clamp-3 text-sm flex-grow">{{ $ad['description'] }}</p>

                                    <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            @if($ad->creator && $ad->creator->profile_picture_path)
                                                <img src="{{ Storage::url($ad->creator->profile_picture_path) }}" alt="{{ $ad->creator->name }}" class="h-7 w-7 rounded-full object-cover shadow-sm">
                                            @else
                                                <div class="h-7 w-7 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 shadow-sm">
                                                    <i class="bi bi-person text-sm"></i>
                                                </div>
                                            @endif
                                            <span class="text-xs font-semibold text-gray-700 truncate max-w-[80px]">
                                                {{ $ad->creator->name ?? 'Anunciante' }}
                                            </span>
                                        </div>
                                        <div class="flex space-x-1">
                                            <button
                                                data-advertiser-id="{{ $ad->creator->id ?? 0 }}"
                                                class="phone-button px-2 py-1 bg-white text-blue-900 border border-blue-900 rounded-lg text-xs font-semibold hover:bg-blue-50 hover:text-blue-700 transition-all duration-300">
                                                Ver Telefone
                                            </button>
                                            <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}"
                                               class="px-2 py-1 bg-blue-900 text-white rounded-lg text-xs font-semibold hover:bg-blue-800 transition-all duration-300 text-center">
                                                Contactar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </template>

        <template x-if="view === 'list'">
            <div class="space-y-4">
                @if($advertisements->isEmpty())
                    <p>Nenhum anúncio encontrado.</p>
                @else
                    @foreach($advertisements as $ad)
                        <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow hover:shadow-md transition-all duration-300">
                            <div class="flex flex-col md:flex-row gap-4 items-stretch">
                                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block md:w-2/5 w-full flex-shrink-0 relative group overflow-hidden rounded-xl">
                                    <div class="aspect-[4/3] w-full relative">
                                        <img src="{{ $ad->property->images[0] }}" alt="{{ $ad['title'] }}" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                        @if(isset($ad['featured']) && $ad['featured'])
                                            <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow-md">
                                                Destaque
                                            </div>
                                        @endif
                                    </div>
                                </a>

                                <div class="flex-grow flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-start">
                                            <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
                                                <h3 class="text-xl font-bold text-gray-900 leading-tight hover:text-blue-700 transition-colors">{{ $ad['title'] }}</h3>
                                            </a>
                                            <div class="flex space-x-1">
                                                @php
                                                    $isFavorite = auth()->check() && auth()->user()->favoriteAdvertisements->contains('advertisement_id', $ad->id);
                                                @endphp

                                                <button
                                                    data-ad-id="{{ $ad->id }}"
                                                    class="favorite-btn transition-colors h-8 w-8 rounded-full hover:bg-gray-100 {{ $isFavorite ? 'text-red-500' : 'text-gray-500' }}">
                                                    <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-900 transition-colors h-8 w-8 rounded-full hover:bg-gray-100">
                                                    <i class="bi bi-share"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="flex items-center text-sm text-gray-500 mt-0.5">
                                            <i class="bi bi-geo-alt-fill text-secondary mr-1"></i>
                                            {{ \App\Models\Parish::find($ad->property->parish_id)->name }}
                                        </p>
                                        <p class="text-2xl font-extrabold text-blue-800 mt-2">{{ number_format($ad['price'], 0, ',', '.') }} €</p>
                                        <div class="flex items-center mt-1">
                                            <i class="bi bi-house-door-fill text-secondary mr-1"></i>
                                            <span class="text-sm font-medium">{{ $ad['details'] }}</span>
                                        </div>
                                        <p class="text-gray-700 line-clamp-2 leading-relaxed">{{ $ad['description'] }}</p>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-4">
                                        <div class="flex items-center gap-2">
                                            @if($ad->creator && $ad->creator->profile_picture_path)
                                                <img src="{{ Storage::url($ad->creator->profile_picture_path) }}" alt="{{ $ad->creator->name }}" class="h-9 w-9 rounded-full object-cover shadow-sm">
                                            @else
                                                <div class="h-9 w-9 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 shadow-sm">
                                                    <i class="bi bi-person text-lg"></i>
                                                </div>
                                            @endif
                                            <span class="text-sm font-semibold text-gray-700">
                                                {{ $ad->creator->name ?? 'Anunciante' }}
                                            </span>
                                        </div>

                                        <div class="flex gap-2">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </template>

        <div class="mt-6">
            {{ $advertisements->appends(request()->query())->links() }}
        </div>
    </div>
</div>
