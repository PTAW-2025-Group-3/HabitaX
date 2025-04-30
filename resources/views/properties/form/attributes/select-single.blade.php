<div class="relative w-full sm:w-auto">
    <select id="attributes-{{ $attr->id }}" name="attributes[{{ $attr->id }}]"
            class="dropdown-select py-3 pl-4 pr-10 w-full text-base"
        {{ $attr->is_required ? 'required' : '' }}>
        <option value="" disabled selected>Selecione uma opção</option>
        @foreach($attr->options as $opt)
            <option value="{{ $opt->id }}" {{ old('attributes.' . $attr->id, $parameter?->select_value) == $opt->id ? 'selected' : '' }}>
                {{ $opt->name }}
            </option>
        @endforeach
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
        <i class="bi bi-chevron-right dropdown-arrow transition-transform duration-300 ease-in-out"></i>
    </div>
</div>

<style>
    select:focus + div .dropdown-arrow {
        transform: rotate(90deg);
    }
</style>
