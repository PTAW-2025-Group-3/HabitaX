@extends('layout.app')

@section('title', 'Adicionar Tipo de Propriedade')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Adicionar Tipo de Propriedade</h1>
        <div class="mb-4">
            <a href="{{ route('property-types.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Voltar para
                Tipos de Propriedade</a>
        </div>
        @include('property-types._form', [
            'action' => route('property-types.store'),
            'buttonText' => 'Adicionar Tipo de Propriedade',
            'propertyType' => null
        ])
    </div>
@endsection
