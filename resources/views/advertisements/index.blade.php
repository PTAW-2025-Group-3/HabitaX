@extends('layout.app')

@section('title', 'Advertisements Listing')

@section('content')
    <div class="bg-back w-full min-h-screen" x-data="{ view: 'grid' }">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="w-full p-8 rounded">
                @include('advertisements.listing.search-fields', [
                    'propertyTypes' => $propertyTypes,
                    'districts' => $districts,
                    'selectedDistrict' => $selectedDistrict,
                    'selectedMunicipality' => $selectedMunicipality,
                    'selectedParish' => $selectedParish,
                    'selectedType' => $selectedType,
                ])
            </div>

            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6 mt-8">
                @include('advertisements.listing.filters-centered')
                @include('advertisements.listing.property-listings')
            </div>
        </div>
    </div>
@endsection
