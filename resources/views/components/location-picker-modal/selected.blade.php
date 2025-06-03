<div class="space-y-4">
    <template x-if="!selectedDistricts.length">
        <div class="text-gray-500 text-center">
            Nenhuma localização selecionada ainda.
            <button @click="openChooseMode()" class="block mt-2 text-blue-600 underline">+ Adicionar Localização</button>
        </div>
    </template>

    <template x-for="district in selectedDistricts" :key="district.id">
        <div class="border p-2 rounded">
            <div class="flex justify-between items-center">
                <span class="font-bold" x-text="district.name"></span>
                <div class="space-x-2">
                    <button class="text-sm text-blue-600 underline" @click="openChooseMode(district.id)">+ Adicionar</button>
                    <button class="text-sm text-red-600 underline" @click="removeDistrict(district.id)">Remover</button>
                </div>
            </div>

            <template x-for="municipality in district.municipalities" :key="municipality.id">
                <div class="ml-4 border-l pl-4 mt-2">
                    <div class="flex justify-between items-center">
                        <span x-text="municipality.name"></span>
                        <div class="space-x-2">
                            <button class="text-sm text-blue-600 underline" @click="openChooseMode(district.id, municipality.id)">+ Adicionar</button>
                            <button class="text-sm text-red-600 underline" @click="removeMunicipality(district.id, municipality.id)">Remover</button>
                        </div>
                    </div>

                    <ul class="ml-4 list-disc text-sm">
                        <template x-for="parish in municipality.parishes" :key="parish.id">
                            <li>
                                <span x-text="parish.name"></span>
                                <button class="ml-2 text-red-600 text-xs underline" @click="removeParish(district.id, municipality.id, parish.id)">×</button>
                            </li>
                        </template>
                    </ul>
                    <button class="text-sm text-blue-600 underline mt-1" @click="openChooseMode(district.id, municipality.id)">+ Adicionar freguesia</button>
                </div>
            </template>
        </div>
    </template>
</div>
