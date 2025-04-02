@extends('pages.account.account')

@section('account-content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Meus Favoritos</h2>
            <div class="flex items-center space-x-4">
                <select class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
                    <option>Ordenar por</option>
                    <option>Preço: Menor para Maior</option>
                    <option>Preço: Maior para Menor</option>
                    <option>Data: Mais Recente</option>
                    <option>Data: Mais Antiga</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Property Card 1 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <button class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Moradia T4 com Piscina</h3>
                    <p class="text-sm text-gray-500 mb-2">Porto, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">495.000€</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <span>Adicionado há 2 dias</span>
                        <button class="text-red-600 hover:text-red-700">Remover</button>
                    </div>
                </div>
            </div>

            {{-- Property Card 2 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <button class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Apartamento T2 Moderno</h3>
                    <p class="text-sm text-gray-500 mb-2">Lisboa, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">275.000€</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <span>Adicionado há 1 semana</span>
                        <button class="text-red-600 hover:text-red-700">Remover</button>
                    </div>
                </div>
            </div>

            {{-- Property Card 3 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <button class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Moradia T5 com Jardim</h3>
                    <p class="text-sm text-gray-500 mb-2">Braga, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">720.000€</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <span>Adicionado há 3 dias</span>
                        <button class="text-red-600 hover:text-red-700">Remover</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
