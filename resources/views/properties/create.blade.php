@extends('layout.app')

@section('title', 'Create Announcement')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-primary">Criar Propriedade</h1>

        @include('properties._form', [
            'action' => route('properties.store'),
            'method' => 'POST',
            'property' => null,
            'buttonText' => 'Criar Propriedade'
        ])
    </div>
@endsection
