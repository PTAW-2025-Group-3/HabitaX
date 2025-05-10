@php use App\Enums\AttributeType; @endphp
<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-2 flex items-center">
        <i class="bi bi-sliders2-vertical mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="grid grid-cols-2 gap-3">
        <div>
            <label for="min_{{ $attribute->id }}" class="text-sm font-medium">Min</label>
            <input type="number"
                   @if($attribute->type == AttributeType::FLOAT)
                       step="0.01"
                   @endif
                   id="min_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][min]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   placeholder="Min value"
                   value="{{ request()->input('attributes.' . $attribute->id . '.min') }}">
        </div>
        <div>
            <label for="max_{{ $attribute->id }}" class="text-sm font-medium">Max</label>
            <input type="number"
                   @if($attribute->type == AttributeType::FLOAT)
                       step="0.01"
                   @endif
                   id="max_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][max]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   placeholder="Max value"
                   value="{{ request()->input('attributes.' . $attribute->id . '.max') }}">
        </div>
    </div>
</div>
