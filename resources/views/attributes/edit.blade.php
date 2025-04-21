@extends('layout.app')

@section('title', 'Edit Attribute')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('attributes.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Atributos
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Editar Atributo</h2>

            @include('attributes._form', [
                'action' => route('attributes.update', $attribute->id),
                'method' => 'PUT',
                'buttonText' => 'Salvar Alterações',
                'attribute' => $attribute
            ])
        </div>
    </div>
@endsection
