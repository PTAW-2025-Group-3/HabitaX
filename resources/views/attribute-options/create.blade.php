@extends('layout.app')

@section('title', 'Criar Opção de Atributo')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('attribute-options.index', ['id' => $attribute->id]) }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Opções de Atributo
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Criar Opção de Atributo</h2>

            @include('attribute-options._form', [
                'action' => route('attribute-options.store', ['id' => $attribute->id]),
                'method' => 'POST',
                'buttonText' => 'Criar Opção de Atributo',
                'option' => null
            ])
        </div>
    </div>
@endsection
