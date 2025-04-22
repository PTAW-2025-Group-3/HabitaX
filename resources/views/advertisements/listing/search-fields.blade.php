<form action="{{ route('advertisements.index') }}" method="GET" class="w-full">
    <div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
        <!-- Tipo de Imóvel -->
        <div class="w-full md:w-1/2">
            <label for="property-type" class="block text-gray-secondary font-semibold mb-2">
                Tipo de Imóvel
            </label>

            <div class="relative dropdown-wrapper w-full">
                <select name="property_type" id="property-type" class="p-3 pl-4 pr-10 w-full dropdown-select">
                    <option value="">Todos</option>
                    @foreach ($propertyTypes as $type)
                        <option value="{{ $type->id }}" {{ request('property_type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                    <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>

        <!-- Local (será usado depois) -->
        <div class="w-full md:w-1/2">
            <label for="location" class="block text-gray-secondary font-semibold mb-2">Local</label>
            <input
                type="text"
                id="location"
                name="location"
                value="{{ request('location') }}"
                class="w-full px-5 py-3 form-input-big"
                disabled
            />
        </div>

        <!-- Botão de Pesquisa -->
        <div class="w-full md:w-auto flex items-end">
            <button
                type="submit"
                id="search-btn"
                class="w-full md:w-auto px-5 py-3 btn-primary"
            >
                <i class="bi bi-search mr-2"></i>
                <span>Pesquisar</span>
            </button>
        </div>
    </div>
</form>
