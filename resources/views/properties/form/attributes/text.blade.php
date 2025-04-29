<div class="relative">
    <input type="text" name="attributes[{{ $attr->id }}]"
           class="form-input-big w-full py-3 pl-4 pr-10"
           placeholder="Digite aqui"
           value="{{ old('attributes.' . $attr->id, $parameter?->value) }}"
        {{ $attr->is_required ? 'required' : '' }}
        {{ $attr->min_length !== null ? 'minlength='.$attr->min_length : '' }}
        {{ $attr->max_length !== null ? 'maxlength='.$attr->max_length : '' }}>
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
        <i class="bi bi-pencil"></i>
    </div>
</div>
@if($attr->min_length !== null || $attr->max_length !== null)
    <p class="text-xs text-gray-500 mt-1">
        @if($attr->min_length !== null && $attr->max_length !== null)
            Texto entre {{ $attr->min_length }} e {{ $attr->max_length }} caracteres
        @elseif($attr->min_length !== null)
            Mínimo: {{ $attr->min_length }} caracteres
        @elseif($attr->max_length !== null)
            Máximo: {{ $attr->max_length }} caracteres
        @endif
    </p>
@endif
