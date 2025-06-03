<input type="text" x-model="searchQuery" @input.debounce.300ms="performSearch" placeholder="Digite o nome da localização..." class="w-full border px-3 py-2 rounded">
<template x-for="result in searchResults" :key="result.municipality.id">
    <div class="p-2 border-b">
        <div class="block text-blue-700 text-sm font-semibold">
            <span x-text="result.municipality.name + ' (' + result.municipality.district.name + ')'"></span>
        </div>

        <template x-for="parish in result.parishes" :key="parish.id">
            <label class="pl-6 block text-gray-800 text-sm cursor-pointer hover:underline">
                <input type="checkbox" :value="parish.id" :checked="selectedParishes.includes(parish.id)" @change="toggleParish(parish.id)">
                <span class="ml-1" x-text="parish.name"></span>
            </label>
        </template>
    </div>
</template>

<div x-show="searchHistory.length" class="space-y-2">
    <template x-for="(item, index) in searchHistory" :key="item.timestamp">
        <div class="flex justify-between items-center border p-2 rounded">
            <div class="text-sm cursor-pointer" @click="selectFromHistory(item)">
                <span x-text="item.district ? item.district.name : ''"></span>
                <span x-show="item.municipality?.name"> / <span x-text="item.municipality ? item.municipality.name : ''"></span></span>
                <template x-if="item.parishNames && item.parishNames.length">
                    <div class="text-xs text-gray-700 mt-1">
                        <template x-for="(name, i) in item.parishNames.slice(0, 10)" :key="i">
                            <span x-text="name + (i < item.parishNames.length - 1 ? ', ' : '')"></span>
                        </template>
                        <template x-if="item.parishNames.length > 10">
                            <span class="text-gray-500">+<span x-text="item.parishNames.length - 10"></span> mais</span>
                        </template>
                    </div>
                </template>
            </div>
            <button @click="deleteHistoryItem(index)" class="text-red-500 text-xs hover:underline">Remover</button>
        </div>
    </template>
</div>
