<div class="w-full md:w-3/4">
    <div class="property-listings-container">
        <!-- Header Section -->
        <h1 class="text-xl font-semibold mb-4">
            {{ $advertisements->total() }} anúncios encontrados, Moradias em Aveiro
        </h1>

        @include('advertisements.listing.view-toggle-and-sort')

        <template x-if="view === 'grid'">
            <div class="space-y-8">
                @if($advertisements->isEmpty())
                    <p>Nenhum anúncio encontrado.</p>
                @else
                    @foreach($advertisements as $ad)
                        @include('advertisements.listing.property-card-grid', ['ad' => $ad])
                    @endforeach
                @endif
            </div>
        </template>

        <template x-if="view === 'list'">
            <div class="space-y-4">
                @if($advertisements->isEmpty())
                    <p>Nenhum anúncio encontrado.</p>
                @else
                    @foreach($advertisements as $ad)
                        @include('advertisements.listing.property-card-list', ['ad' => $ad])
                    @endforeach
                @endif
            </div>
        </template>

        <div class="mt-6">
            {{ $advertisements->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

