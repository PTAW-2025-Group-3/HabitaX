<section class="pt-1 md:pt-1 pb-16 md:pb-24 px-4 md:px-6 bg-back">
    <div class="max-w-7xl mx-auto text-center">

        {{-- Title --}}
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-secondary mb-8 md:mb-12">
            Propriedades
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
            @foreach ($propertyTypes as $type)
                <a href="">
                    <div class="home-property-card-style p-4 md:p-6">
                        {{-- Ícone --}}
                        <div class="home-icon-style mb-2 md:mb-3 w-16 h-16 md:w-20 md:h-20 mx-auto rounded-full overflow-hidden">
                            <img src="{{ $type->icon_url }}" alt="{{ $type->name }} Icon" class="w-full h-full object-cover">
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
