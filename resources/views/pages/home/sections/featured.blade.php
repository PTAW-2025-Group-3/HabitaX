<section class="py-16 px-4 mb-16 bg-back">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-10">
            As Nossas <span class="text-secondary">Melhores Ofertas</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($featuredAds as $ad)
                <a href="{{ route('advertisements.show', ['id' => $ad['id']]) }}" class="block">
                    <div class="group home-ads-style">
                        <!-- Imagem -->
                        <img
                            src="{{ asset($ad->property->getFirstMediaUrl('images', 'thumb')) ?? asset('images/property-placeholder.png') }}"
                            alt="Imagem do imóvel"
                            class="w-full h-48 object-cover"/>

                        <!-- Informações -->
                        <div class="p-4">
                            <p class="text-gray-700 font-medium mb-1">
                                {{ $ad->property->location->city ?? 'Portugal' }},
                                {{ $ad->property->location->district ?? '' }}
                            </p>

                            <p class="text-xl font-extrabold text-black mt-2">
                                {{ number_format($ad['price'], 0, ',', '.') }}€
                                @if($ad->type === 'rental')
                                    <span
                                        class="text-sm font-normal text-gray-600">/ {{ $ad->rental_type ?? 'A Discutir ' }}</span>
                                @endif
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $ad->type === 'sale' ? 'For Sale' : 'Rental' }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
