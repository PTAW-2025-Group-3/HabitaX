<section class="py-16 px-4 md:pb-24 md:pt-1 md:px-6 bg-back">
    <div class="max-w-7xl mx-auto text-center">

        {{-- Title --}}
        <h2 class="text-3xl font-bold text-center mb-10">
            Propriedades <span class="text-secondary">Mais Procuradas</span>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
            @foreach ($propertyTypes as $type)
                <a href="{{ route('advertisements.index', ['property_type' => $type->id]) }}">
                    <div class="home-property-card-style p-4 md:p-6">
                        {{-- Icon --}}
                        <div class="home-icon-style mb-2 md:mb-3">
                            @if ($type->hasMedia('icon'))
                                <img src="{{ $type->getFirstMediaUrl('icon', 'thumb') }}" alt="{{ $type->name }} Icon"
                                     class="object-cover rounded-full w-full h-full">
                            @else
                                <span class="text-gray-500">Sem ícone</span>
                            @endif
                        </div>

                        {{-- Nome --}}
                        <h3 class="text-base md:text-lg font-semibold text-gray-secondary mb-1">
                            {{ $type->name }}
                        </h3>

                        {{-- Número de propriedades --}}
                        <p class="text-xs md:text-sm text-gray-500">
                            {{ $type->active_ads_count }} anúncios
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
