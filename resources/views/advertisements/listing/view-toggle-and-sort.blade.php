<div class="flex justify-between items-center mb-6">
    <!-- Botões de visualização -->
    <div class="flex space-x-2">
        <button @click="updateView('grid'); $event.preventDefault()"
                :class="view === 'grid' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-grid text-xl"
               :class="view === 'grid' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
        <button @click="updateView('list'); $event.preventDefault()"
                :class="view === 'list' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-list text-2xl"
               :class="view === 'list' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
    </div>

    <!-- Select de ordenação -->
    <div class="flex items-center">
        <label for="sort" class="text-sm text-gray-600 mr-2">Ordenar Por:</label>
        <div class="relative dropdown-wrapper">
            <select id="sort"
                    class="w-full pl-4 pr-10 py-2 dropdown-select"
                    x-on:change="updateSort($event)">
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Mais Recentes</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Preço: Mais baixo</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preço: Mais alto</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para atualizar a ordenação mantendo os filtros
    function updateSort(event) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', event.target.value);
        url.searchParams.delete('page'); // Resetar para primeira página

        window.location.href = url.toString();
    }

    // Inicialização do Alpine.js
    document.addEventListener('alpine:init', () => {
        Alpine.data('page', () => ({
            view: 'grid',
            favorites: new Set(),

            init() {
                const urlParams = new URLSearchParams(window.location.search);
                const viewParam = urlParams.get('view');
                const savedView = localStorage.getItem('adsView');

                if (!viewParam && savedView) {
                    urlParams.set('view', savedView);
                    urlParams.delete('page');
                    window.location.search = urlParams.toString();
                    return;
                }

                if (viewParam) {
                    localStorage.setItem('adsView', viewParam);
                }

                this.initializeFavorites();
                this.$nextTick(() => {
                    this.initializeEventListeners();
                });
            },

            initializeFavorites() {
                // Coletar todos os favoritos na página
                document.querySelectorAll('.favorite-btn').forEach(button => {
                    const adId = button.dataset.adId;
                    const isFavorite = button.classList.contains('text-red-500');

                    if (isFavorite) {
                        this.favorites.add(adId);
                    }
                });
            },

            updateView(newView) {
                this.view = newView;
                localStorage.setItem('adsView', newView);

                // Atualizar a URL com o parâmetro ?view=
                const url = new URL(window.location.href);
                url.searchParams.set('view', newView); // ← novo
                url.searchParams.delete('page');       // resetar para primeira página
                window.location.href = url.toString(); // ← recarrega a página com novo view
            },

            syncFavoritesState() {
                // Sincronizar o estado visual dos botões com o conjunto de favoritos
                document.querySelectorAll('.favorite-btn').forEach(button => {
                    const adId = button.dataset.adId;
                    const isFavorite = this.favorites.has(adId);
                    const heartIcon = button.querySelector('i');

                    if (isFavorite) {
                        button.classList.remove('text-gray-500');
                        button.classList.add('text-red-500');
                        if (heartIcon) {
                            heartIcon.classList.remove('bi-heart');
                            heartIcon.classList.add('bi-heart-fill');
                        }
                    } else {
                        button.classList.remove('text-red-500');
                        button.classList.add('text-gray-500');
                        if (heartIcon) {
                            heartIcon.classList.remove('bi-heart-fill');
                            heartIcon.classList.add('bi-heart');
                        }
                    }
                });
            },

            initializeEventListeners() {
                this.initializeFavoriteButtons();
                this.initializePhoneButtons();
            },

            initializeFavoriteButtons() {
                document.querySelectorAll('.favorite-btn').forEach(button => {
                    // Remover event listeners antigos
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);

                    // Adicionar novo event listener
                    newButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();

                        @auth
                        const adId = newButton.dataset.adId;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const heartIcon = newButton.querySelector('i');

                        if (newButton.dataset.loading === 'true') return;
                        newButton.dataset.loading = 'true';

                        fetch(`/advertisements/${adId}/favorite`, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                                if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                                if (data.success && heartIcon) {
                                    if (data.isFavorite) {
                                        heartIcon.classList.replace('bi-heart', 'bi-heart-fill');
                                        newButton.classList.remove('text-gray-500');
                                        newButton.classList.add('text-red-500');
                                        this.favorites.add(adId);
                                    } else {
                                        heartIcon.classList.replace('bi-heart-fill', 'bi-heart');
                                        newButton.classList.remove('text-red-500');
                                        newButton.classList.add('text-gray-500');
                                        this.favorites.delete(adId);
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao atualizar favorito:', error);
                            })
                            .finally(() => {
                                newButton.dataset.loading = 'false';
                            });
                        @else
                            window.location.href = "{{ route('login') }}?redirect={{ url()->current() }}";
                        @endauth
                    });
                });
            },

            initializePhoneButtons() {
                document.querySelectorAll('.phone-button').forEach(button => {
                    // Remover event listeners antigos
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);

                    // Adicionar novo event listener
                    newButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const advertiserId = this.dataset.advertiserId;

                        if (this.dataset.loading === 'true') return;

                        if (this.textContent.trim() === 'Ver Telefone') {
                            // Mostrar ícone de loading
                            this.dataset.originalText = this.innerHTML;
                            this.dataset.loading = 'true';
                            this.innerHTML = `<span class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                A carregar...
                              </span>`;

                            // Fetch phone number
                            fetch(`/advertiser/${advertiserId}/phone`, {
                                method: 'GET',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    const phone = data.telephone || 'Número não disponível';
                                    this.dataset.loading = 'false';
                                    this.innerHTML = phone;
                                    this.classList.add('text-blue-600', 'font-bold');
                                    this.title = "Clique para copiar";
                                })
                                .catch(error => {
                                    console.error('Error fetching phone number:', error);
                                    this.dataset.loading = 'false';
                                    this.innerHTML = 'Erro';
                                    this.classList.add('text-red-500');
                                });
                        } else {
                            // Copiar para clipboard
                            navigator.clipboard.writeText(this.textContent.trim()).then(() => {
                                const originalPhone = this.textContent.trim();
                                this.textContent = "Copiado!";
                                this.classList.add('text-green-500');

                                setTimeout(() => {
                                    this.textContent = originalPhone;
                                    this.classList.remove('text-green-500');
                                }, 1500);
                            });
                        }
                    });
                });
            }
        }));
    });
</script>
