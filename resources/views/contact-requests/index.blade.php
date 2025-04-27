@extends('account.account-layout')

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
                    <select id="ad_filter" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                        <option value="">Todos os anúncios</option>
                        @foreach ($ads as $ad)
                            <option value="{{ $ad->id }}">{{ $ad->title }}</option>
                        @endforeach
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
            @forelse ($messages as $message)
                @include('contact-requests.message', [
                    'name' => $message->name,
                    'email' => $message->email,
                    'telephone' => $message->telephone,
                    'status' => $message->state,
                    'time' => $message->created_at->format('d/m/Y, H:i'),
                    'message' => $message->message,
                    'title' => $message->advertisement->title ?? 'N/A',
                    'id' => $message->advertisement->id ?? 'N/A',
                    'messageId' => $message->id,
                ])
                @empty
                <div class="text-center py-10">
                    <i class="bi bi-chat-left-dots text-gray text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-secondary">Sem pedidos de contacto</h3>
                    <p class="text-gray mt-2">Ainda não recebeu nenhum pedido de contacto.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $messages->links('vendor.pagination.tailwind') }}
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
            document.addEventListener('DOMContentLoaded', function () {
                const statusFilter = document.getElementById('message_status');
                const adFilter = document.getElementById('ad_filter');
                const userSearch = document.getElementById('user_search');
                const messagesContainer = document.getElementById('messages_container');
                const noMessages = document.getElementById('no_messages');
                const messages = messagesContainer.querySelectorAll('[data-status]');

                function filterMessages() {
                    const statusValue = statusFilter.value;
                    const propertyValue = adFilter.value;
                    const searchValue = userSearch.value.toLowerCase();
                    let visibleCount = 0;

                    messages.forEach(message => {
                        const messageStatus = message.getAttribute('data-status');
                        const messageProperty = message.getAttribute('data-property');
                        const userName = message.querySelector('h3').textContent.toLowerCase();
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

                    noMessages.classList.toggle('hidden', visibleCount !== 0 || messages.length === 0);
                }

                statusFilter.addEventListener('change', filterMessages);
                adFilter.addEventListener('change', filterMessages);
                userSearch.addEventListener('input', filterMessages);

                async function updateRequestStatus(requestId, newStatus) {
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const response = await fetch(`/contact-requests/${requestId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ state: newStatus })
                        });

                        if (!response.ok) {
                            throw new Error('Failed to update status');
                        }
                        return await response.json();
                    } catch (error) {
                        console.error('Error updating status:', error);
                        return null;
                    }
                }

                messagesContainer.addEventListener('click', async function (e) {
                    const button = e.target.closest('.status-action-btn');
                    if (!button) return;

                    const message = button.closest('[data-status]');
                    if (!message) return;

                    const requestId = message.getAttribute('data-id');
                    const action = button.getAttribute('data-action');
                    if (!requestId || !action) return;

                    const statusBadge = message.querySelector('.status-badge');
                    const buttonsContainer = message.querySelector('.buttons-container');

                    button.disabled = true;
                    button.classList.add('opacity-60');

                    let newStatus = '';
                    switch (action) {
                        case 'mark-read':
                            newStatus = 'read';
                            break;
                        case 'mark-unread':
                            newStatus = 'unread';
                            break;
                        case 'archive':
                            newStatus = 'archived';
                            break;
                        case 'restore':
                            newStatus = 'unread';
                            break;
                        default:
                            button.disabled = false;
                            button.classList.remove('opacity-60');
                            return;
                    }

                    const result = await updateRequestStatus(requestId, newStatus);
                    if (!result) {
                        button.disabled = false;
                        button.classList.remove('opacity-60');
                        return;
                    }

                    message.setAttribute('data-status', newStatus);

                    if (statusBadge) {
                        if (newStatus === 'read') {
                            statusBadge.textContent = 'Lido';
                            statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                        } else if (newStatus === 'unread') {
                            statusBadge.textContent = 'Não lido';
                            statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
                        } else if (newStatus === 'archived') {
                            statusBadge.textContent = 'Arquivado';
                            statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-300 text-gray-700';
                        }
                    }

                    if (buttonsContainer) {
                        if (newStatus === 'read') {
                            buttonsContainer.innerHTML = `
                    <button class="btn-primary py-1.5 px-3 text-xs status-action-btn" data-action="mark-unread">
                        <i class="bi bi-envelope mr-1"></i> Marcar como não lido
                    </button>
                    <button class="btn-gray py-1.5 px-3 text-xs status-action-btn" data-action="archive">
                        <i class="bi bi-archive mr-1"></i> Arquivar
                    </button>
                `;
                        } else if (newStatus === 'unread') {
                            buttonsContainer.innerHTML = `
                    <button class="btn-secondary py-1.5 px-3 text-xs status-action-btn" data-action="mark-read">
                        <i class="bi bi-check2-all mr-1"></i> Marcar como lido
                    </button>
                    <button class="btn-gray py-1.5 px-3 text-xs status-action-btn" data-action="archive">
                        <i class="bi bi-archive mr-1"></i> Arquivar
                    </button>
                `;
                        } else if (newStatus === 'archived') {
                            buttonsContainer.innerHTML = `
                    <button class="btn-gray py-1.5 px-3 text-xs status-action-btn" data-action="restore">
                        <i class="bi bi-arrow-counterclockwise mr-1"></i> Restaurar
                    </button>
                `;
                        }
                    }

                    filterMessages();
                });
            });
        </script>
    @endpush
@endsection
