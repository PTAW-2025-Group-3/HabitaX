@extends('layout.app')

@section('title', 'Create Announcement')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-secondary">Criar Propriedade</h1>

        <form action="{{ route('pages.createad.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-8">
            @csrf

            @include('pages.createad.sections.details')
            @include('pages.createad.sections.location')
            @include('pages.createad.sections.general-info')
            @include('pages.createad.sections.additional-info')
            @include('pages.createad.sections.documents')
            @include('pages.createad.sections.photos')

            <div class="flex justify-end">
                <button type="submit"
                        class="btn-secondary px-6 py-2 rounded-md">
                    Criar Propriedade
                </button>
            </div>
        </form>
    </div>
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])
