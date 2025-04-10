<div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition">
    <a href="{{ route('advertisements.show', 1) }}">
        <div class="flex flex-col md:flex-row items-start md:items-center">
            <img src="{{ asset($property['image']) }}" alt="{{ $property['title'] }}" class="w-full md:w-40 h-40 object-cover rounded-md mb-4 md:mb-0 md:mr-6">
            <div class="flex-grow">
                <h3 class="text-lg font-bold text-gray-800">{{ $property['title'] }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $property['location'] }}</p>
                <p class="text-xl font-bold text-blue-800 mt-2">{{ $property['price'] }}</p>
                <p class="mt-2 text-gray-700 line-clamp-2">{{ $property['description'] }}</p>
                <div class="mt-4 flex space-x-2">
                    <button class="px-4 py-2 bg-white text-blue-900 border border-blue-900 rounded-lg text-sm hover:bg-blue-50">Ver Telefone</button>
                    <button class="px-4 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800">Contactar</button>
                </div>
            </div>
        </div>
    </a>
</div>
