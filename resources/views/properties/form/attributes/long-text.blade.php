<div class="relative md:col-span-2">
    <textarea name="attributes[{{ $attr->id }}]" rows="4"
              class="form-input-big w-full p-4 resize-y"
              placeholder="Digite sua descrição aqui"
        {{ $attr->is_required ? 'required' : '' }}
        {{ $attr->min_length !== null ? 'minlength='.$attr->min_length : '' }}
        {{ $attr->max_length !== null ? 'maxlength='.$attr->max_length : '' }}>{{ old('attributes.' . $attr->id, $parameter?->value) }}</textarea>
    <div class="absolute top-3 right-3 pointer-events-none text-gray">
        <i class="bi bi-file-text"></i>
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
