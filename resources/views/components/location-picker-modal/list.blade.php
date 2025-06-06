<!-- VOLTAR -->
<template x-if="selectedDistricts.length > 0 || selectedMunicipalities.length > 0">
    <div class="p-2 text-gray-600 cursor-pointer hover:underline" @click="goBack">&larr; Voltar</div>
</template>

<!-- ETAPA 1: LISTAR DISTRITOS -->
<div x-show="selectedDistricts.length === 0">
    <template x-for="district in districts" :key="district.id">
        <div class="p-2 border-b cursor-pointer hover:bg-gray-100" @click="selectDistrict(district)">
            <span x-text="district.name"></span>
        </div>
    </template>
</div>

<!-- ETAPA 2: LISTAR MUNICÍPIOS -->
<div x-show="selectedDistricts.length > 0 && selectedMunicipalities.length === 0">
    <div class="p-2 text-blue-600 cursor-pointer" @click="selectWholeDistrict">Selecionar distrito inteiro</div>
    <template x-for="municipality in municipalities" :key="municipality.id">
        <div class="p-2 border-b cursor-pointer hover:bg-gray-100" @click="selectMunicipality(municipality)">
            <span x-text="municipality.name"></span>
        </div>
    </template>
</div>

<!-- ETAPA 3: LISTAR FREGUESIAS -->
<div x-show="selectedMunicipalities.length > 0">
    <div class="p-2 font-semibold text-blue-600 cursor-pointer" @click="selectWholeMunicipality">Selecionar concelho inteiro</div>
    <template x-for="parish in parishes" :key="parish.id">
        <label class="block p-2 hover:bg-gray-50">
            <input type="checkbox" :value="parish.id" :checked="selectedParishes.includes(parish.id)" @change="toggleParish(parish.id)">
            <span x-text="' ' + parish.name"></span>
        </label>
    </template>
</div>
