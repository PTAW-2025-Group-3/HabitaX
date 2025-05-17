<div class="mb-6">
    <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
        <i class="bi bi-sliders2-vertical mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>

    <div class="grid grid-cols-2 gap-3">
        <div class="relative">
            <input type="number"
                   id="min_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][min_int]"
                   class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg"
                   placeholder="Mínimo"
                   value="{{ request()->input('attributes.' . $attribute->id . '.min_int') }}">
        </div>
        <div class="relative">
            <input type="number"
                   id="max_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][max_int]"
                   class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg"
                   placeholder="Máximo"
                   value="{{ request()->input('attributes.' . $attribute->id . '.max_int') }}">
        </div>
    </div>
</div>
