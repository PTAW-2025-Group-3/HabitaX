<div class="p-4 bg-white shadow rounded border">
    <div class="text-gray-500 text-sm">{{ $parameter->attribute->name }}</div>
    <div class="text-gray-900">
        @foreach($parameter->options as $option)
            <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded mr-1 mb-1">{{ $option->option->name }}</span>
        @endforeach
    </div>
</div>
