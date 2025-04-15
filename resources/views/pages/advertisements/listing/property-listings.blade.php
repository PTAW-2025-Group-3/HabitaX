<div class="w-full md:w-3/4">
    <!-- Header Section -->
    <h1 class="text-xl font-semibold mb-4">
        {{ $totalResults }} anúncios encontrados, Moradias em Aveiro
    </h1>

    @include('pages.advertisements.listing.view-toggle-and-sort')

    <template x-if="view === 'grid'">
        <div class="space-y-8">
            @foreach($advertisements as $ad)
                @include('pages.advertisements.listing.property-card-grid', ['ad' => $ad])
            @endforeach
        </div>
    </template>

    <template x-if="view === 'list'">
        <div class="space-y-4">
            @foreach($advertisements as $ad)
                @include('pages.advertisements.listing.property-card-list', ['ad' => $ad])
            @endforeach
        </div>
    </template>

    <!-- Pagination Section -->
    <div class="mt-6">
        @if($advertisements->isEmpty())
            <p>No advertisements found.</p>
        @else
            {{ $advertisements->links('vendor.pagination.tailwind') }}
        @endif
    </div>
</div>


