@extends('pages.account.account-layout')

@section('title', 'Pedidos de Contacto')

@section('account-content')
<div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-primary">Pedidos de Contacto</h1>

        <!-- Filter Controls -->
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select id="message_status" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                    <option value="all">Todos</option>
                    <option value="unread">Não lidos</option>
                    <option value="read">Lidos</option>
                    <option value="archived">Arquivados</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select id="property_filter" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                    <option value="">Todos os anúncios</option>
                    <option value="1">Moradia T4 com Piscina</option>
                    <option value="2">Apartamento T2 Moderno</option>
                    <option value="3">Moradia T5 com Jardim</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-6 relative">
        <input type="search" id="user_search" class="form-input ps-10" placeholder="Pesquisar por nome de utilizador...">
    </div>

    <!-- Messages List -->
    <div id="messages_container" class="space-y-4">
        <!-- Unread Message -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300" data-status="unread" data-property="1">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <img src="https://i.pravatar.cc/150?img=1" alt="User" class="w-12 h-12 rounded-full object-cover">
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                        <div>
                            <h3 class="font-semibold text-primary">Ana Silva</h3>
                            <span class="text-xs text-gray">ana.silva@email.com</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2 sm:mt-0">
                            <span class="text-xs text-gray">Hoje, 14:23</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-1"></span>
                                Não lido
                            </span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-secondary mb-2">Estou interessado na Moradia T4 com Piscina. Está disponível para uma visita no próximo sábado? Gostaria de saber mais detalhes sobre os acabamentos e se existe possibilidade de negociação no preço.</p>

                    <p class="text-xs text-gray mb-3">Referente ao anúncio: <span class="font-medium">Moradia T4 com Piscina</span></p>

                    <div class="flex gap-2 mt-2">
                        <button class="btn-secondary py-1.5 px-3 text-xs">
                            <i class="bi bi-check2-all mr-1"></i> Marcar como lido
                        </button>
                        <button class="btn-gray py-1.5 px-3 text-xs">
                            <i class="bi bi-archive mr-1"></i> Arquivar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Read Message -->
        <div class="bg-white border-l-4 border-gray-300 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300" data-status="read" data-property="2">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <img src="https://i.pravatar.cc/150?img=3" alt="User" class="w-12 h-12 rounded-full object-cover">
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                        <div>
                            <h3 class="font-semibold text-primary">João Costa</h3>
                            <span class="text-xs text-gray">joao.costa@email.com</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2 sm:mt-0">
                            <span class="text-xs text-gray">Ontem, 10:15</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-back text-gray-secondary">
                                Lido
                            </span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-secondary mb-2">Boa tarde. Gostaria de agendar uma visita ao Apartamento T2 Moderno para esta semana. Tem disponibilidade na quinta-feira depois das 18h?</p>

                    <p class="text-xs text-gray mb-3">Referente ao anúncio: <span class="font-medium">Apartamento T2 Moderno</span></p>

                    <div class="flex gap-2 mt-2">
                        <button class="btn-gray py-1.5 px-3 text-xs">
                            <i class="bi bi-envelope mr-1"></i> Marcar como não lido
                        </button>
                        <button class="btn-gray py-1.5 px-3 text-xs">
                            <i class="bi bi-archive mr-1"></i> Arquivar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Archived Message -->
        <div class="bg-gray-50 border-l-4 border-gray-400 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300" data-status="archived" data-property="3">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <img src="https://i.pravatar.cc/150?img=5" alt="User" class="w-12 h-12 rounded-full object-cover">
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                        <div>
                            <h3 class="font-semibold text-primary">Mariana Santos</h3>
                            <span class="text-xs text-gray">mariana.santos@email.com</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2 sm:mt-0">
                            <span class="text-xs text-gray">25/04/2023, 16:40</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-secondary">
                                <i class="bi bi-archive-fill text-xs mr-1"></i>
                                Arquivado
                            </span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-secondary mb-2">Olá! Estou muito interessada na Moradia T5 com Jardim. O preço é negociável? Quero agendar uma visita com urgência pois estou a procurar há algum tempo.</p>

                    <p class="text-xs text-gray mb-3">Referente ao anúncio: <span class="font-medium">Moradia T5 com Jardim</span></p>

                    <div class="flex gap-2 mt-2">
                        <button class="btn-gray py-1.5 px-3 text-xs">
                            <i class="bi bi-arrow-counterclockwise mr-1"></i> Restaurar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty state -->
    <div id="no_messages" class="hidden text-center py-10">
        <i class="bi bi-chat-left-dots text-gray text-5xl mb-4"></i>
        <h3 class="text-lg font-medium text-gray-secondary">Nenhuma mensagem encontrada</h3>
        <p class="text-gray mt-2">Não foram encontradas mensagens com os filtros selecionados.</p>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('message_status');
        const propertyFilter = document.getElementById('property_filter');
        const userSearch = document.getElementById('user_search');
        const messagesContainer = document.getElementById('messages_container');
        const noMessages = document.getElementById('no_messages');
        const messages = messagesContainer.querySelectorAll('[data-status]');

        // Function to filter messages
        function filterMessages() {
            const statusValue = statusFilter.value;
            const propertyValue = propertyFilter.value;
            const searchValue = userSearch.value.toLowerCase();

            let visibleCount = 0;

            messages.forEach(message => {
                const messageStatus = message.getAttribute('data-status');
                const messageProperty = message.getAttribute('data-property');
                const userName = message.querySelector('h3').textContent.toLowerCase();

                // Check if message matches all filters
                const statusMatch = statusValue === 'all' || messageStatus === statusValue;
                const propertyMatch = propertyValue === '' || messageProperty === propertyValue;
                const searchMatch = searchValue === '' || userName.includes(searchValue);

                if (statusMatch && propertyMatch && searchMatch) {
                    message.classList.remove('hidden');
                    visibleCount++;
                } else {
                    message.classList.add('hidden');
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                noMessages.classList.remove('hidden');
            } else {
                noMessages.classList.add('hidden');
            }
        }

        // Add event listeners
        statusFilter.addEventListener('change', filterMessages);
        propertyFilter.addEventListener('change', filterMessages);
        userSearch.addEventListener('input', filterMessages);

        // Handle message actions
        messagesContainer.addEventListener('click', function(e) {
            const button = e.target.closest('button');
            if (!button) return;

            const message = button.closest('[data-status]');
            if (!message) return;

            if (button.textContent.includes('Marcar como lido')) {
                message.setAttribute('data-status', 'read');
                message.classList.remove('bg-blue-50', 'border-blue-500');
                message.classList.add('bg-white', 'border-gray-300');
                const statusBadge = message.querySelector('.rounded-full');
                statusBadge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-back text-gray-800';
                statusBadge.innerHTML = 'Lido';
                button.innerHTML = '<i class="bi bi-envelope mr-1"></i> Marcar como não lido';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-gray');
            } else if (button.textContent.includes('Marcar como não lido')) {
                message.setAttribute('data-status', 'unread');
                message.classList.remove('bg-white', 'border-gray-300');
                message.classList.add('bg-blue-50', 'border-blue-500');
                const statusBadge = message.querySelector('.rounded-full');
                statusBadge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
                statusBadge.innerHTML = '<span class="w-2 h-2 bg-blue-600 rounded-full mr-1"></span> Não lido';
                button.innerHTML = '<i class="bi bi-check2-all mr-1"></i> Marcar como lido';
                button.classList.remove('btn-gray');
                button.classList.add('btn-secondary');
            } else if (button.textContent.includes('Arquivar')) {
                message.setAttribute('data-status', 'archived');
                message.classList.remove('bg-blue-50', 'border-blue-500', 'bg-white', 'border-gray-300');
                message.classList.add('bg-gray-50', 'border-gray-400');
                const statusBadge = message.querySelector('.rounded-full');
                statusBadge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-700';
                statusBadge.innerHTML = '<i class="bi bi-archive-fill text-xs mr-1"></i> Arquivado';
                const buttonContainer = button.parentElement;
                buttonContainer.innerHTML = '<button class="btn-gray py-1.5 px-3 text-xs"><i class="bi bi-arrow-counterclockwise mr-1"></i> Restaurar</button>';
            } else if (button.textContent.includes('Restaurar')) {
                message.setAttribute('data-status', 'read');
                message.classList.remove('bg-gray-50', 'border-gray-400');
                message.classList.add('bg-white', 'border-gray-300');
                const statusBadge = message.querySelector('.rounded-full');
                statusBadge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-back text-gray-800';
                statusBadge.innerHTML = 'Lido';
                const buttonContainer = button.parentElement;
                buttonContainer.innerHTML = '<button class="btn-gray py-1.5 px-3 text-xs"><i class="bi bi-envelope mr-1"></i> Marcar como não lido</button><button class="btn-gray py-1.5 px-3 text-xs"><i class="bi bi-archive mr-1"></i> Arquivar</button>';
            }

            // Re-run filters after status change
            filterMessages();
        });
    });
</script>
@endpush
@endsection
