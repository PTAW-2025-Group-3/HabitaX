<div class="mb-6">
    <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
        <i class="bi bi-list mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>

    <div class="relative dropdown-wrapper">
        <select
            id="select_single_{{ $attribute->id }}"
            name="attributes[{{ $attribute->id }}][select_single]"
            class="p-2 pl-4 pr-10 dropdown-select">
            <option value="" selected>Selecione opção</option>
            @foreach($attribute->options as $option)
                <option value="{{ $option->id }}"
                    {{ request()->input('attributes.' . $attribute->id . '.select_single') == $option->id ? 'selected' : '' }}>
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
            <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
        </div>
    </div>
</div>
