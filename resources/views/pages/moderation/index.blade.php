@extends('layout.app')

@section('title', 'Moderation')

@section('content')
    <div class="bg-back min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">

            @include('pages.moderation.partials.header')

            @include('pages.moderation.partials.summary.summary-boxes')

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('pages.moderation.partials.charts.charts-suspended')
                @include('pages.moderation.partials.charts.charts-reports')
                @include('pages.moderation.partials.charts.charts-type-denunciation')
            </div>

            @include('pages.moderation.denunciation')

            @include('pages.moderation.verification-advertiser')

            @include('pages.moderation.suspended-users')

            <div>
                <a href="{{ route('contact-us.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Pedidos de contacto
                </a>
            </div>
        </div>
    </div>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
