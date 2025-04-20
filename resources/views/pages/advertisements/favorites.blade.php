@extends('pages.account.account-layout')

@section('title', 'Anúncios Favoritos')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-primary mb-6">Meus Favoritos</h1>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <p class="text-gray">
                    Aqui estão os imóveis que marcou como favoritos.
                </p>
                <div class="relative w-full sm:w-auto">
                    <select
                        class="dropdown-select py-2 pl-4 pr-10 w-full h-10">
                        <option disabled selected>Ordenar por</option>
                        <option>Preço: Menor para Maior</option>
                        <option>Preço: Maior para Menor</option>
                        <option>Data: Mais Recente</option>
                        <option>Data: Mais Antiga</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                        <i class="chevron bi bi-chevron-down transition-transform duration-300 ease-in-out"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favorites as $favorite)
                    <div class="home-ads-style">
                        <div class="relative">
                            <img
                                src="{{ $favorite->advertisement->property->images[0] }}"
                                alt="Property"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 flex items-center justify-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-heart-fill text-red text-sm"></i>
                            </button>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-secondary">{{ $favorite->advertisement->property->title }}</h3>
                            <p class="text-sm text-gray mb-2">{{ $favorite->advertisement->property->parish->name }}</p>
                            <p class="text-lg font-bold text-primary">{{ $favorite->advertisement->price }}€</p>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="text-gray">Adicionado há {{ \Carbon\Carbon::parse($favorite->created_at)->diffForHumans() }}</span>
                                <button class="text-red hover:text-red-700 font-medium transition-colors">Remover</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray mb-4">Não encontrou o que procura? Explore mais imóveis!</p>
                <a href="{{ route('advertisements.index') }}" class="btn-primary py-2 px-6">Ver Mais Imóveis</a>
            </div>
        </div>
    </div>
@endsection
