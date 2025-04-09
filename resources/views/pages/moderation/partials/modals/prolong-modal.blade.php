<div id="prolongarModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <!-- Background overlay com blur -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"></div>

    <div class="flex items-center justify-center min-h-screen px-4 relative">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <!-- Cabeçalho com ícone -->
            <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-gray-100">
                <div class="flex items-center">
                    <i class="bi bi-clock-history text-red-500 me-2" style="font-size: 1.5rem;"></i>
                    <h2 class="text-lg font-semibold text-gray-900">Prolongar Suspensão</h2>
                </div>
                <button class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeModal('prolongarModal')">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Corpo do modal -->
            <div class="px-6 py-4">
                <p class="text-sm text-gray mb-4">Por quanto tempo deseja prolongar a suspensão deste utilizador?</p>

                <div class="space-y-3 mt-3">
                    <div class="flex items-center">
                        <input id="oneWeek" name="suspensionTime" type="radio" class="h-4 w-4 text-red-700 focus:ring-red-500">
                        <label for="oneWeek" class="ms-3 text-sm text-gray">1 semana</label>
                    </div>
                    <div class="flex items-center">
                        <input id="oneMonth" name="suspensionTime" type="radio" class="h-4 w-4 text-red-700 focus:ring-red-500" checked>
                        <label for="oneMonth" class="ms-3 text-sm text-gray">1 mês</label>
                    </div>
                    <div class="flex items-center">
                        <input id="threeMonths" name="suspensionTime" type="radio" class="h-4 w-4 text-red-700 focus:ring-red-500">
                        <label for="threeMonths" class="ms-3 text-sm text-gray">3 meses</label>
                    </div>
                    <div class="flex items-center">
                        <input id="oneYear" name="suspensionTime" type="radio" class="h-4 w-4 text-red-700 focus:ring-red-500">
                        <label for="oneYear" class="ms-3 text-sm text-gray">1 ano</label>
                    </div>
                </div>
            </div>

            <!-- Rodapé do modal -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeModal('prolongarModal')">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    Prolongar Suspensão
                </button>
            </div>
        </div>
    </div>
</div>
