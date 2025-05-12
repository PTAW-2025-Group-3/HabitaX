@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="container mx-auto p-4">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Search Bar --}}
    @include('pages.home.sections.search-bar')

    {{-- Featured Properties --}}
    @include('pages.home.sections.featured', ['featuredAds' => $featuredAds])

    {{-- Property Types --}}
    @include('pages.home.sections.property-types', ['propertyTypes' => $propertyTypes])

    {{-- District Listing --}}
    @include('pages.home.sections.district-listing', ['adsPerDistrict' => $adsPerDistrict])

    {{-- Client Testimonials --}}
    @include('pages.home.sections.client-testimonials')

    {{-- News Section --}}
    @include('pages.home.sections.news', ['news' => $news])

@endsection
