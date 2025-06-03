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
                    <a href="{{ route('contact-requests.index', ['type' => 'received'] + request()->except('type', 'page')) }}"
                       class="px-4 py-2 text-sm font-medium {{ $requestType === 'received' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        Recebidos
                    </a>
                    <a href="{{ route('contact-requests.index', ['type' => 'sent'] + request()->except('type', 'page')) }}"
                       class="px-4 py-2 text-sm font-medium {{ $requestType === 'sent' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        Enviados
                    </a>
                </div>
            @endif

            <!-- Search form - only show for received requests -->
            <form action="{{ route('contact-requests.index') }}" method="GET" class="w-full md:w-64 {{ $requestType !== 'received' ? 'invisible' : '' }}">
                @foreach(request()->except('search', 'page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <div class="relative">
                    <input type="search" name="search" id="user_search" class="form-input ps-10 w-full"
                           placeholder="Pesquisar por nome..." value="{{ request('search') }}">
                    <button type="submit" class="absolute inset-y-0 left-0 flex items-center pl-3">
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Controls -->
        <form action="{{ route('contact-requests.index') }}" method="GET" id="filter-form" class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <!-- Manter os parâmetros de rota existentes que não são filtros -->
            <input type="hidden" name="type" value="{{ $requestType }}">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="flex items-center mb-2">
                <i class="bi bi-funnel mr-2 text-gray-500"></i>
                <h3 class="text-sm font-medium text-gray-700">Filtros</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Status Filter - Always show -->
                <div class="relative">
                    <label for="message_status" class="block text-xs font-medium text-gray-500 mb-1">Estado</label>
                    <div class="relative dropdown-wrapper">
                        <select name="status" id="message_status" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                            <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Todos os estados</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Não lidos</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Lidos</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Arquivados</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- Ad Filter - Always show -->
                <div class="relative">
                    <label for="ad_filter" class="block text-xs font-medium text-gray-500 mb-1">Anúncio</label>
                    <div class="relative dropdown-wrapper">
                        <select name="advertisement_id" id="ad_filter" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                            <option value="">Todos os anúncios</option>
                            @foreach ($ads as $ad)
                                <option value="{{ $ad->id }}" {{ request('advertisement_id') == $ad->id ? 'selected' : '' }}>
                                    {{ Str::limit($ad->title, 40) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- User Type Filter - Only for received requests -->
                @if($requestType === 'received')
                    <div class="relative">
                        <label for="user_type_filter" class="block text-xs font-medium text-gray-500 mb-1">Tipo de utilizador</label>
                        <div class="relative dropdown-wrapper">
                            <select name="user_type" id="user_type_filter" class="dropdown-select py-2 pl-4 pr-10 h-10 text-sm w-full">
                                <option value="all" {{ request('user_type', 'all') == 'all' ? 'selected' : '' }}>Todos os utilizadores</option>
                                <option value="registered" {{ request('user_type') == 'registered' ? 'selected' : '' }}>Registados</option>
                                <option value="guest" {{ request('user_type') == 'guest' ? 'selected' : '' }}>Convidados</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>

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
                        @if (request('status') || request('advertisement_id') || request('user_type') || request('search'))
                            Nenhuma mensagem encontrada
                        @elseif($isAdvertiser && $requestType === 'received')
                            Sem pedidos de contacto recebidos
                        @else
                            Sem pedidos de contacto enviados
                        @endif
                    </h3>
                    <p class="text-gray mt-2">
                        @if (request('status') || request('advertisement_id') || request('user_type') || request('search'))
                            Não foram encontradas mensagens com os filtros selecionados.
                        @elseif($isAdvertiser && $requestType === 'received')
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
            {{ $messages->appends(request()->query())->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Auto-submit na mudança dos selects para melhorar a experiência do usuário
                document.querySelectorAll('#message_status, #ad_filter, #user_type_filter').forEach(select => {
                    select.addEventListener('change', function() {
                        document.getElementById('filter-form').submit();
                    });
                });

                // Only allow status updates for received messages
                const isAdvertiser = {{ $isAdvertiser ? 'true' : 'false' }};
                const requestType = '{{ $requestType }}';
                const messagesContainer = document.getElementById('messages_container');

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
                    });
                }
            });
        </script>
    @endpush
@endsection
