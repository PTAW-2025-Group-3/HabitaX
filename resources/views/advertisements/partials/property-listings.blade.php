<div class="w-full md:w-3/4">
    <h1 class="text-xl font-semibold mb-4">135 anúncios encontrados, Moradias em Aveiro</h1>

    @include('advertisements.partials.view-toggle-and-sort')

    <template x-if="view === 'grid'">
        <div class="space-y-8">
            @foreach($properties as $property)
                @include('advertisements.partials.property-card-grid', ['property' => $property])
            @endforeach
        </div>
    </template>

    <template x-if="view === 'list'">
        <div class="space-y-4">
            @foreach($properties as $property)
                @include('advertisements.partials.property-card-list', ['property' => $property])
            @endforeach
        </div>
    </template>

    <div class="mt-8 flex justify-center">
        @include('advertisements.partials.pagination')
    </div>
</div>
