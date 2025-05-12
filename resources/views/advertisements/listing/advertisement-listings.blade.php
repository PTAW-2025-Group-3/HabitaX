@php use App\Models\District;use App\Models\Municipality;use App\Models\Parish;use App\Models\PropertyType; @endphp
<div x-data="page" x-init="view = '{{ $viewMode }}'" x-cloak class="w-full md:w-3/4">
    <div class="property-listings-container">
        <!-- Header Section -->
        <h1 class="text-xl font-semibold mb-4">
            {{ $advertisements->total() }} anúncios encontrados
            @php
                $locationParts = [];
                $propertyTypeName = null;

                if (!empty($selectedType)) {
                    $propertyType = PropertyType::find($selectedType);
                    $propertyTypeName = $propertyType ? $propertyType->name : null;
                }

                if ($propertyTypeName) {
                    array_unshift($locationParts, $propertyTypeName);
                }


                if (!empty($selectedParish)) {
                    $parish = Parish::find($selectedParish);
                    if ($parish) {
                        $locationParts[] = $parish->name;
                    }
                }

                if (!empty($selectedMunicipality)) {
                    $municipality = Municipality::find($selectedMunicipality);
                    if ($municipality) {
                        $locationParts[] = $municipality->name;
                    }
                }

                if (empty($selectedMunicipality) && empty($selectedParish) && !empty($selectedDistrict)) {
                    $district = District::find($selectedDistrict);
                    if ($district) {
                        $locationParts[] = $district->name;
                    }
                }

                $locationText = implode(' em ', $locationParts);
            @endphp

            @if(!empty($locationText))
                <span class="font-medium">para {{ $locationText }}</span>
            @endif
        </h1>

        @include('advertisements.listing.view-toggle-and-sort')

        @if(request('view') === 'list')
            @include('advertisements.listing.list')
        @else
            @include('advertisements.listing.grid')
        @endif


        <div class="mt-6">
            {{ $advertisements->appends(request()->query())->links() }}
        </div>
    </div>
</div>

@push('styles')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/advertisements/advertisement-slideshows.css') }}" />
    <script>
        (function() {
            const url = new URL(window.location.href);
            const viewParam = url.searchParams.get('view');
            const savedView = localStorage.getItem('adsView');

            if (!viewParam && savedView) {
                url.searchParams.set('view', savedView);
                url.searchParams.delete('page');
                window.location.replace(url.toString());
            }
        })();
    </script>

@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('dDOMContentLoaded', function () {
            const adIds = [
                @foreach($advertisements as $ad)
                    {{ $ad->id }},
                @endforeach
            ];
        });
    </script>
    <script src="{{ asset('js/advertisements/advertisement-listings.js') }}"></script>
@endpush
