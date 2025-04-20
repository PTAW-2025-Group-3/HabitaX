<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Confirmar Eliminação</h3>
            <button type="button" onclick="hideDeleteModal()" class="text-gray-400 hover:text-gray-600">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="mb-6">
            <p class="text-gray-600 mb-2">Tem certeza que deseja eliminar o {{ $itemType ?? 'item' }}:</p>
            <p class="font-bold text-primary" id="itemName"></p>
        </div>
        <div class="flex justify-end space-x-3">
            <button type="button" onclick="hideDeleteModal()"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                Cancelar
            </button>
            <form id="deleteForm" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-warning px-4 py-2 rounded-lg">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function showDeleteModal(id, name) {
            document.getElementById('itemName').textContent = name;
            document.getElementById('deleteForm').action = "{{ $routeName ?? 'attributes.destroy' }}".replace('__ID__', id);
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.remove('flex');
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endpush
