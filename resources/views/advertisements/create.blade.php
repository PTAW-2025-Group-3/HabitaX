@extends('layouts.app')

@section('title', 'Create Announcement')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-indigo-800">Create Advertisement</h1>

        <form action="{{ route('advertisements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            @include('advertisements.sections.details')
            @include('advertisements.sections.location')
            @include('advertisements.sections.general-info')
            @include('advertisements.sections.additional-info')
            @include('advertisements.sections.documents')
            @include('advertisements.sections.photos')

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md shadow transition">
                    Publish Announcement
                </button>
            </div>
        </form>
    </div>
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])
