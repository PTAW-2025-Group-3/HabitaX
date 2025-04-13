@extends('layout.app')

@section('title', 'Advertisements Listing')

@section('content')
    <div class="bg-back w-full min-h-screen" x-data="{ view: 'grid' }">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="max-w-4xl mx-auto p-8 rounded">
                @include('pages.advertisements.listing.toggle-buttons')
                <div class="w-full h-px bg-gray-400 mb-6"></div>
                @include('pages.advertisements.listing.search-fields')
            </div>

            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6 mt-8">
                @include('pages.advertisements.listing.filters-centered')
                @include('pages.advertisements.listing.property-listings')
            </div>
        </div>
    </div>
@endsection
