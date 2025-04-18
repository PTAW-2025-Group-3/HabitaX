<div id="suspendUserModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black opacity-50" id="suspendUserModalOverlay"></div>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="suspendModalTitle">Suspender Utilizador</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" id="closeSuspendModal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="mb-6" id="suspendModalContent">
                <p class="text-gray-700 mb-4">Tem certeza que deseja <span id="suspendActionText">suspender</span> o utilizador <strong id="suspendUserName"></strong>?</p>

                <div id="suspendDescription">
                    <p class="text-gray-500 text-sm mb-2">Ao suspender um utilizador:</p>
                    <ul class="list-disc text-sm text-gray-500 pl-5 mb-4">
                        <li>O utilizador não poderá fazer login</li>
                        <li>Seus anúncios não serão exibidos</li>
                        <li>Não poderá publicar novos anúncios</li>
                    </ul>
                </div>

                <div id="reactivateDescription" class="hidden">
                    <p class="text-gray-500 text-sm mb-2">Ao reativar um utilizador:</p>
                    <ul class="list-disc text-sm text-gray-500 pl-5 mb-4">
                        <li>O utilizador poderá fazer login novamente</li>
                        <li>Seus anúncios voltarão a ser exibidos</li>
                        <li>Poderá publicar novos anúncios</li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 text-sm btn-secondary" id="cancelSuspendBtn">Cancelar</button>
                <button type="button" class="px-4 py-2 text-sm btn-primary" id="confirmSuspendBtn">
                    <span id="suspendBtnText">Suspender</span>
                </button>
            </div>
        </div>
    </div>
</div>
