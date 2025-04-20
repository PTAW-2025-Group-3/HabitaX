@extends('layout.app')

@section('title', 'Editar Tipo de Propriedade')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('property-types.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Tipos de Propriedade
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Editar Tipo de Propriedade</h2>

            @include('property-types._form', [
                'action' => route('property-types.update', ['id' => $propertyType->id]),
                'method' => 'PUT',
                'buttonText' => 'Atualizar Tipo de Propriedade',
                'propertyType' => $propertyType
            ])
        </div>
    </div>
@endsection
