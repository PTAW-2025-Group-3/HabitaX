<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Informações Gerais</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Tipo de Propriedade --}}
        <div>
            <label for="property-type" class="block text-sm font-medium text-gray-600 mb-1">Tipo de Propriedade</label>
            <div class="relative">
                <select id="property-type" name="property_type" required
                        class="py-2 pl-3 pr-10 w-full
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="" disabled selected>Seleciona o tipo de propriedade</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Tipologia --}}
        <div>
            <label for="typology" class="block text-sm font-medium text-gray-600 mb-1">Tipologia</label>
            <div class="relative">
                <select id="typology" name="typology" required
                        class="py-2 pl-3 pr-10 w-full
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="" disabled selected>Seleciona a tipologia</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Estado de Conservação --}}
        <div>
            <label for="condition" class="block text-sm font-medium text-gray-600 mb-1">Estado de Conservação</label>
            <div class="relative">
                <select id="condition" name="condition" required
                        class="py-2 pl-3 pr-10 w-full
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="" disabled selected>Seleciona o estado</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Certificação Energética --}}
        <div>
            <label for="energy-cert" class="block text-sm font-medium text-gray-600 mb-1">Certificação Energética</label>
            <div class="relative">
                <select id="energy-cert" name="energy_cert" required
                        class="py-2 pl-3 pr-10 w-full
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="" disabled selected>Seleciona a certificação</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

    </div>
</div>
