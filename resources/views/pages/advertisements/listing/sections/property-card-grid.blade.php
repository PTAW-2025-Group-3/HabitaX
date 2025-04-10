<div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-transform hover:scale-[1.01] border border-gray-200">
    <a href="{{ route('advertisements.show', 1) }}">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-2/5 relative">
                <img src="{{ asset($property['image']) }}" alt="{{ $property['title'] }}" class="h-64 md:h-full w-full object-cover">
                @if(isset($property['featured']) && $property['featured'])
                    <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">Destaque</div>
                @endif
            </div>
            <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        {{-- Titulo e Localização --}}
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 leading-tight">{{ $property['title'] }}</h3>
                            <p class="text-sm text-gray-700 font-medium flex items-center mt-1">
                                <i class="bi bi-geo-alt text-secondary"></i>
                                <span class="ml-1">{{ $property['location'] }}</span>
                            </p>
                        </div>
                        {{-- Favorito e Share --}}
                        <div class="flex space-x-1 ">
                            <button class="text-gray-500 hover:text-red-500 transition-colors h-10 w-10 rounded-full hover:bg-gray-100">
                                <i class="bi bi-heart "></i>
                            </button>
                            <button class="text-gray-500 hover:text-gray-900 transition-colors h-10 w-10 rounded-full hover:bg-gray-100">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-blue-9000 mt-4">{{ $property['price'] }}</p>
                    <div class="flex items-center space-x-4 mt-4">
                        <div class="flex items-center text-gray-700">
                            <i class="bi bi-house-door-fill text-secondary"></i>
                            <span class="text-sm font-medium ml-1">{{ $property['details'] }}</span>
                        </div>
                    </div>
                    <p class="text-gray-700 mt-4 leading-relaxed line-clamp-3">{{ $property['description'] }}</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between">
                    <img src="{{ asset($property['logo']) }}" alt="{{ $property['agency'] }}" class="h-8">
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-white text-blue-900 border border-blue-900 rounded-lg font-medium text-sm hover:bg-blue-50 transition-colors">Ver Telefone</button>
                        <button class="px-4 py-2 bg-blue-900 text-white rounded-lg font-medium text-sm hover:bg-blue-800 transition-colors">Contactar</button>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>





