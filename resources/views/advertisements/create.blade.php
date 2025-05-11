@extends('layout.app')

@section('title', 'Criar Anúncio')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('advertisements.my') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Meus Anúncios
                </a>
            </div>

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
