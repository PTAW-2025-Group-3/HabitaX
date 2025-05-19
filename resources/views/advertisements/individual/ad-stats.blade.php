<!-- Estatísticas do Anúncio - Visível apenas para o criador -->
@if(auth()->check() && auth()->id() === $ad->created_by && $ad->is_published)
    <div class="bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-8 space-y-5 animate-fade-in">
        <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
            <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center gap-2">
                <i class="bi bi-bar-chart-line text-secondary text-2xl"></i>
                Estatísticas do Anúncio
            </h3>
            <span class="bg-indigo-100 text-secondary text-xs md:text-sm font-semibold px-3 py-1 rounded-full shadow-sm">Atualizado</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Número de favoritos -->
            <div class="bg-gradient-to-r from-rose-50 to-red-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-14 w-14 flex items-center justify-center bg-white text-rose-500 rounded-xl mr-4 shadow-sm">
                        <i class="bi bi-heart-fill text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-rose-700 font-medium">Total de Favoritos</p>
                        <p class="text-3xl font-bold text-rose-900">{{ $ad->favorites_count ?? 0 }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <button id="viewFavoritesBtn" class="text-xs text-rose-600 font-medium bg-white px-2 py-1 rounded shadow-sm hover:bg-rose-50 transition-colors">
                                <i class="bi bi-people"></i>
                                <span>Ver interessados</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Número de pedidos de contato -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-14 w-14 flex items-center justify-center bg-white text-emerald-500 rounded-xl mr-4 shadow-sm">
                        <i class="bi bi-chat-text-fill text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-emerald-700 font-medium">Pedidos de Contacto</p>
                        <p class="text-3xl font-bold text-emerald-900">{{ $ad->requests_count ?? 0 }}</p>
                        <p class="text-xs text-emerald-600 mt-1">
                            <i class="bi bi-envelope"></i>
                            <span>Mensagens recebidas</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
