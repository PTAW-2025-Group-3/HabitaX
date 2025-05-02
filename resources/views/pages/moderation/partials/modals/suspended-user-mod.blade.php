<div id="suspendUserModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black opacity-50" id="suspendUserModalOverlay"></div>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="suspendModalTitle">Gerenciar Estado do Utilizador</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" id="closeSuspendModal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="mb-6" id="suspendModalContent">
                <p class="text-gray-700 mb-4">Tem certeza que deseja alterar o estado do utilizador <strong id="suspendUserName"></strong>?</p>

                <div class="mb-4">
                    <label for="stateSelect" class="block text-sm font-medium text-gray-700 mb-1">Estado:</label>
                    <select id="stateSelect" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="active">Ativo</option>
                        <option value="suspended">Suspenso</option>
                        <option value="banned">Banido</option>
                        <option value="archived">Arquivado</option>
                    </select>
                </div>

                <div>
                    <p class="text-gray-500 text-sm mb-2">Informações sobre os estados:</p>
                    <ul class="list-disc text-sm text-gray-500 pl-5 mb-4">
                        <li><strong>Ativo:</strong> Acesso total à plataforma</li>
                        <li><strong>Suspenso:</strong> Acesso temporariamente bloqueado</li>
                        <li><strong>Banido:</strong> Acesso permanentemente bloqueado</li>
                        <li><strong>Arquivado:</strong> Conta inativa, mantida para referência</li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 text-sm btn-secondary" id="cancelSuspendBtn">Cancelar</button>
                <button type="button" class="px-4 py-2 text-sm btn-primary" id="confirmSuspendBtn">Atualizar Estado</button>
            </div>
        </div>
    </div>
</div>
