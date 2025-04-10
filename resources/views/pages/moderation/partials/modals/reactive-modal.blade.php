<div id="reativarModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <!-- Background overlay com blur -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"></div>

    <div class="flex items-center justify-center min-h-screen px-4 relative">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <!-- Cabeçalho com ícone -->
            <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-gray-100">
                <div class="flex items-center">
                    <i class="bi bi-check-circle text-emerald-500 me-2" style="font-size: 1.5rem;"></i>
                    <h2 class="text-lg font-semibold text-gray-900">Reativar Utilizador</h2>
                </div>
                <button class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeModal('reativarModal')">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Corpo do modal -->
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600">Tem a certeza que quer reativar este utilizador? Esta ação permitirá que o utilizador volte a ter acesso normal à plataforma.</p>
            </div>

            <!-- Rodapé do modal -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeModal('reativarModal')">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-full shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    Confirmar Reativação
                </button>
            </div>
        </div>
    </div>
</div>
