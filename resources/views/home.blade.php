@extends('layouts.app')

@section('title', 'Home')

@section('content')

  {{-- Hero Section --}}
  @include('home.sections.hero')

  {{-- Search Bar --}}
  @include('partials.search-bar')

  {{-- Featured Properties --}}
  @include('home.sections.featured')

  {{-- Property Types --}}
  @include('home.sections.property-types')

  {{-- Client Testimonials --}}
  @include('home.sections.client-testimonials')

  {{-- District Listing --}}
  @include('home.sections.district-listing')

@endsection
