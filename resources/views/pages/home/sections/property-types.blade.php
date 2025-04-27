<section class="pt-1 md:pt-1 pb-16 md:pb-24 px-4 md:px-6 bg-back">
    <div class="max-w-7xl mx-auto text-center">

        {{-- Title --}}
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-secondary mb-8 md:mb-12">
            Propriedades
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
            @foreach ($propertyTypes as $type)
                <a href="{{ route('advertisements.index', ['type' => $type->id]) }}">
                    <div class="home-property-card-style p-4 md:p-6">
                        {{-- Icon --}}
                        <div class="home-icon-style mb-2 md:mb-3">
                            @if ($type->icon_path)
                                <img src="{{ Storage::url($type->icon_path) }}" alt="{{ $type->name }} Icon"
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
                            {{ $type->properties_count }} propriedades
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
