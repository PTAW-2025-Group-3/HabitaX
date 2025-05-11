@extends('layout.app')

@section('title', 'Criar Anúncio')

@section('content')
    <div class="container mx-auto px-4 py-6">
        {{-- <h1 class="text-2xl font-bold mb-6">Criar Anúncio</h1> --}}

        @include('advertisements._form', [
            'action' => route('advertisements.store'),
            'method' => 'POST',
            'buttonText' => 'Publicar Anúncio',
            'advertisement' => null,
            'properties' => auth()->user()->properties,
        ])
    </div>
@endsection
