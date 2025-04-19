@extends('layout.app')

@section('title', 'Editar Tipo de Propriedade')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Tipo de Propriedade</h1>
        <div class="mb-4">
            <a href="{{ route('property-types.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Voltar para Tipos de Propriedade</a>
        </div>
        @include('pages.property-types._form', [
            'action' => route('property-types.update', ['id' => $propertyType->id]),
            'method' => 'PUT',
            'buttonText' => 'Atualizar Tipo de Propriedade',
            'propertyType' => $propertyType
        ])
    </div>
@endsection
