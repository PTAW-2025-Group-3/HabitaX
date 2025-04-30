<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
        <i class="bi bi-geo-alt text-xl text-primary mr-3"></i>
        <h2 class="text-xl font-bold text-primary">Localização</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- País (Sempre Portugal) -->
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="country" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-flag mr-2 text-secondary"></i>
                País
            </label>
            <div class="relative dropdown-wrapper w-full">
                <select name="country" id="country"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base bg-gray-100 cursor-not-allowed" disabled>
                    <option value="Portugal" selected>Portugal</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>

        <!-- Distrito -->
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="district" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-map mr-2 text-secondary"></i>
                Distrito
            </label>
            <div class="relative dropdown-wrapper w-full">
                <select name="district" id="district"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base">
                    <option value="" disabled selected>Distrito</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>

        <!-- Concelho -->
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="municipality" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-pin-map mr-2 text-secondary"></i>
                Concelho
            </label>
            <div class="relative dropdown-wrapper w-full">
                <select name="municipality" id="municipality"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base">
                    <option value="" disabled selected>Concelho</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>

        <!-- Freguesia -->
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="parish" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-geo mr-2 text-secondary"></i>
                Freguesia
            </label>
            <div class="relative dropdown-wrapper w-full">
                <select name="parish" id="parish"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base">
                    <option value="" disabled selected>Freguesia</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>
    </div>

    @error('parish')
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
    @enderror

    {{--  Street address, ZIP code, and maybe autodetect city by ZIP code  --}}
</div>
