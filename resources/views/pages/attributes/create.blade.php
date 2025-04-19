@extends('layout.app')

@section('title', 'Create Attribute')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create Attribute</h1>
    <div class="mb-4">
        <a href="{{ route('attributes.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Attributes</a>
    </div>
    <form method="POST" action="{{ route('attributes.store') }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
                <input type="text" name="name" id="name" placeholder="Ex: Tamanho"
                       value="{{ old('name', $attribute->name ?? '') }}"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
            </div>

            <div>
                <label for="type" class="block text-sm font-semibold text-primary">Tipo</label>
                <select name="type" id="type"
                        class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary"
                        onchange="toggleUnitField()">
                    @foreach(['text', 'number', 'boolean', 'select'] as $type)
                        <option value="{{ $type }}" @selected(old('type', $attribute->type ?? '') === $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="unit-field" style="display: none;">
                <label for="unit" class="block text-sm font-semibold text-primary">Unidade</label>
                <input type="text" name="unit" id="unit"
                       value="{{ old('unit', $attribute->unit ?? '') }}"
                       placeholder="Ex: cm, kg"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
            </div>

            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_required" id="is_required" value="1"
                       @checked(old('is_required', $attribute->is_required ?? false))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="is_required" class="ml-2 text-sm text-primary">Obrigatório</label>
            </div>

            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       @checked(old('is_active', $attribute->is_active ?? true))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="is_active" class="ml-2 text-sm text-primary">Ativo</label>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="relative mb-4 p-3 bg-red-50 text-xs sm:text-sm text-red-600 rounded-lg z-10">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="w-full rounded-md bg-primary py-2 px-4 text-center font-semibold text-white shadow hover:bg-primary-dark transition">
                Guardar
            </button>
        </div>
    </form>
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
