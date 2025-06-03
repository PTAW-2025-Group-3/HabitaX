@extends('layout.app')

@section('title', 'Resultados da Pesquisa')

@section('content')
    <button id="openLocationModalButton" class="px-4 py-2 bg-blue-600 text-white rounded">Open Location Selector</button>
    @include('components.location-picker-modal', [
        'triggerId' => 'openLocationModalButton',
        'selectedDistrict' => null,
        'selectedMunicipality' => null,
        'selectedParishes' => [],
    ])
@endsection
