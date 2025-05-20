<div class="relative w-full h-[42px]">
    <!-- READONLY DISPLAY -->
    <input
            type="text"
            :value="generateSearchLabel()"
            readonly
            @focus="ui.focusInput()"
            placeholder="Introduzir localização"
            class="w-full border rounded px-4 py-2 bg-white cursor-pointer focus:outline-none"
    />

    <!-- CLEAR BUTTON -->
    <template x-if="(selectedParishIds.size > 0 || (selectedIds.parish === null && selectedMunicipality))">
        <button
                @click.stop="clearSelection()"
                class="absolute top-1/2 right-2 -translate-y-1/2 text-gray-400 hover:text-black text-lg font-bold z-10">
            &times;
        </button>
    </template>

    <!-- CASE 1: parishesCheckbox – overlay of tags + input -->
    <template x-if="open && viewState === 'parishesCheckbox'">
        <div class="absolute inset-0 z-20 bg-white border rounded shadow px-2 py-1 flex flex-wrap items-center gap-2">
            <!-- Município inteiro -->
            <template x-if="selectedParishIds.size === 0 && selectedIds.parish === null && selectedMunicipality">
                <div @click.stop="selectParishAndSwitch(null)"
                     class="flex items-center bg-white border border-gray-300 hover:border-black text-sm px-2 py-1 rounded cursor-pointer transition">
                    <span x-text="selectedMunicipality.name + ', cidade inteira'"></span>
                    <span class="ml-1 text-gray-500 hover:text-black">&times;</span>
                </div>
            </template>

            <!-- Até 3 freguesias -->
            <template x-for="(id, index) in [...selectedParishIds].slice(0, 3)" :key="id">
                <div @click.stop="selectedParishIds.delete(id)"
                     class="flex items-center bg-white border border-gray-300 hover:border-black text-sm px-2 py-1 rounded cursor-pointer transition">
                    <span x-text="selectedMunicipality.parishes.find(p => p.id === id)?.name"></span>
                    <span class="ml-1 text-gray-500 hover:text-black">&times;</span>
                </div>
            </template>

            <!-- +N restantes -->
            <template x-if="[...selectedParishIds].length > 3">
                <div class="bg-gray-800 text-white text-sm px-2 py-1 rounded-full">
                    + <span x-text="[...selectedParishIds].length - 3"></span>
                </div>
            </template>

            <!-- Dummy input -->
            <input type="text"
                   class="flex-1 bg-transparent focus:outline-none min-w-[4rem]"
                   x-model="localSearch"
                   @keydown.stop
                   @focus="ui.focusInput()" />
        </div>
    </template>

    <!-- CASE 2: default input (districts/municipalities/search) -->
    <template x-if="open && viewState !== 'parishesCheckbox'">
        <input type="text"
               class="absolute inset-0 z-20 w-full border rounded px-4 py-2 focus:outline-none bg-white"
               placeholder="Introduzir localização"
               x-model="search"
               @focus="ui.focusInput()" />
    </template>
</div>
