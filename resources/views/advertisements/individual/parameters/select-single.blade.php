<div class="p-4 bg-white shadow rounded border">
    <div class="text-gray-500 text-sm">{{ $parameter->attribute->name }}</div>
    <div class="text-gray-900">{{ \App\Models\PropertyAttributeOption::find($parameter->select_value)->name }}</div>
</div>
