<div class="relative">
    <input type="date" name="attributes[{{ $attr->id }}]"
           class="form-input-big w-full py-3 pl-4 pr-10 appearance-none"
           style="position: relative; z-index: 10; background: transparent;"
        {{ $attr->is_required ? 'required' : '' }}
        {{ $attr->min_date !== null ? 'min='.$attr->min_date->format('Y-m-d') : '' }}
        {{ $attr->max_date !== null ? 'max='.$attr->max_date->format('Y-m-d') : '' }}>
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
        <i class="bi bi-calendar-event"></i>
    </div>
</div>
@if($attr->min_date !== null || $attr->max_date !== null)
    <p class="text-xs text-gray-500 mt-1">
        @if($attr->min_date !== null && $attr->max_date !== null)
            Data entre {{ $attr->min_date->format('d/m/Y') }} e {{ $attr->max_date->format('d/m/Y') }}
        @elseif($attr->min_date !== null)
            Data mínima: {{ $attr->min_date->format('d/m/Y') }}
        @elseif($attr->max_date !== null)
            Data máxima: {{ $attr->max_date->format('d/m/Y') }}
        @endif
    </p>
@endif
