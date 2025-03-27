<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Additional Information</h2>
  
    {{-- Area + Year + Rooms --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
  
      {{-- Usable Area --}}
      <div>
        <label for="usable-area" class="block text-sm font-medium text-gray-700">Usable Area (m²)</label>
        <select id="usable-area" name="usable_area" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Gross Area --}}
      <div>
        <label for="gross-area" class="block text-sm font-medium text-gray-700">Gross Area (m²)</label>
        <select id="gross-area" name="gross_area"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Land Area --}}
      <div>
        <label for="land-area" class="block text-sm font-medium text-gray-700">Land Area (m²)</label>
        <select id="land-area" name="land_area"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Construction Year --}}
      <div>
        <label for="construction-year" class="block text-sm font-medium text-gray-700">Year of Construction</label>
        <select id="construction-year" name="construction_year"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Room Count --}}
      <div>
        <label for="rooms" class="block text-sm font-medium text-gray-700">Rooms</label>
        <select id="rooms" name="rooms"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Bathrooms --}}
      <div>
        <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bathrooms</label>
        <select id="bathrooms" name="bathrooms"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
      {{-- Garage Spots --}}
      <div>
        <label for="garage" class="block text-sm font-medium text-gray-700">Garage Spots</label>
        <select id="garage" name="garage"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option disabled selected>Select</option>
        </select>
      </div>
  
    </div>
  
    {{-- Features --}}
    <div class="mt-4">
      <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
        @foreach (["Air Conditioning", "Balcony", "Garden", "Pool", "Solar Panels", "Elevator", "Reduced Mobility Access", "Garage / Parking"] as $feature)
          <div class="flex items-center space-x-2">
            <input type="checkbox" name="features[]" value="{{ $feature }}" id="{{ Str::slug($feature) }}"
                   class="rounded text-blue-600 focus:ring-blue-500">
            <label for="{{ Str::slug($feature) }}" class="text-sm text-gray-700">{{ $feature }}</label>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  