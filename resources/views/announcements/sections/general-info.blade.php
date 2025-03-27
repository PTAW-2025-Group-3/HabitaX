<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">General Information</h2>
  
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      
      {{-- Property Type --}}
      <div>
        <label for="property-type" class="block text-sm font-medium text-gray-700">Property Type</label>
        <select id="property-type" name="property_type" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="" disabled selected>Select Property Type</option>
        </select>
      </div>
  
      {{-- Typology --}}
      <div>
        <label for="typology" class="block text-sm font-medium text-gray-700">Typology</label>
        <select id="typology" name="typology" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="" disabled selected>Select Typology</option>
        </select>
      </div>
  
      {{-- Condition --}}
      <div>
        <label for="condition" class="block text-sm font-medium text-gray-700">Condition</label>
        <select id="condition" name="condition" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="" disabled selected>Select Condition</option>
        </select>
      </div>
  
      {{-- Energy Certification --}}
      <div>
        <label for="energy-cert" class="block text-sm font-medium text-gray-700">Energy Certification</label>
        <select id="energy-cert" name="energy_cert" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="" disabled selected>Select Certification</option>
        </select>
      </div>
  
    </div>
  </div>
  