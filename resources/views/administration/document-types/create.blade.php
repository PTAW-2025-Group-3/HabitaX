@extends('layout.app')

@section('title', 'Tipo de Documento')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('document-types.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Opções de Atributo
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Criar Tipo de Documento</h2>

            @include('administration.document-types._form', [
                'action' => route('document-types.store'),
                'buttonText' => 'Criar Tipo de Documento',
                'documentType' => null
            ])
        </div>
    </div>
@endsection
