<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-2 flex items-center">
        <i class="bi bi-list-check mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="grid grid-cols-2 gap-3">
        @foreach($attribute->options as $option)
            <div class="flex items-center">
                <input type="checkbox"
                       id="option_{{ $option->id }}"
                       name="attributes[{{ $attribute->id }}][value][]"
                       class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary"
                       value="{{ $option->id }}"
                       {{ in_array($option->id, (array) request()->input('attributes.' . $attribute->id . '.value', [])) ? 'checked' : '' }}>
                <label for="option_{{ $option->id }}" class="ml-2 text-sm font-medium">{{ $option->name }}</label>
            </div>
        @endforeach
    </div>
</div>
