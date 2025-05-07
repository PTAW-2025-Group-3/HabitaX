@extends('layout.app')

@section('title', 'Opções de Atributo')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('attribute-groups.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Opções de Atributo
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Editar Grupo de Atributos</h2>
            @include('attribute-groups._form', [
                'action' => route('attribute-groups.update', $group->id),
                'method' => 'PUT',
                'buttonText' => 'Salvar Alterações',
                'group' => $group
            ])
        </div>
    </div>
@endsection
