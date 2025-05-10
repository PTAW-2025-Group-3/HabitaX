<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-2 flex items-center">
        <i class="bi bi-list mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <select
        id="select_single_{{ $attribute->id }}"
        name="attributes[{{ $attribute->id }}][select_single]"
        class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary">
        <option value="" selected>Selecione opção</option>
        @foreach($attribute->options as $option)
            <option value="{{ $option->id }}"
                {{ request()->input('attributes.' . $attribute->id . '.select_single') == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>
