<div class="p-4 bg-white shadow rounded border">
    <div class="text-gray-500 text-sm">{{ $parameter->attribute->name }}</div>
    <div class="{{ $parameter->boolean_value ? 'text-green-600' : 'text-red-600' }}">
        {{ $parameter->boolean_value ? 'Sim' : 'Não' }}
    </div>
</div>
