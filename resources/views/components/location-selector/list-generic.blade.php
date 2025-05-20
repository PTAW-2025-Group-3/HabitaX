<div>
    <!-- Entire region selection (inteiro) -->
    <template x-if="viewState === 'municipalities' && selectedDistrict">
        <div @click="select(selectedDistrict.id, null, null)"
             class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
            <div>
                <div class="font-medium" x-text="selectedDistrict.name + ', distrito inteiro(a)'"></div>
                <div class="text-xs text-gray-500">distrito</div>
            </div>
        </div>
    </template>

    <!-- Entire district / municipality selection (inteiro) -->
    <template x-if="viewState === 'parishesList' && selectedMunicipality">
        <div @click="select(selectedDistrict.id, selectedMunicipality.id, null, false)"
             class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
            <div>
                <div class="font-medium" x-text="selectedMunicipality.name + ', concelho inteiro(a)'"></div>
                <div class="text-xs text-gray-500" x-text="'concelho, ' + selectedDistrict?.name"></div>
            </div>
        </div>
    </template>

    <!-- Header acima da lista -->
    <div class="uppercase text-xs font-bold text-gray-600 px-4 pt-2 pb-1 border-b">
        <template x-if="viewState === 'districts'">
            <span>ESCOLHA UM(A) DISTRITO</span>
        </template>
        <template x-if="viewState === 'municipalities'">
            <span>ESCOLHA UM(A) CONCELHO</span>
        </template>
        <template x-if="viewState === 'parishesList'">
            <span>ESCOLHA UM(A) FREGUESIA</span>
        </template>
    </div>

    <!-- List -->
    <template x-for="item in items" :key="item.id">
        <div @click="handleSelect(item)"
             class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
            <div>
                <div class="font-medium" x-text="item.name"></div>
                <div class="text-xs text-gray-500" x-text="itemSubtitle(item)"></div>
            </div>
            <svg class="ml-auto w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </template>
</div>
