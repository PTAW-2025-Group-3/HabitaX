@extends('layout.app')

@section('title', 'Create Announcement')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-primary">Criar Propriedade</h1>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-8">
            @csrf

            @include('pages.properties.create.details')
            @include('pages.properties.create.location')
            @include('pages.properties.create.general-info')
            @include('pages.properties.create.additional-info')
            @include('pages.properties.create.documents')
            @include('pages.properties.create.photos')

            <div class="flex justify-end">
                <button type="submit" class="btn-secondary px-6 py-2 rounded-md">
                    Criar Propriedade
                </button>
            </div>
        </form>
    </div>
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])
