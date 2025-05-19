<!-- Modal de visualização de favoritos - Apenas para o criador do anúncio -->
<div id="favorites-modal" hidden class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl max-h-[80vh] flex flex-col">
        <!-- Cabeçalho do modal -->
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-heart-fill text-rose-500"></i>
                Utilizadores interessados
            </h3>
            <button id="closeFavoritesModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <!-- Conteúdo do modal -->
        <div class="p-6 overflow-y-auto flex-grow">
            @if($ad->favorites_count > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($ad->favorites as $favorite)
                        <div class="border border-gray-100 rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-full bg-gray-200 overflow-hidden flex-shrink-0 border-2 border-white shadow-sm">
                                    <img src="{{ $favorite->user->getProfilePictureUrl() }}" alt="Foto de {{ $favorite->user->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800">{{ $favorite->user->name }}</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @if($favorite->user->email)
                                            <a href="mailto:{{ $favorite->user->email }}" class="group flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-violet-50 to-purple-50 hover:from-violet-100 hover:to-purple-100 border border-purple-100 text-purple-700 rounded-lg transition-all shadow-sm hover:shadow">
                                                <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                                    <i class="bi bi-envelope-fill text-purple-500 text-xs"></i>
                                                </div>
                                                <span class="text-sm font-medium">{{ $favorite->user->email }}</span>
                                            </a>
                                        @endif
                                        @if($favorite->user->telephone)
                                            <a href="tel:{{ $favorite->user->telephone }}" class="group flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-indigo-50 to-blue-50 hover:from-indigo-100 hover:to-blue-100 border border-indigo-100 text-indigo-700 rounded-lg transition-all shadow-sm hover:shadow">
                                                <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                                    <i class="bi bi-telephone-fill text-indigo-500 text-xs"></i>
                                                </div>
                                                <span class="text-sm font-medium">{{ $favorite->user->telephone }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right text-xs text-gray-500">
                                    <p>Adicionado em:</p>
                                    <p class="font-medium">{{ $favorite->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="h-20 w-20 text-gray-300 mb-4">
                        <i class="bi bi-heart text-5xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Nenhum utilizador adicionou este anúncio aos favoritos.</p>
                    <p class="text-gray-400 text-sm mt-2">Quando alguém adicionar, os detalhes aparecerão aqui.</p>
                </div>
            @endif
        </div>

        <!-- Rodapé do modal -->
        <div class="p-6 border-t border-gray-200 flex justify-between items-center bg-gray-50">
            <p class="text-sm text-gray-500">
                <i class="bi bi-info-circle"></i>
                <span>Total: {{ $ad->favorites_count }} utilizador(es) interessado(s)</span>
            </p>
        </div>
    </div>
</div>
<!-- Scripts para o modal de favoritos -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal de favoritos
            const favoritesModal = document.getElementById('favorites-modal');
            const viewFavoritesBtn = document.getElementById('viewFavoritesBtn');
            const closeFavoritesModal = document.getElementById('closeFavoritesModal');
            const closeFavoritesModalBtn = document.getElementById('closeFavoritesModalBtn');

            // Função para abrir o modal de favoritos
            function openFavoritesModal() {
                if (favoritesModal) {
                    favoritesModal.style.display = 'flex';
                    favoritesModal.classList.add('modal-visible');
                }
            }

            // Função para fechar o modal de favoritos
            function closeFavoritesModalFunction() {
                if (favoritesModal) {
                    favoritesModal.style.display = 'none';
                    favoritesModal.classList.remove('modal-visible');
                }
            }

            // Adicionar event listeners
            if (viewFavoritesBtn) {
                viewFavoritesBtn.addEventListener('click', function() {
                    openFavoritesModal();
                });
            }

            if (closeFavoritesModal) {
                closeFavoritesModal.addEventListener('click', function() {
                    closeFavoritesModalFunction();
                });
            }

            if (closeFavoritesModalBtn) {
                closeFavoritesModalBtn.addEventListener('click', function() {
                    closeFavoritesModalFunction();
                });
            }

            // Fechar modal ao clicar fora
            if (favoritesModal) {
                favoritesModal.addEventListener('click', function(e) {
                    if (e.target === favoritesModal || e.target.classList.contains('modal-overlay')) {
                        closeFavoritesModalFunction();
                    }
                });
            }

            // Fechar modal com tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && favoritesModal && !favoritesModal.classList.contains('hidden')) {
                    closeFavoritesModalFunction();
                }
            });
        });
    </script>
@endpush
