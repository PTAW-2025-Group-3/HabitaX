@extends('pages.account.account')

@section('account-content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Minhas Propriedades</h2>
            <a href="{{ route('advertisements.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Adicionar Propriedade
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Property Card 1 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        Ativo
                    </span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Moradia T4 com Piscina</h3>
                    <p class="text-sm text-gray-500 mb-2">Porto, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">495.000€</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Publicado há 2 dias</span>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Property Card 2 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Pendente
                    </span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Apartamento T2 Moderno</h3>
                    <p class="text-sm text-gray-500 mb-2">Lisboa, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">275.000€</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Publicado há 1 semana</span>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Property Card 3 --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Property" 
                         class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                        Inativo
                    </span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Moradia T5 com Jardim</h3>
                    <p class="text-sm text-gray-500 mb-2">Braga, Portugal</p>
                    <p class="text-lg font-bold text-blue-800">720.000€</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Publicado há 3 dias</span>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 