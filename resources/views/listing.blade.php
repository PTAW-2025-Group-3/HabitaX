@extends('layouts.app')

@section('title', 'Property Listing')

@section('content')
    <div class="w-full min-h-screen" x-data="{ view: 'grid' }">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="max-w-4xl mx-auto p-8 rounded">
                @include('property.partials.toggle-buttons')
                <div class="w-full h-px bg-gray-400 mb-6"></div>
                @include('property.partials.search-fields')
            </div>

            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6 mt-8">
                @include('property.partials.filters-centered')
                @include('property.partials.property-listings')
            </div>
        </div>
    </div>
@endsection
