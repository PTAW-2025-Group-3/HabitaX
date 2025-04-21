@extends('layout.app')

@section('title', 'Administration')

@section('content')
    <div class="container mx-auto p-4">
        @include('pages.administration.partials.stats')
        @include('pages.administration.partials.charts')
        @include('pages.administration.partials.user-management')

        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-secondary mb-4">Configurações de Propriedades</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('property-types.index') }}" class="btn-primary px-6 py-3">
                    <i class="bi bi-building mr-2"></i>
                    Gerir Tipos de Propriedade
                </a>
                <a href="{{ route('attributes.index') }}" class="btn-primary px-6 py-3">
                    <i class="bi bi-tags-fill mr-2"></i>
                    Gerir Atributos
                </a>
            </div>
        </div>
    </div>
@endsection
