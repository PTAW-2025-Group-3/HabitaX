@extends('layout.app')

@section('title', 'Editar Anúncio')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            @include('advertisements._form', [
                'action' => route('advertisements.update', $advertisement->id),
                'method' => 'PUT',
                'buttonText' => 'Atualizar Anúncio',
                'advertisement' => $advertisement,
                'properties' => auth()->user()->properties,
            ])
        </div>
    </div>
@endsection
