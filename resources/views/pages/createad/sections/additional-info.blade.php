<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Informação Adicional</h2>

    {{-- Área + Ano + Divisões --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">

        {{-- Área Útil --}}
        <div>
            <label for="usable-area" class="block text-sm font-medium text-gray mb-1">Área Útil (m²)</label>
            <div class="relative">
                <select id="usable-area" name="usable_area" required
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Área Bruta --}}
        <div>
            <label for="gross-area" class="block text-sm font-medium text-gray mb-1">Área Bruta (m²)</label>
            <div class="relative">
                <select id="gross-area" name="gross_area"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondary focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Área do Terreno --}}
        <div>
            <label for="land-area" class="block text-sm font-medium text-gray mb-1">Área do Terreno (m²)</label>
            <div class="relative">
                <select id="land-area" name="land_area"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondary focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Ano de Construção --}}
        <div>
            <label for="construction-year" class="block text-sm font-medium text-gray mb-1">Ano de Construção</label>
            <div class="relative">
                <select id="construction-year" name="construction_year"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondary focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Número de Quartos --}}
        <div>
            <label for="rooms" class="block text-sm font-medium text-gray mb-1">Quartos</label>
            <div class="relative">
                <select id="rooms" name="rooms"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondaryfocus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Casas de Banho --}}
        <div>
            <label for="bathrooms" class="block text-sm font-medium text-gray mb-1">Casas de Banho</label>
            <div class="relative">
                <select id="bathrooms" name="bathrooms"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondary focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Lugares de Garagem --}}
        <div>
            <label for="garage" class="block text-sm font-medium text-gray mb-1">Lugares de Garagem</label>
            <div class="relative">
                <select id="garage" name="garage"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-secondary focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option disabled selected>Selecionar</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Características --}}
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray mb-2">Características</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
            @foreach (["Ar Condicionado", "Varanda", "Jardim", "Piscina", "Painéis Solares", "Elevador", "Acesso para Mobilidade Reduzida", "Garagem / Estacionamento"] as $feature)
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="features[]" value="{{ $feature }}" id="{{ Str::slug($feature) }}"
                           class="rounded text-blue-600 focus:ring-blue-500">
                    <label for="{{ Str::slug($feature) }}" class="text-sm text-gray-secondary">{{ $feature }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
