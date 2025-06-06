<div class="space-y-4">
    <template x-if="!selectedDistricts.length && !selectedMunicipalities.length && !selectedParishes.length">
        <div class="text-gray-500 text-center">
            Nenhuma localização selecionada ainda.
            <button @click="openChooseMode()" class="block mt-2 text-blue-600 underline">+ Adicionar Localização</button>
        </div>
    </template>

    <!-- DISTRICTS -->
    <template x-for="district in selectedDistricts" :key="district.id">
        <div class="border p-2 rounded">
            <div class="flex justify-between items-center">
                <span class="font-bold" x-text="district.name"></span>
                <button class="text-sm text-red-600 underline" @click="removeDistrict(district.id)">Remover</button>
            </div>
        </div>
    </template>

    <!-- MUNICIPALITIES -->
    <template x-for="municipality in selectedMunicipalities" :key="municipality.id">
        <div class="border p-2 rounded ml-4">
            <div class="flex justify-between items-center">
                <span x-text="municipality.name"></span>
                <button class="text-sm text-red-600 underline" @click="removeMunicipality(municipality.id)">Remover</button>
            </div>
        </div>
    </template>

    <!-- PARISHES GROUPED BY MUNICIPALITY -->
    <template x-for="(group, municipalityId) in Object.groupBy(selectedParishes.map(p => parishes.find(full => full.id === p)), p => p.municipality_id)" :key="municipalityId">
        <div class="ml-4 border-l pl-4 mt-2">
            <div class="font-semibold" x-text="municipalities.find(m => m.id == municipalityId)?.name ?? 'Concelho desconhecido'"></div>
            <ul class="ml-4 list-disc text-sm">
                <template x-for="parish in group" :key="parish.id">
                    <li>
                        <span x-text="parish.name"></span>
                        <button class="ml-2 text-red-600 text-xs underline" @click="removeParish(parish.id)">×</button>
                    </li>
                </template>
            </ul>
        </div>
    </template>
</div>
