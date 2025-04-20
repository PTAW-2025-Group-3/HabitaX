@extends('layout.app')

@section('title', 'Create Attribute')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('attributes.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Atributos
                </a>
            </div>

            <h2 class="text-xl font-bold text-primary mb-6">Criar Atributo</h2>

            @include('attributes._form', [
                'action' => route('attributes.store'),
                'method' => 'POST',
                'buttonText' => 'Criar Atributo',
                'attribute' => null
            ])
        </div>
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

            // Add event listener to type select
            document.getElementById('type').addEventListener('change', toggleUnitField);
        });
    </script>
@endpush
