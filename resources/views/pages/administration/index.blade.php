@extends('layout.app')

@section('title', 'Administration')

@section('content')
    <div class="bg-back min-h-screen py-10 animate-fade-in">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">

            @include('pages.administration.partials.header')

            @include('pages.administration.partials.stats')

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('pages.administration.partials.charts')
            </div>

            @include('pages.administration.partials.user-management')

            <div class="bg-white rounded-lg shadow-md p-6">
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
    </div>
@endsection
