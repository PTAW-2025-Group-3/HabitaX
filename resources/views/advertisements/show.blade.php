@extends('layout.app')

@section('title', 'Advertisement Details')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 md:p-4 space-y-4 md:space-y-6">
        <h1 class="text-xl md:text-3xl font-bold">{{ $ad->title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4">
            <!-- Main Image -->
            <div class="col-span-1 md:col-span-2">
                <img src="{{ $property->images[0] }}" class="w-full h-[250px] md:h-[450px] object-cover rounded-lg shadow"
                     alt="Main Image">
            </div>

            <!-- Gallery Thumbnails -->
            <div class="grid grid-cols-2 grid-rows-2 md:grid-rows-3 gap-2">
                @foreach($property->images as $image)
                    @if(!$loop->first && $loop->index < 5)
                        <div class="h-[100px] md:h-[150px]">
                            <img src="{{ $image }}" class="w-full h-full object-cover rounded-lg shadow" alt="Thumbnail">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                <div class="text-base md:text-lg font-semibold text-gray-700">{{ $ad->transaction_type }} em {{ $property->location }}</div>
                <div class="text-xs md:text-sm text-gray-500">{{ $ad->description }}</div>
            </div>
            <div class="text-2xl md:text-4xl font-bold text-secondary">{{ number_format($ad->price, 0, ',', '.') }}€</div>
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
{{--                @include('pages.advertisements.individual.market-stats', ['ad' => $ad])--}}
                @include('advertisements.individual.loan-simulator', ['ad' => $ad])
            </div>

            <div class="space-y-4">
                <div class="space-y-4">
                    <div class="rounded overflow-hidden shadow">
                        <iframe src="https://www.google.com/maps/embed?..." class="w-full h-48 border-0"
                                allowfullscreen="" loading="lazy"></iframe>
                        <button class="w-full bg-white py-2 text-blue-500 text-sm md:text-base font-semibold border-t">Ver no mapa</button>
                    </div>

                    @include('advertisements.individual.contact-form', ['ad' => $ad])
                </div>
            </div>
        </div>
    </div>
@endsection
