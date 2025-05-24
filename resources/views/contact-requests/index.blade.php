@extends('account.account-layout')

@section('title', 'Pedidos de Contacto')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
            <h1 class="text-2xl font-bold text-primary">
                @if(!$isAdvertiser)
                    Meus Pedidos de Contacto
                @else
                    Pedidos de Contacto
                @endif
            </h1>

            <!-- Request Type Selector - only for advertisers -->
            @if($isAdvertiser)
                <div class="flex rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                    <a href="{{ route('contact-requests.index', ['type' => 'received']) }}"
                       class="px-4 py-2 text-sm font-medium {{ $requestType === 'received' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        Pedidos Recebidos
                    </a>
                    <a href="{{ route('contact-requests.index', ['type' => 'sent']) }}"
                       class="px-4 py-2 text-sm font-medium {{ $requestType === 'sent' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        Pedidos Enviados
                    </a>
                </div>
            @endif

            <!-- Search bar - only show for received requests -->
            <div class="relative w-full md:w-64 {{ $requestType !== 'received' ? 'invisible' : '' }}">
                <input type="search" id="user_search" class="form-input ps-10 w-full" placeholder="Pesquisar por nome...">
            </div>
        </div>

        <!-- Filter Controls - Always show some filters with conditionals for each type -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <div class="flex items-center mb-2">
                <i class="bi bi-funnel mr-2 text-gray-500"></i>
                <h3 class="text-sm font-medium text-gray-700">Filtros</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Status Filter - Always show -->
                <div class="relative">
                    <label for="message_status" class="block text-xs font-medium text-gray-500 mb-1">Estado</label>
                    <div class="relative dropdown-wrapper">
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
                </div>

                <!-- Ad Filter - Always show -->
                <div class="relative">
                    <label for="ad_filter" class="block text-xs font-medium text-gray-500 mb-1">Anúncio</label>
                    <div class="relative dropdown-wrapper">
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

                <!-- User Type Filter - Only for received requests -->
                @if($requestType === 'received')
                    <div class="relative">
                        <label for="user_type_filter" class="block text-xs font-medium text-gray-500 mb-1">Tipo de utilizador</label>
                        <div class="relative dropdown-wrapper">
                            <select id="user_type_filter" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                                <option value="all">Todos os utilizadores</option>
                                <option value="registered">Utilizadores registados</option>
                                <option value="guest">Utilizadores não registados</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Messages List -->
        <div id="messages_container" class="space-y-4">
            @forelse ($messages as $message)
                @if($requestType === 'received')
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
                        'created_by' => $message->created_by,
                        'profile_picture' => $message->created_by ? ($message->user->getProfilePictureUrl() ?? asset('images/default-avatar.png')) : asset('images/default-avatar.png'),
                        'user' => $message->created_by ? $message->user : null,
                        'show_email' => $message->created_by && $message->user ? $message->user->show_email : true,
                        'show_telephone' => $message->created_by && $message->user ? $message->user->show_telephone : true,
                        'isReadOnly' => false
                    ])
                @else
                    @php
                        $adOwner = \App\Models\User::find($message->advertisement->created_by ?? null);
                    @endphp
                    @include('contact-requests.message', [
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'telephone' => auth()->user()->telephone ?? null,
                        'profile_picture' => auth()->user()->getProfilePictureUrl(),
                        'status' => $message->state,
                        'time' => $message->created_at->format('d/m/Y, H:i'),
                        'message' => $message->message,
                        'title' => $message->advertisement->title ?? 'N/A',
                        'id' => $message->advertisement->id ?? 'N/A',
                        'messageId' => $message->id,
                        'created_by' => auth()->id(),
                        'recipient_name' => $adOwner->name ?? 'N/A',
                        'recipient_email' => $adOwner->email ?? 'N/A',
                        'recipient_telephone' => $adOwner->telephone ?? null,
                        'recipient_profile_picture' => $adOwner->getProfilePictureUrl(),
                        'isReadOnly' => true,
                        'show_email' => $message->created_by && $message->user ? $message->user->show_email : true,
                        'show_telephone' => $message->created_by && $message->user ? $message->user->show_telephone : true,
                    ])
                @endif
            @empty
                <div class="text-center py-10">
                    <i class="bi bi-chat-left-dots text-gray text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-secondary">
                        @if($isAdvertiser && $requestType === 'received')
                            Sem pedidos de contacto recebidos
                        @else
                            Sem pedidos de contacto enviados
                        @endif
                    </h3>
                    <p class="text-gray mt-2">
                        @if($isAdvertiser && $requestType === 'received')
                            Ainda não recebeu nenhum pedido de contacto.
                        @else
                            Ainda não enviou nenhum pedido de contacto.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $messages->appends(['type' => $requestType])->links('vendor.pagination.tailwind') }}
        </div>

        <!-- Empty state -->
        <div id="no_messages" class="hidden text-center py-10">
            <i class="bi bi-chat-left-dots text-gray text-5xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-secondary">Nenhuma mensagem encontrada</h3>
            <p class="text-gray mt-2">Não foram encontradas mensagens com os filtros selecionados.</p>
        </div>
    </div>
    @push('scripts')
        <!-- JavaScript remains mostly the same, just need to handle read-only state -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const statusFilter = document.getElementById('message_status');
                const adFilter = document.getElementById('ad_filter');
                const userTypeFilter = document.getElementById('user_type_filter');
                const userSearch = document.getElementById('user_search');
                const messagesContainer = document.getElementById('messages_container');
                const noMessages = document.getElementById('no_messages');
                const messages = messagesContainer.querySelectorAll('[data-status]');

                const requestType = '{{ $requestType }}';
                const isAdvertiser = {{ $isAdvertiser ? 'true' : 'false' }};

                function filterMessages() {
                    const statusValue = statusFilter ? statusFilter.value : 'all';
                    const propertyValue = adFilter ? adFilter.value : '';
                    const userTypeValue = userTypeFilter ? userTypeFilter.value : 'all';
                    const searchValue = userSearch ? userSearch.value.toLowerCase() : '';
                    let visibleCount = 0;

                    messages.forEach(message => {
                        const messageStatus = message.getAttribute('data-status');
                        const messageProperty = message.getAttribute('data-property');
                        const messageUserType = message.getAttribute('data-user-type');

                        // Only get user name if search input exists and has a value
                        const userName = searchValue && message.querySelector('h3') ?
                            message.querySelector('h3').textContent.toLowerCase() : '';

                        const statusMatch = statusValue === 'all' || messageStatus === statusValue;
                        const propertyMatch = propertyValue === '' || messageProperty === propertyValue;
                        const userTypeMatch = userTypeValue === 'all' || messageUserType === userTypeValue;
                        const searchMatch = !searchValue || userName.includes(searchValue);

                        if (statusMatch && propertyMatch && userTypeMatch && searchMatch) {
                            message.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            message.classList.add('hidden');
                        }
                    });

                    noMessages.classList.toggle('hidden', visibleCount !== 0 || messages.length === 0);
                }

                if (statusFilter) statusFilter.addEventListener('change', filterMessages);
                if (adFilter) adFilter.addEventListener('change', filterMessages);
                if (userTypeFilter) userTypeFilter.addEventListener('change', filterMessages);
                if (userSearch) userSearch.addEventListener('input', filterMessages);

                // Only allow status updates for received messages
                if (isAdvertiser && requestType === 'received') {
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

                        // Inside the messagesContainer event listener, after updating the status badge
                        if (result) {
                            // Update the card's appearance based on new status
                            if (newStatus === 'read') {
                                message.className = message.className
                                    .replace(/bg-blue-50|bg-gray-50/g, 'bg-white')
                                    .replace(/border-blue-500|border-gray-400/g, 'border-gray-300');
                                statusBadge.textContent = 'Lido';
                                statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                            } else if (newStatus === 'unread') {
                                message.className = message.className
                                    .replace(/bg-white|bg-gray-50/g, 'bg-blue-50')
                                    .replace(/border-gray-300|border-gray-400/g, 'border-blue-500');
                                statusBadge.textContent = 'Não lido';
                                statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
                            } else if (newStatus === 'archived') {
                                message.className = message.className
                                    .replace(/bg-white|bg-blue-50/g, 'bg-gray-50')
                                    .replace(/border-gray-300|border-blue-500/g, 'border-gray-400');
                                statusBadge.textContent = 'Arquivado';
                                statusBadge.className = 'status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-300 text-gray-700';
                            }
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
                }
            });
        </script>
    @endpush
@endsection
