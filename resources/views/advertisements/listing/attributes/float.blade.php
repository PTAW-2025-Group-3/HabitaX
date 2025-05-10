@php use App\Enums\AttributeType; @endphp
<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-2 flex items-center">
        <i class="bi bi-sliders2-vertical mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="grid grid-cols-2 gap-3">
        <div>
            <label for="min_{{ $attribute->id }}" class="text-sm font-medium">Mínimo</label>
            <input type="number"
                   step="0.01"
                   id="min_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][min_float]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   placeholder="Min value"
                   value="{{ request()->input('attributes.' . $attribute->id . '.min_float') }}">
        </div>
        <div>
            <label for="max_{{ $attribute->id }}" class="text-sm font-medium">Máximo</label>
            <input type="number"
                   step="0.01"
                   id="max_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][max_float]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   placeholder="Max value"
                   value="{{ request()->input('attributes.' . $attribute->id . '.max_float') }}">
        </div>
    </div>
</div>
