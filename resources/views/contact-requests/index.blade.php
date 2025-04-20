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
{{--                <p>{{ $ads->first()->id }}</p>--}}
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-6 relative">
        <input type="search" id="user_search" class="form-input ps-10" placeholder="Pesquisar por nome de utilizador...">
    </div>

    <!-- Messages List -->
    <div id="messages_container" class="space-y-4">
        @foreach ($messages as $message)
            @include('contact-requests.message', [
                'name' => $message->name,
                'email' => $message->email,
                'status' => $message->state,
                'time' => $message->created_at->format('d/m/Y, H:i'),
                'message' => $message->message,
                'title' => $message->advertisement->title ?? 'N/A',
                'id' => $message->advertisement->id ?? 'N/A',
            ])
        @endforeach
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
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('message_status');
            const adFilter = document.getElementById('ad_filter');
            const userSearch = document.getElementById('user_search');
            const messagesContainer = document.getElementById('messages_container');
            const noMessages = document.getElementById('no_messages');
            const messages = messagesContainer.querySelectorAll('[data-status]');

            // Function to filter messages
            function filterMessages() {
                const statusValue = statusFilter.value;
                const propertyValue = adFilter.value;
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
            adFilter.addEventListener('change', filterMessages);
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
