<div class="bg-white shadow rounded-xl p-6 border border-gray-300">
  <h2 class="text-xl font-bold text-blue-700 mb-4">Property Details</h2>

  {{-- Title --}}
  <div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
    <input type="text" name="title" id="title"
           placeholder="e.g., Modern T3 Apartment"
           class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
  </div>

  {{-- Description --}}
  <div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
    <textarea name="description" id="description" rows="5"
              placeholder="Describe the property in detail..."
              class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
  </div>

  {{-- Price --}}
  <div class="mb-0">
    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Property Price (€)</label>
    <input type="number" name="price" id="price"
           placeholder="Enter the price"
           class="w-1/3 rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
  </div>
</div>
