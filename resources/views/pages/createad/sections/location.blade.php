<div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200">
    <h2 class="text-xl font-bold text-primary mb-6">Localização</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- País (Sempre Portugal) --}}
        <div>
            <label for="country" class="block text-sm font-medium text-gray-600 mb-1">País</label>
            <div class="relative">
                <select name="country" id="country"
                        class="py-2 pl-3 pr-10 w-full bg-gray-100 border border-gray-300 rounded-lg
                               text-sm text-gray-700 appearance-none cursor-not-allowed" disabled>
                    <option value="Portugal" selected>Portugal</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Distrito --}}
        <div>
            <label for="district" class="block text-sm font-medium text-gray-600 mb-1">Distrito</label>
            <div class="relative">
                <select name="district" id="district"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">Seleciona o distrito</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Concelho --}}
        <div>
            <label for="municipality" class="block text-sm font-medium text-gray-600 mb-1">Concelho</label>
            <div class="relative">
                <select name="municipality" id="municipality"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">Seleciona o concelho</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Freguesia --}}
        <div>
            <label for="parish" class="block text-sm font-medium text-gray-600 mb-1">Freguesia</label>
            <div class="relative">
                <select name="parish" id="parish"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">Seleciona a freguesia</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

    </div>
</div>
