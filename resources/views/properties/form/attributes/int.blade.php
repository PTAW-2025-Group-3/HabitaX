<div class="relative">
    <input type="number" name="attributes[{{ $attr->id }}]"
           value="{{ old('attributes.' . $attr->id, $parameter?->int_value) }}"
           class="form-input-big w-full py-3 pl-4 pr-10"
           placeholder="Insira um valor numérico"
        {{ $attr->is_required ? 'required' : '' }}
        {{ $attr->min_value !== null ? 'min='.$attr->min_value : '' }}
        {{ $attr->max_value !== null ? 'max='.$attr->max_value : '' }}>
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
        <i class="bi bi-hash"></i>
    </div>
</div>
@if($attr->min_value !== null || $attr->max_value !== null)
    <p class="text-xs text-gray-500 mt-1">
        @if($attr->min_value !== null && $attr->max_value !== null)
            Valor entre {{ $attr->min_value }} e {{ $attr->max_value }}
        @elseif($attr->min_value !== null)
            Valor mínimo: {{ $attr->min_value }}
        @elseif($attr->max_value !== null)
            Valor máximo: {{ $attr->max_value }}
        @endif
        @if($attr->unit)
            <span class="ml-1">({{ $attr->unit }})</span>
        @endif
    </p>
@endif
