@extends('layout.app')

@section('title', 'Contact Us')

@section('content')
    <section class="bg-gray-100 dark:bg-gray-900 py-16 px-4">
        <div class="max-w-7xl mx-auto space-y-16">
            @include('pages.contact.sections.header')
            <div class="grid md:grid-cols-2 gap-8">
                {{-- @include('contact._info-box') --}}
                @include('contact._contact-form')
            </div>
            @include('contact._faq')
        </div>
    </section>
@endsection
