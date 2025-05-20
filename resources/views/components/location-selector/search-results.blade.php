<div class="border-t">
    <template x-for="(result, i) in searchResults" :key="result.municipality.id">
        <div class="px-4">
            <!-- Municipality header -->
            <div class="flex justify-between items-center py-2">
                <div>
                    <div class="font-semibold" x-text="result.municipality.name"></div>
                    <div class="text-xs text-gray-500" x-text="`concelho, ${result.municipality.district.name}`"></div>
                </div>
                <button @click="toggleMunicipality(result.municipality.id)">
                    <span x-text="expandedMunicipalities.has(result.municipality.id) ? '▲' : '▼'"></span>
                </button>
            </div>

            <!-- Parishes -->
            <template x-for="(parish, j) in limitedParishes(result)" :key="parish.id">
                <div @click="select(`${result.municipality.district.name}, ${result.municipality.name}, ${parish.name}`, null, result.municipality.id, parish.id)"
                     class="px-2 py-1 pl-6 hover:bg-gray-100 cursor-pointer">
                    <div x-text="parish.name" class="text-sm font-medium"></div>
                    <div class="text-xs text-gray-500">freguesia</div>
                </div>
            </template>

            <!-- Show more -->
            <div x-show="result.parishes.length > 3 && !expandedMunicipalities.has(result.municipality.id)"
                 @click="expandedMunicipalities.add(result.municipality.id)"
                 class="text-center text-sm text-blue-600 py-2 cursor-pointer">
                Mostrar mais
            </div>
        </div>
    </template>
</div>
