<div class="bg-{{ $status == 'unread' ? 'blue-50' : ($status == 'read' ? 'white' : 'gray-50') }} border-l-4
    border-{{ $status == 'unread' ? 'blue-500' : ($status == 'read' ? 'gray-300' : 'gray-400') }}
    rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300"
     data-status="{{ $status }}" data-property="{{ $id }}">
    <div class="flex items-start gap-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/150?img={{ rand(1, 10) }}" alt="User" class="w-12 h-12 rounded-full object-cover">
        </div>
        <div class="flex-grow">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                <div>
                    <h3 class="font-semibold text-primary">{{ $name }}</h3>
                    <span class="text-xs text-gray">{{ $email }}</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2 sm:mt-0">
                    <span class="text-xs text-gray">{{ $time }}</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                        {{ $status == 'unread' ? 'bg-blue-100 text-blue-800' : ($status == 'read' ? 'bg-back text-gray-secondary' : 'bg-gray-200 text-gray-secondary') }}">
                        @if ($status == 'unread')
                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-1"></span> Não lido
                        @elseif ($status == 'read')
                            Lido
                        @else
                            <i class="bi bi-archive-fill text-xs mr-1"></i> Arquivado
                        @endif
                    </span>
                </div>
            </div>

            <p class="text-sm text-gray-secondary mb-2">{{ $message }}</p>

            <p class="text-xs text-gray mb-3">Referente ao anúncio: <span class="font-medium">{{ $title }}</span></p>

            <div class="flex gap-2 mt-2">
                @if ($status == 'unread')
                    <button class="btn-secondary py-1.5 px-3 text-xs">
                        <i class="bi bi-check2-all mr-1"></i> Marcar como lido
                    </button>
                @elseif ($status == 'read')
                    <button class="btn-gray py-1.5 px-3 text-xs">
                        <i class="bi bi-envelope mr-1"></i> Marcar como não lido
                    </button>
                @endif
                <button class="btn-gray py-1.5 px-3 text-xs">
                    <i class="bi bi-archive mr-1"></i> Arquivar
                </button>
                @if ($status == 'archived')
                    <button class="btn-gray py-1.5 px-3 text-xs">
                        <i class="bi bi-arrow-counterclockwise mr-1"></i> Restaurar
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
