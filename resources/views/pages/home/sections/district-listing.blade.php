{{-- Section: District Listing --}}
<section class="py-16 px-4 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-4">
            Encontre por <span class="text-secondary">Distrito</span>
        </h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
            Descubra imóveis nos principais distritos de Portugal, com ofertas exclusivas para cada região
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($districts as $district)
                <a href="{{ route('advertisements.index', ['district' => $district->id]) }}"
                   class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group border border-gray-100">
                    <div class="w-full h-48 overflow-hidden">
                        <img
                            src="{{ $district->getFirstMediaUrl('images', 'thumb') }}"
                            alt="Distrito {{ $district->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-district.png') }}';"
                        >
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-secondary transition-colors text-center">
                            {{ $district->name }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
