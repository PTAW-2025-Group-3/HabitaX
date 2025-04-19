@extends('layout.app')

@section('title', 'Create Attribute')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create Attribute</h1>
    <div class="mb-4">
        <a href="{{ route('attributes.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Attributes</a>
    </div>
    @include('pages.attributes._form', [
        'action' => route('attributes.store'),
        'method' => 'POST',
        'buttonText' => 'Create Attribute',
        'attribute' => null
    ])
</div>
@endsection

@push('scripts')
    <script>
        function toggleUnitField() {
            const typeSelect = document.getElementById('type');
            const unitField = document.getElementById('unit-field');
            if (typeSelect.value === 'number') {
                unitField.style.display = 'block';
            } else {
                unitField.style.display = 'none';
            }
        }

        // Initialize visibility on page load
        document.addEventListener('DOMContentLoaded', function () {
            toggleUnitField();
        });
    </script>
@endpush
