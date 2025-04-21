@extends('layout.app')

@section('title', 'Advertisement Details')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 md:p-4 space-y-6 animate-fade-in">

        <!-- Header do anúncio  -->
        <div class="bg-gradient-to-r bg-white rounded-2xl shadow-md p-5 md:p-7 space-y-4 mt-6 md:mt-12">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div class="space-y-1">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-primary flex items-center gap-2">
                        <i class="bi bi-house-door-fill text-secondary"></i>
                        {{ $ad->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-2 text-sm md:text-base text-gray-600">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-geo-alt text-secondary"></i> {{ $property->country }}
                </span>
                        <span class="inline-flex items-center gap-1">
                    <i class="bi bi-geo-alt text-secondary"></i> {{ $property->parish->name }}, {{ $property->parish->municipality->name }}
                </span>
                        <span class="inline-flex items-center gap-1">
                    <i class="bi bi-arrow-left-right text-secondary"></i> {{ $ad->transaction_type }}
                </span>
                    </div>
                </div>
                <div class="text-3xl md:text-4xl font-bold text-secondary">
                    {{ number_format($ad->price, 0, ',', '.') }}€
                </div>
            </div>
        </div>

        <!-- Galeria com layout 50/50 -->
        <div class="grid grid-cols-12 gap-2 md:gap-4 relative">
            <div class="col-span-12 md:col-span-6 h-[300px] md:h-[500px]">
                <img src="{{ $property->images[0] }}"
                     class="w-full h-full object-cover rounded-lg shadow" alt="Imagem Principal">
            </div>

            <div class="col-span-12 md:col-span-6 grid grid-cols-2 grid-rows-2 gap-2 h-[300px] md:h-[500px]">
                @foreach($property->images as $image)
                    @if(!$loop->first && $loop->index < 5)
                        <div>
                            <img src="{{ $image }}"
                                 class="w-full h-full object-cover rounded-lg shadow" alt="Miniatura">
                        </div>
                    @endif
                @endforeach

                @for($i = count($property->images); $i < 5; $i++)
                    <div class="bg-gray-100 rounded-lg shadow"></div>
                @endfor
            </div>

            @if(count($property->images) > 5)
                <a href="#todas-fotos"
                   class="absolute bottom-2 right-2 bg-white bg-opacity-80 backdrop-blur px-3 py-1.5 text-sm rounded shadow text-gray-700 font-semibold hover:bg-opacity-100 transition">
                    Mostrar todas as fotos
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <div class="col-span-1 md:col-span-2 space-y-4">
                <section class="space-y-2">
                    <h2 class="text-lg md:text-xl font-semibold">Comentário do Anunciante</h2>
                    <p class="text-gray-700 text-sm md:text-base">{{ $ad->description }}</p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 md:p-4 rounded shadow">
                        <h3 class="font-semibold">Equipamentos</h3>
                        <ul class="list-disc list-inside text-sm md:text-base">
                            {{--                            @foreach($ad->equipments as $eq)--}}
                            {{--                                <li>{{ $eq }}</li>--}}
                            {{--                            @endforeach--}}
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-3 md:p-4 rounded shadow">
                        <h3 class="font-semibold">Características Específicas</h3>
                        <ul class="list-disc list-inside text-sm md:text-base">
                            @foreach($attributes as $attribute)
                                <li>{{ $attribute['name'] }}: {{ $attribute['value'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                @include('advertisements.individual.price-history', ['ad' => $ad])
                @include('advertisements.individual.loan-simulator', ['ad' => $ad])
            </div>

            <div class="space-y-6 animate-fade-in">
                <!-- Mapa com estilo moderno -->
                <div class="bg-gradient-to-tr from-indigo-50 to-white rounded-2xl shadow-md overflow-hidden">
                    <div class="h-48 md:h-56">
                        <iframe
                            src="https://www.google.com/maps/embed?..."
                            class="w-full h-full border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                    <button
                        class="w-full text-blue-600 hover:text-blue-700 bg-white text-sm md:text-base font-semibold py-3 border-t border-indigo-100 transition">
                        <i class="bi bi-geo-alt-fill mr-1"></i> Ver no mapa
                    </button>
                </div>

                @include('advertisements.individual.contact-form', ['ad' => $ad])
            </div>

        </div>
    </div>
@endsection
