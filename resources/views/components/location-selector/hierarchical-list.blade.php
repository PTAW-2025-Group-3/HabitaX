<template x-if="mode === 'list'">
    <div class="border-t">
        <div class="px-4 py-2 font-medium text-blue-600 hover:bg-gray-100 cursor-pointer" @click="ui.goBack()">&larr; Voltar</div>

        <x-location-selector.list-districts />
        <x-location-selector.list-municipalities />
        <x-location-selector.list-parishes />
    </div>
</template>
