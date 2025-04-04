@extends('layout.app')

@section('content')
    <div class="container mx-auto p-4">
        @include('components.administration.stats')
        @include('components.administration.charts')
        @include('components.administration.user-management')
        @include('components.administration.parameters-management')
    </div>
@endsection
