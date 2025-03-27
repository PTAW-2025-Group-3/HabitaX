<div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-transform hover:scale-[1.01] border border-gray-200">
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
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 leading-tight">{{ $property['title'] }}</h3>
                        <p class="text-sm text-gray-700 font-medium flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $property['location'] }}
                        </p>
                    </div>
                    <div class="flex space-x-1">
                        <button class="text-gray-500 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-900 transition-colors p-2 rounded-full hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-900 mt-4">{{ $property['price'] }}</p>
                <div class="flex items-center space-x-4 mt-4">
                    <div class="flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-sm font-medium">{{ $property['details'] }}</span>
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
</div>
