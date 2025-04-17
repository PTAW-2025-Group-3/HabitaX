@extends('layout.app')

@section('title', 'Create Announcement')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-primary">Criar Propriedade</h1>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-8">
            @csrf

            @include('pages.properties.sections.details')
            @include('pages.properties.sections.location')
            @include('pages.properties.sections.general-info')
            @include('pages.properties.sections.additional-info')
            @include('pages.properties.sections.documents')
            @include('pages.properties.sections.photos')

            <div class="flex justify-end">
                <button type="submit" class="btn-secondary px-6 py-2 rounded-md">
                    Criar Propriedade
                </button>
            </div>
        </form>
    </div>
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])
