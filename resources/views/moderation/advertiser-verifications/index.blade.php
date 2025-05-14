@extends('layout.app')

@section('title', 'Verificações de Anunciantes')

@section('content')
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">
        <!-- Back Button -->

        <div class="mt-12 animate-fade-in">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm flash-message">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm flash-message">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <h2 class="text-xl font-bold text-primary mb-4">Verificação de Anunciantes</h2>

            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
                <!-- Campo de pesquisa -->
                <div class="relative flex-grow md:max-w-xl">
                    <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="pl-4 pr-2 text-gray-400">
                            <i class="bi bi-search"></i>
                        </div>
                        <input
                            type="text"
                            id="verificationSearchInput"
                            placeholder="Pesquisar por nome ou contacto"
                            class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                        >
                        <button id="clearVerificationSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div id="verificationSearchResults" class="mt-2 text-sm text-gray-500 hidden">
                        <span id="verificationResultCount">0</span> resultados encontrados
                    </div>
                </div>
            </div>

            <!-- Filtros de estado -->
            <div class="flex flex-wrap gap-2 mb-4">
                <button
                    class="verification-filter-btn px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium"
                    data-filter="all">
                    Todos
                </button>
                <button
                    class="verification-filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
                    data-filter="pending">
                    Por Aprovar
                </button>
                <button
                    class="verification-filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
                    data-filter="approved">
                    Aprovados
                </button>
                <button
                    class="verification-filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
                    data-filter="rejected">
                    Rejeitados
                </button>
            </div>

            <!-- Tabela de verificações -->
            <div class="overflow-x-auto rounded-xl shadow bg-white">
                <table class="min-w-full text-sm">
                    <thead class="bg-blue-100 text-left">
                    <tr>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                            <div class="flex items-center">
                                ID<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="name">
                            <div class="flex items-center">
                                Nome do Anunciante<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="contact">
                            <div class="flex items-center">
                                Contacto<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="date">
                            <div class="flex items-center">
                                Data de Pedido<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="verificationTableBody">
                    @if(isset($verifications))
                        @forelse($verifications as $verification)
                            <tr class="border-t hover:bg-gray-50 transition verification-row"
                                data-id="{{ $verification->id }}"
                                data-name="{{ strtolower($verification->submitter->name ?? '') }}"
                                data-contact="{{ $verification->submitter->telephone ?? '' }}"
                                data-date="{{ $verification->submitted_at ? $verification->submitted_at->timestamp : '' }}"
                                data-state="{{ $verification->verification_advertiser_state === 0 ? 'pending' : ($verification->verification_advertiser_state === 1 ? 'approved' : 'rejected') }}">
                                <td class="p-4">#{{ $verification->id }}</td>
                                <td class="p-4 font-medium">{{ $verification->submitter->name ?? 'N/A' }}</td>
                                <td class="p-4 text-gray-600">{{ $verification->submitter->telephone ?? 'N/A' }}</td>
                                <td class="p-4 text-gray-500">
                                    {{ $verification->submitted_at ? $verification->submitted_at->format('d/m/Y - H:i') : 'N/A' }}
                                </td>
                                <td class="p-4">
                                    @php
                                        $stateClass = '';
                                        $stateText = '';
                                        if($verification->verification_advertiser_state === 0) {
                                            $stateClass = 'bg-yellow-100 text-yellow-800';
                                            $stateText = 'Por Aprovar';
                                        } elseif($verification->verification_advertiser_state === 1) {
                                            $stateClass = 'bg-green-100 text-green-800';
                                            $stateText = 'Aprovado';
                                        } else {
                                            $stateClass = 'bg-red-100 text-red-800';
                                            $stateText = 'Rejeitado';
                                        }
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $stateClass }}">
                    {{ $stateText }}
                </span>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('advertiser-verifications.show', $verification->id) }}" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t">
                                <td colspan="7" class="p-4 text-center text-gray-500">Não há verificações para mostrar</td>
                            </tr>
                        @endforelse
                    @else
                        <tr class="border-t">
                            <td colspan="7" class="p-4 text-center text-gray-500">Carregando dados de verificações...</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="p-4 pagination-container" id="verification-pagination-container">
                    @if(isset($verifications))
                        {{ $verifications->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Variáveis globais - Adicionando prefixos específicos para verificações
            const searchInput = document.getElementById('verificationSearchInput');
            const clearSearch = document.getElementById('clearVerificationSearch');
            const searchResults = document.getElementById('verificationSearchResults');
            const resultCount = document.getElementById('verificationResultCount');
            const filterButtons = document.querySelectorAll('.verification-filter-btn');

            let currentPage = 1;
            let currentFilter = 'all';
            let searchTimeout;

            // Busca com AJAX
            function searchVerifications(searchTerm = '') {

                // Mostrar indicador de carregamento
                document.getElementById('verificationTableBody').innerHTML =
                    '<tr><td colspan="7" class="p-4 text-center">Carregando...</td></tr>';

                // Limpar paginação enquanto carrega
                document.getElementById('verification-pagination-container').innerHTML = '';

                // Construir URL com parâmetros
                const url = new URL('/moderation/advertiser-verifications/ajax', window.location.origin);
                url.searchParams.append('page', currentPage);
                url.searchParams.append('filter', currentFilter);

                // Só adicionar param de busca se houver texto
                if (searchTerm) {
                    url.searchParams.append('search', searchTerm);
                }

                // Fazer requisição AJAX
                fetch(url.toString())
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na resposta do servidor: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        updateVerificationsTable(data.verifications);
                        updateVerificationPagination(data.pagination);

                        // Atualizar contador de resultados
                        if (searchTerm) {
                            searchResults.classList.remove('hidden');
                            resultCount.textContent = data.total || 0;
                        } else {
                            searchResults.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar dados:', error);
                        document.getElementById('verificationTableBody').innerHTML =
                            '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados: ' + error.message + '</td></tr>';
                    });
            }

            // Só adicione eventos se os elementos existirem na página
            if (searchInput && clearSearch) {
                searchInput.addEventListener('input', function () {
                    const searchTerm = this.value.trim();

                    // Mostrar ou ocultar botão de limpar
                    if (searchTerm.length > 0) {
                        clearSearch.classList.remove('hidden');
                    } else {
                        clearSearch.classList.add('hidden');
                    }

                    // Usar debounce para evitar muitas requisições
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        currentPage = 1; // Voltar para primeira página ao pesquisar
                        searchVerifications(searchTerm);
                    }, 500);
                });

                clearSearch.addEventListener('click', function () {
                    searchInput.value = '';
                    this.classList.add('hidden');
                    searchResults.classList.add('hidden');
                    currentPage = 1;
                    searchVerifications('');
                });

                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        currentPage = 1;
                        searchVerifications(this.value.trim());
                    }
                });
            }

            // Só adicione eventos de filtro se os botões existirem
            if (filterButtons && filterButtons.length > 0) {
                filterButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Atualizar visual dos botões
                        filterButtons.forEach(btn => {
                            btn.classList.remove('bg-blue-50', 'text-blue-600', 'border-blue-200');
                            btn.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
                        });
                        this.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
                        this.classList.add('bg-blue-50', 'text-blue-600', 'border-blue-200');

                        // Aplicar filtro
                        currentFilter = this.getAttribute('data-filter');
                        currentPage = 1;
                        searchVerifications(searchInput.value.trim());
                    });
                });
            }

            function createRow(verification) {
                // Definir classes para o badge de estado
                let stateBadgeClass = '';
                let stateText = '';

                if (verification.verification_advertiser_state === 0) {
                    stateBadgeClass = 'bg-yellow-100 text-yellow-800';
                    stateText = 'Por Aprovar';
                } else if (verification.verification_advertiser_state === 1) {
                    stateBadgeClass = 'bg-green-100 text-green-800';
                    stateText = 'Aprovado';
                } else {
                    stateBadgeClass = 'bg-red-100 text-red-800';
                    stateText = 'Rejeitado';
                }

                // Formatar data de submissão
                let formattedDate = 'N/A';
                if (verification.submitted_at) {
                    const submittedAt = new Date(verification.submitted_at);
                    formattedDate = `${submittedAt.getDate().toString().padStart(2, '0')}/${(submittedAt.getMonth() + 1).toString().padStart(2, '0')}/${submittedAt.getFullYear()} - ${submittedAt.getHours().toString().padStart(2, '0')}:${submittedAt.getMinutes().toString().padStart(2, '0')}`;
                }

                // Criar a linha da tabela
                const row = document.createElement('tr');
                row.className = 'border-t hover:bg-gray-50 transition verification-row';
                row.setAttribute('data-id', verification.id);

                // Verificação segura para acessar propriedades do submitter
                const submitterName = verification.submitter && verification.submitter.name ? verification.submitter.name : 'N/A';
                const submitterTel = verification.submitter && verification.submitter.telephone ? verification.submitter.telephone : 'N/A';

                row.setAttribute('data-name', submitterName.toLowerCase());
                row.setAttribute('data-contact', submitterTel);
                row.setAttribute('data-date', verification.submitted_at ? new Date(verification.submitted_at).getTime() : '');
                row.setAttribute('data-state', verification.verification_advertiser_state === 0 ? 'pending' : (verification.verification_advertiser_state === 1 ? 'approved' : 'rejected'));

                row.innerHTML = `
                    <td class="p-4">#${verification.id}</td>
                    <td class="p-4 font-medium">${submitterName}</td>
                    <td class="p-4 text-gray-600">${submitterTel}</td>
                    <td class="p-4 text-gray-500">${formattedDate}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${stateBadgeClass}">
                            ${stateText}
                        </span>
                    </td>
                    <td class="p-4">
                        <a href="/moderation/advertiser-verifications/${verification.id}" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a>
                    </td>
                    `;

                return row;
            }

            function updateVerificationsTable(verifications) {
                const tableBody = document.getElementById('verificationTableBody');
                if (!tableBody) return;

                tableBody.innerHTML = '';

                if (!verifications || verifications.length === 0) {
                    tableBody.innerHTML = '<tr class="border-t"><td colspan="7" class="p-4 text-center text-gray-500">Não há verificações para mostrar</td></tr>';
                    return;
                }

                verifications.forEach(verification => {
                    tableBody.appendChild(createRow(verification));
                });
            }

            function updateVerificationPagination(paginationHtml) {
                const paginationContainer = document.getElementById('verification-pagination-container');
                if (!paginationContainer) return;

                paginationContainer.innerHTML = paginationHtml;

                // Adicionar event listeners aos links da paginação
                const paginationLinks = paginationContainer.querySelectorAll('a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const href = this.getAttribute('href');
                        const url = new URL(href, window.location.origin);
                        currentPage = url.searchParams.get('page') || 1;

                        searchVerifications(searchInput.value.trim());
                    });
                });
            }

            // Iniciar a busca quando a página carrega se estamos na página correta
            if (document.getElementById('verificationTableBody')) {
                searchVerifications();
            }

            // Auto-esconder mensagens flash após alguns segundos
            const flashMessages = document.querySelectorAll('.flash-message');
            if (flashMessages.length > 0) {
                setTimeout(() => {
                    flashMessages.forEach(msg => {
                        msg.style.transition = 'opacity 0.5s ease';
                        msg.style.opacity = '0';
                        setTimeout(() => msg.remove(), 500);
                    });
                }, 5000);
            }

            function showNotification(message) {
                // Create a container for notifications if it doesn't exist
                let notificationContainer = document.getElementById('notification-container');
                if (!notificationContainer) {
                    notificationContainer = document.createElement('div');
                    notificationContainer.id = 'notification-container';
                    notificationContainer.style.position = 'fixed';
                    notificationContainer.style.bottom = '20px';
                    notificationContainer.style.right = '20px';
                    notificationContainer.style.zIndex = '9999';
                    notificationContainer.style.display = 'flex';
                    notificationContainer.style.flexDirection = 'column';
                    notificationContainer.style.gap = '10px';
                    document.body.appendChild(notificationContainer);
                }

                // Create the notification element
                const notification = document.createElement('div');
                notification.className = 'bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow-sm';
                notification.style.minWidth = '250px';
                notification.style.opacity = '1';
                notification.style.transition = 'opacity 0.5s ease';
                notification.innerHTML = `<p>${message}</p>`;

                // Add the notification to the container
                notificationContainer.appendChild(notification);

                // Play notification sound
                const audio = new Audio('/sounds/notification.mp3');
                audio.play().catch((e) => {
                    console.warn('Sound not allowed yet by browser.');
                });

                // Auto-hide the notification after 5 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 500);
                }, 5000);
            }

            function addToTable(verification) {
                const tableBody = document.getElementById('verificationTableBody');
                if (!tableBody) return;
                tableBody.insertAdjacentElement('afterbegin', createRow(verification));
                showNotification('Pedido de verificação recebido.');
            }

            // Broadcast listener para novas verificações
            Echo.private('advertiser_verifications')
                .listen('.verification.created', (e) => {
                    console.log("New verification request: " + e.verification);
                    addToTable(e.verification);
                });
        });
    </script>
@endpush
