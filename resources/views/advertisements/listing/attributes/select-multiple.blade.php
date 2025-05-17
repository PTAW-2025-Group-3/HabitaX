<div class="mb-6">
    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
        <i class="bi bi-list-check mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>

    <div class="grid grid-cols-2 gap-3">
        @foreach($attribute->options as $option)
            <label class="cursor-pointer">
                <input type="checkbox"
                       id="option_{{ $option->id }}"
                       name="attributes[{{ $attribute->id }}][select_multiple][]"
                       class="peer hidden"
                       value="{{ $option->id }}"
                    {{ in_array($option->id, (array) request()->input('attributes.' . $attribute->id . '.select_multiple', [])) ? 'checked' : '' }}>
                <div class="h-12 flex items-center justify-center rounded-lg border-2 border-gray-200
                            peer-checked:border-secondary peer-checked:bg-blue-50
                            hover:bg-gray-50 transition-all px-2">
                    <span class="text-sm font-medium text-gray-700 peer-checked:text-secondary truncate">{{ $option->name }}</span>
                </div>
            </label>
        @endforeach
    </div>
</div>
