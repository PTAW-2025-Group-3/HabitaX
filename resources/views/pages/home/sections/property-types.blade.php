<section class="py-16 px-4 md:pb-24 md:pt-1 md:px-6 bg-back">
    <div class="max-w-7xl mx-auto text-center">

        {{-- Title --}}
        <h2 class="text-3xl font-bold text-center mb-10">
            Tipos de Imóvel <span class="text-secondary">Mais Procurados</span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($propertyTypes as $type)
                <a href="{{ route('advertisements.index', ['property_type' => $type->id]) }}"
                   class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group border border-gray-100">
                    {{-- Imagem --}}
                    <div class="w-full h-48 overflow-hidden">
                        @if ($type->hasMedia('images'))
                            <img
                                src="{{ $type->getFirstMediaUrl('images', 'thumb') }}"
                                alt="{{ $type->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='{{ asset('images/default-property-type.png') }}';"
                            >
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gray-100 text-gray-500">
                                Sem imagem
                            </div>
                        @endif
                    </div>

                    {{-- Nome --}}
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-secondary transition-colors text-center">
                            {{ $type->name }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
