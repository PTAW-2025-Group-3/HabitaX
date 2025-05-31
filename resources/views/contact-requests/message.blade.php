<div class="bg-{{ $status == 'unread' ? 'blue-50' : ($status == 'read' ? 'white' : 'gray-50') }}
    border-l-4 border-{{ $status == 'unread' ? 'blue-500' : ($status == 'read' ? 'gray-300' : 'gray-400') }}
    rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300 w-full max-w-4xl"
     data-status="{{ $status }}"
     data-property="{{ $id }}"
     data-id="{{ $messageId }}"
     data-user-type="{{ isset($created_by) && $created_by ? 'registered' : 'guest' }}">

    <div class="flex flex-col gap-2">
        <!-- Cabeçalho do Card -->
        <div class="flex items-start justify-between gap-3 pb-2 border-b border-gray-100">
            <!-- Informações do Remetente/Destinatário -->
            <div class="flex items-start">
                @if(isset($isReadOnly) && $isReadOnly || (isset($created_by) && $created_by))
                    <div class="mr-3 flex-shrink-0">
                        <img src="{{ $profile_picture }}"
                             alt="Foto de perfil"
                             class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </div>
                @endif
                <div>
                    <h3 class="font-semibold text-primary">{{ $name }}</h3>
                    <div class="flex flex-wrap items-center gap-2">
                        @if(isset($isReadOnly) && $isReadOnly)
                            <!-- Informações do destinatário para mensagens enviadas -->
                            @if(isset($show_email) && $show_email)
                                <span class="text-xs text-gray">{{ $email }}</span>
                            @else
                                <span class="text-xs text-gray-400 italic">
                                    <i class="bi bi-envelope-slash text-gray-400 mr-1"></i>Email não disponível
                                </span>
                            @endif
                        @elseif(isset($created_by) && $created_by)
                            <!-- Informações do remetente para mensagens recebidas (utilizadores registados) -->
                            @if(isset($user) && $user->show_email)
                                <span class="text-xs text-gray">{{ $email }}</span>
                            @else
                                <span class="text-xs text-gray-400 italic">
                                    <i class="bi bi-envelope-slash text-gray-400 mr-1"></i>Email não disponível
                                </span>
                            @endif
                        @else
                            <!-- Informações do remetente para mensagens recebidas (convidados) -->
                            <span class="text-xs text-gray">{{ $email }}</span>
                        @endif

                        <!-- Telefone -->
                        @if(isset($telephone))
                            <span class="text-xs text-gray hidden xs:inline">•</span>
                            @if((isset($show_telephone) && $show_telephone) || (!isset($created_by) || !$created_by))
                                <span class="text-xs text-gray">
                                    <i class="bi bi-telephone text-gray mr-1"></i>{{ $telephone }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400 italic">
                                    <i class="bi bi-x-circle text-gray-400 mr-1"></i>Telefone não disponível
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status e Data -->
            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                <span class="status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                    {{ $status == 'unread' ? 'bg-blue-100 text-blue-800' : ($status == 'read' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700') }}">
                    {{ $status == 'unread' ? 'Não lido' : ($status == 'read' ? 'Lido' : 'Arquivado') }}
                </span>
                <span class="text-xs text-gray">{{ $time }}</span>
            </div>
        </div>

        <!-- Corpo da Mensagem -->
        <div class="mt-3 text-sm text-gray-secondary message-container">
            <div class="font-medium text-primary mb-1">Mensagem</div>

            @php
                $messageText = $message ?? '';
                $messageLength = strlen($messageText);
                $isLongMessage = $messageLength > 200;
                $shortMessage = $isLongMessage ? substr($messageText, 0, 200) . '...' : $messageText;
            @endphp

            <div class="{{ $isLongMessage ? 'short-content' : '' }}">
                <p class="whitespace-pre-wrap break-words w-full">{{ $shortMessage }}</p>
            </div>

            @if($isLongMessage)
                <div class="full-content hidden">
                    <p class="whitespace-pre-wrap break-words w-full">{{ $messageText }}</p>
                </div>

                <button class="block text-xs text-primary font-medium mt-2 toggle-message" data-show-more="true">
                    <i class="bi bi-chevron-down mr-1"></i>Mostrar mais
                </button>
            @endif
        </div>

        <!-- Informações do Anúncio -->
        <div class="mt-2 pt-2 border-t border-gray-100">
            <p class="text-xs text-gray">
                Referente ao anúncio: <span class="font-medium">{{ $title }}</span>
            </p>

            <!-- Informações do destinatário (apenas para mensagens enviadas) -->
            @if(isset($isReadOnly) && $isReadOnly && isset($recipient_name))
                <p class="text-xs text-gray mt-1">
                    <i class="bi bi-arrow-right text-primary mr-1"></i>
                    Enviado para: <span class="font-medium">{{ $recipient_name }}</span> ({{ $recipient_email }})
                    @if(isset($recipient_telephone))
                        • <i class="bi bi-telephone text-gray mr-1"></i>{{ $recipient_telephone }}
                    @endif
                </p>
            @endif
        </div>

        <!-- Botões de Ação -->
        @if(!isset($isReadOnly) || !$isReadOnly)
            <div class="flex gap-2 mt-3 pt-2 border-t border-gray-100 buttons-container">
                @if ($status == 'archived')
                    <button class="btn-gray py-1.5 px-3 text-xs status-action-btn" data-action="restore">
                        <i class="bi bi-arrow-counterclockwise mr-1"></i> Restaurar
                    </button>
                @else
                    @if ($status == 'unread')
                        <button class="btn-secondary py-1.5 px-3 text-xs status-action-btn" data-action="mark-read">
                            <i class="bi bi-check2-all mr-1"></i> Marcar como lido
                        </button>
                    @else
                        <button class="btn-primary py-1.5 px-3 text-xs status-action-btn" data-action="mark-unread">
                            <i class="bi bi-envelope mr-1"></i> Marcar como não lido
                        </button>
                    @endif
                    <button class="btn-gray py-1.5 px-3 text-xs status-action-btn" data-action="archive">
                        <i class="bi bi-archive mr-1"></i> Arquivar
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
<script>
    // Colocar este código em um arquivo JS separado ou no final do layout principal
    document.addEventListener('DOMContentLoaded', function() {
        // Use delegação de eventos para lidar com botões que podem ser adicionados após carregamento
        document.body.addEventListener('click', function(e) {
            if (e.target.closest('.toggle-message')) {
                const button = e.target.closest('.toggle-message');
                const container = button.closest('.message-container');
                const shortContent = container.querySelector('.short-content');
                const fullContent = container.querySelector('.full-content');
                const showMore = button.getAttribute('data-show-more') === 'true';

                if (showMore) {
                    shortContent.classList.add('hidden');
                    fullContent.classList.remove('hidden');
                    button.innerHTML = '<i class="bi bi-chevron-up mr-1"></i>Mostrar menos';
                    button.setAttribute('data-show-more', 'false');
                } else {
                    shortContent.classList.remove('hidden');
                    fullContent.classList.add('hidden');
                    button.innerHTML = '<i class="bi bi-chevron-down mr-1"></i>Mostrar mais';
                    button.setAttribute('data-show-more', 'true');
                }
            }
        });
    });
</script>
