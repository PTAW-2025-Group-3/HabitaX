<div id="prolongarModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <!-- Background overlay com blur -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"></div>

    <div class="flex items-center justify-center min-h-screen px-4 relative">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <!-- Cabeçalho com ícone -->
            <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-gray-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-900">Prolongar Suspensão</h2>
                </div>
                <button class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeModal('prolongarModal')">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Corpo do modal -->
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600 mb-4">Por quanto tempo deseja prolongar a suspensão deste utilizador?</p>

                <div class="space-y-3 mt-3">
                    <div class="flex items-center">
                        <input id="oneWeek" name="suspensionTime" type="radio" class="h-4 w-4 text-amber-600 focus:ring-amber-500">
                        <label for="oneWeek" class="ml-3 text-sm text-gray-700">1 semana</label>
                    </div>
                    <div class="flex items-center">
                        <input id="oneMonth" name="suspensionTime" type="radio" class="h-4 w-4 text-amber-600 focus:ring-amber-500" checked>
                        <label for="oneMonth" class="ml-3 text-sm text-gray-700">1 mês</label>
                    </div>
                    <div class="flex items-center">
                        <input id="threeMonths" name="suspensionTime" type="radio" class="h-4 w-4 text-amber-600 focus:ring-amber-500">
                        <label for="threeMonths" class="ml-3 text-sm text-gray-700">3 meses</label>
                    </div>
                    <div class="flex items-center">
                        <input id="oneYear" name="suspensionTime" type="radio" class="h-4 w-4 text-amber-600 focus:ring-amber-500">
                        <label for="oneYear" class="ml-3 text-sm text-gray-700">1 ano</label>
                    </div>
                </div>
            </div>

            <!-- Rodapé do modal -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeModal('prolongarModal')">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-amber-600 border border-transparent rounded-full shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    Prolongar Suspensão
                </button>
            </div>
        </div>
    </div>
</div>
