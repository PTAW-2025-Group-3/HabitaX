@extends('layout.app')

@section('title', 'Administration')

@section('content')
    <div class="container mx-auto p-4">
        @include('pages.administration.partials.stats')
        @include('pages.administration.partials.charts')
        @include('pages.administration.partials.user-management')
        <button
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
            onclick="window.location.href='{{ route('attributes.index') }}'">
            Gerir Atributos
        </button>
        <button
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
            onclick="window.location.href='{{ route('property-types.index') }}'">
            Gerir Tipos de Propriedade
        </button>
    </div>
@endsection
