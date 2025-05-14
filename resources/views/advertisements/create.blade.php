@extends('layout.app')

@section('title', 'Criar Anúncio')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            @include('advertisements._form', [
                'action' => route('advertisements.store'),
                'method' => 'POST',
                'buttonText' => 'Publicar Anúncio',
                'advertisement' => null,
                'properties' => auth()->user()->properties,
            ])
        </div>
    </div>
@endsection
