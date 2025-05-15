{{-- Section: District Listing --}}
<section class="py-16 px-4 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-4">
            Encontre por <span class="text-secondary">Distrito</span>
        </h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
            Descubra imóveis nos principais distritos de Portugal, com ofertas exclusivas para cada região
        </p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @foreach ($adsPerDistrict as $district)
                <a href="{{ route('advertisements.index', ['district' => $district->district_id]) }}"
                   class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group border border-gray-100">
                    <div class="p-5 flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full mb-3 overflow-hidden group-hover:scale-110 transition-all duration-300 shadow-md">
                            <img
                                src="https://picsum.photos/seed/{{ str_replace(' ', '', $district->district_name) }}/100/100"
                                alt="Distrito {{ $district->district_name }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/100x100/718096/FFFFFF?text={{ substr($district->district_name, 0, 2) }}';"
                            >
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-secondary transition-colors text-center">
                            {{ $district->district_name }}
                        </h3>
                        <p class="text-sm text-gray-500 flex items-center space-x-1">
                            <span class="font-bold text-secondary">{{ $district->total }}</span>
                            <span>{{ $district->total == 1 ? 'imóvel' : 'imóveis' }}</span>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
