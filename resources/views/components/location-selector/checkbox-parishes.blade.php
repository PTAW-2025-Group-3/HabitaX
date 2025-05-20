<div class="w-full border rounded bg-white shadow">
    <!-- Top bar with tags -->
    <div
            class="flex flex-wrap items-center gap-2 px-4 py-2 min-h-[3rem] border-b transition-all"
            :class="{ 'pt-2 pb-2': selectedParishIds.size > 0 || (selectedIds.parish === null && selectedMunicipality), 'py-1': selectedParishIds.size === 0 && !(selectedIds.parish === null && selectedMunicipality) }"
    >
        <!-- Município inteiro (como тег) -->
        <template x-if="selectedParishIds.size === 0 && selectedIds.parish === null && selectedMunicipality">
            <div @click="selectParishAndSwitch(null)"
                 class="flex items-center bg-white border border-gray-300 hover:border-black text-sm px-2 py-1 rounded cursor-pointer transition">
                <span x-text="selectedMunicipality.name + ', cidade inteira'"></span>
                <span class="ml-1 text-gray-500 hover:text-black">&times;</span>
            </div>
        </template>

        <!-- Até 3 freguesias -->
        <template x-for="(id, index) in [...selectedParishIds].slice(0, 3)" :key="id">
            <div @click="selectedParishIds.delete(id)"
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
    </div>

    <!-- Lista com checkboxes -->
    <div class="max-h-80 overflow-y-auto divide-y">
        <!-- Município inteiro -->
        <div class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer"
             @click="selectMunicipalityWide()">
            <input type="checkbox" :checked="selectedParishIds.size === 0 && selectedIds.parish === null">
            <div>
                <div class="font-medium" x-text="`${selectedMunicipality?.name || ''}, conselho inteiro`"></div>
                <div class="text-xs text-gray-500" x-text="`concelho, ${selectedDistrict?.name || ''}`"></div>
            </div>
        </div>

        <!-- Freguesias -->
        <template x-for="parish in selectedMunicipality?.parishes || []" :key="parish.id">
            <div @click="toggleParish(parish)"
                 class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                <input type="checkbox" :checked="selectedParishIds.has(parish.id)">
                <div>
                    <div class="font-medium" x-text="parish.name"></div>
                    <div class="text-xs text-gray-500">freguesia</div>
                </div>
            </div>
        </template>
    </div>
</div>
