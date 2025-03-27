<div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200">
    <h2 class="text-xl font-semibold text-blue-700 mb-6">Location</h2>
  
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      {{-- Country (Always Portugal) --}}
      <div>
        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
        <select name="country" id="country"
                class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed" disabled>
          <option value="Portugal" selected>Portugal</option>
        </select>
      </div>
  
      {{-- District --}}
      <div>
        <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
        <select name="district" id="district"
                class="w-full border border-gray-300 rounded-md px-4 py-2">
          <option value="">Select District</option>
          {{-- JS will populate here --}}
        </select>
      </div>
  
      {{-- Municipality (Concelho) --}}
      <div>
        <label for="municipality" class="block text-sm font-medium text-gray-700 mb-1">Municipality</label>
        <select name="municipality" id="municipality"
                class="w-full border border-gray-300 rounded-md px-4 py-2">
          <option value="">Select Municipality</option>
        </select>
      </div>
  
      {{-- Parish (Freguesia) --}}
      <div>
        <label for="parish" class="block text-sm font-medium text-gray-700 mb-1">Parish</label>
        <select name="parish" id="parish"
                class="w-full border border-gray-300 rounded-md px-4 py-2">
          <option value="">Select Parish</option>
        </select>
      </div>
    </div>
  </div>
  