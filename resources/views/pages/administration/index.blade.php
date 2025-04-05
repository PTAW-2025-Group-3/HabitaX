@extends('layout.app')

@section('title', 'Administration')

@section('content')
    <div class="container mx-auto p-4">
        @include('pages.administration.partials.stats')
        @include('pages.administration.partials.charts')
        @include('pages.administration.partials.user-management')
        @include('pages.administration.partials.parameters-management')
    </div>
@endsection
