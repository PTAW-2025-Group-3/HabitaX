{{-- Section: District Listing --}}
<section class="py-12 md:py-20 bg-back px-4">
    <div class="max-w-7xl mx-auto">

      {{-- Top Tabs: Comprar / Arrendar --}}
      <div class="flex space-x-4 md:space-x-6 mb-6 border-b overflow-x-auto pb-1 scrollbar-hide">
        <button class="top-tab text-gray-700 whitespace-nowrap font-semibold pb-2 border-b-2 border-transparent hover:border-indigo-500 active" data-type="comprar">Comprar</button>
        <button class="top-tab text-gray-700 whitespace-nowrap font-semibold pb-2 border-b-2 border-transparent hover:border-indigo-500" data-type="arrendar">Arrendar</button>
      </div>

      {{-- Second Tabs: Property Types --}}
      <div class="flex flex-wrap gap-2 md:gap-4 mb-8 md:mb-10 overflow-x-auto pb-2 scrollbar-hide">
        @foreach(['moradias','apartamentos','escritorios','lojas','predios','quartos'] as $tab)
          <button class="second-tab px-3 py-1.5 md:px-4 md:py-2 rounded bg-white shadow text-xs md:text-sm font-medium text-gray-700 hover:bg-indigo-50 whitespace-nowrap"
                  data-category="{{ $tab }}">
            {{ ucfirst($tab) }}
          </button>
        @endforeach
      </div>

      {{-- District Result Cards --}}
      <div id="district-content" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-6 text-xs md:text-sm text-gray-secondary font-medium">
        {{-- Dynamic content here --}}
      </div>

    </div>
  </section>

  {{-- Add this CSS for mobile scrolling --}}
  <style>
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }
    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>

  {{-- Load Script --}}
  <script src="{{ asset('js/pages/home/districtListing.js') }}"></script>
