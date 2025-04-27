{{-- Section: District Listing --}}
<section class="py-12 md:py-20 px-4">
    <div class="max-w-7xl mx-auto">
        {{-- District Result Cards --}}
        <h2 class="text-2xl sm:text-xl md:text-3xl font-bold text-gray-secondary mb-8 md:mb-12 w-full text-center">
            Listagem por<span class="text-secondary"> Distrito</span>
        </h2>
        <div>

        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6">
            {{-- Dynamic content here --}}
            @foreach ($adsPerDistrict as $district)
                <a href="{{ route('advertisements.index', ['district' => $district->district_id]) }}"
                   class="text-center sm:text-md text-lg text-secondary hover:text-primary transition">
                    {{ $district->district_name }} - {{ $district->total }}
                </a>
            @endforeach
        </div>
    </div>
</section>



