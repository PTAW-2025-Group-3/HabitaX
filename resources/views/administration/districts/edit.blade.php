@extends('layout.app')

@section('title', 'Editar Distrito')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('districts.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Distritos
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Editar Distrito</h2>

            @include('administration.districts._form', [
                'action' => route('districts.update', ['id' => $district->id]),
                'method' => 'PUT',
                'buttonText' => 'Atualizar Distrito',
                'district' => $district,
                'nameEditable' => true,
            ])
        </div>
    </div>
@endsection
