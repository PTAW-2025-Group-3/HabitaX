@extends('layout.app')

@section('title', 'Home')

@section('content')

  {{-- Search Bar --}}
  @include('pages.home.sections.search-bar')

  {{-- Featured Properties --}}
  @include('pages.home.sections.featured', ['featuredAds' => $featuredAds])

  {{-- Property Types --}}
  @include('pages.home.sections.property-types', ['propertyTypes' => $propertyTypes])

  {{-- Client Testimonials --}}
  @include('pages.home.sections.client-testimonials', ['propertyTypes' => $propertyTypes])

  {{-- District Listing --}}
  @include('pages.home.sections.district-listing')

@endsection
