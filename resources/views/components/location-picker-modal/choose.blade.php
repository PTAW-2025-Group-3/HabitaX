<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-show="mode === 'choose'" x-transition>
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl overflow-hidden">
        <div class="border-b p-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Escolher Modo</h2>
            <button @click="closeChooseMode" class="text-gray-500 hover:text-black">&times;</button>
        </div>

        <div class="p-4 space-y-4">
            <div class="flex space-x-2 justify-center">
                <button @click="chooseAndSetMode('list')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded" :class="{ 'bg-blue-600 text-white': mode === 'list' }">Lista</button>
                <button @click="chooseAndSetMode('search')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded" :class="{ 'bg-blue-600 text-white': mode === 'search' }">Pesquisa</button>
            </div>
            <div class="text-center">
                <button @click="resetState(); closeChooseMode()" class="px-4 py-2 bg-red-600 text-white rounded">Limpar</button>
            </div>
        </div>
    </div>
</div>
