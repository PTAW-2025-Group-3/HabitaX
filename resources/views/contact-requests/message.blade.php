<div class="bg-{{ $status == 'unread' ? 'blue-50' : ($status == 'read' ? 'white' : 'gray-50') }}
    border-l-4 border-{{ $status == 'unread' ? 'blue-500' : ($status == 'read' ? 'gray-300' : 'gray-400') }}
    rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300"
     data-status="{{ $status }}" data-property="{{ $id }}" data-id="{{ $messageId }}">

    <div class="flex flex-col gap-2">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between">
            <div>
                <h3 class="font-semibold text-primary">{{ $name }}</h3>
                <div class="flex flex-col xs:flex-row xs:items-center gap-1 xs:gap-2">
                    <span class="text-xs text-gray">{{ $email }}</span>
                    @if(isset($telephone))
                        <span class="text-xs text-gray hidden xs:inline">•</span>
                        <span class="text-xs text-gray">
                        <i class="bi bi-telephone text-gray mr-1"></i>{{ $telephone }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2 sm:mt-0">
                <span class="text-xs text-gray">{{ $time }}</span>

                <span class="status-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                    {{ $status == 'unread' ? 'bg-blue-100 text-blue-800' : ($status == 'read' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700') }}">
                    {{ $status == 'unread' ? 'Não lido' : ($status == 'read' ? 'Lido' : 'Arquivado') }}
                </span>
            </div>
        </div>

        <p class="text-sm text-gray-secondary mt-2">{{ $message }}</p>

        <p class="text-xs text-gray mt-2">
            Referente ao anúncio: <span class="font-medium">{{ $title }}</span>
        </p>

        <div class="flex gap-2 mt-4 buttons-container">
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
    </div>
</div>
