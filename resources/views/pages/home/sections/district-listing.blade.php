{{-- Section: District Listing --}}
<section class="py-20 bg-back px-4">
    <div class="max-w-7xl mx-auto">

      {{-- Top Tabs: Comprar / Arrendar --}}
      <div class="flex space-x-6 mb-6 border-b">
        <button class="top-tab text-gray-700 font-semibold pb-2 border-b-2 border-transparent hover:border-indigo-500 active" data-type="comprar">Comprar</button>
        <button class="top-tab text-gray-700 font-semibold pb-2 border-b-2 border-transparent hover:border-indigo-500" data-type="arrendar">Arrendar</button>
      </div>

      {{-- Second Tabs: Property Types --}}
      <div class="flex flex-wrap gap-4 mb-10">
        @foreach(['moradias','apartamentos','escritorios','lojas','predios','quartos'] as $tab)
          <button class="second-tab px-4 py-2 rounded bg-white shadow text-sm font-medium text-gray-700 hover:bg-indigo-50"
                  data-category="{{ $tab }}">
            {{ ucfirst($tab) }}
          </button>
        @endforeach
      </div>

      {{-- District Result Cards --}}
      <div id="district-content" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 text-sm text-gray-secondary font-medium">
        {{-- Dynamic content here --}}
      </div>

    </div>
  </section>

  {{-- Load jQuery (if not already loaded) --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  {{-- Load Script --}}
  <script src="{{ asset('js/pages/home/districtListing.js') }}"></script>
