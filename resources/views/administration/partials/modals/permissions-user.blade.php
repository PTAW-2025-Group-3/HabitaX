<div id="permissionsModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black opacity-50" id="permissionsModalOverlay"></div>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg z-10 mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Permissões do Utilizador</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" id="closePermissionsModal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-gray-700 mb-4">Definir permissões para <strong id="permissionsUserName"></strong></p>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                        <div>
                            <h4 class="font-medium">Utilizador</h4>
                            <p class="text-sm text-gray-500">Acesso básico à plataforma</p>
                        </div>
                        <div class="flex-shrink-0">
                            <input type="radio" name="userRole" value="user" class="h-5 w-5 text-blue-600" checked>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                        <div>
                            <h4 class="font-medium">Moderador</h4>
                            <p class="text-sm text-gray-500">Pode moderar anúncios e denúncias</p>
                        </div>
                        <div class="flex-shrink-0">
                            <input type="radio" name="userRole" value="moderator" class="h-5 w-5 text-blue-600">
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                        <div>
                            <h4 class="font-medium">Administrador</h4>
                            <p class="text-sm text-gray-500">Acesso completo ao sistema</p>
                        </div>
                        <div class="flex-shrink-0">
                            <input type="radio" name="userRole" value="admin" class="h-5 w-5 text-blue-600">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 text-sm btn-secondary" id="cancelPermissionsBtn">Cancelar</button>
                <button type="button" class="px-4 py-2 text-sm btn-primary" id="savePermissionsBtn">Guardar Alterações</button>
            </div>
        </div>
    </div>
</div>
