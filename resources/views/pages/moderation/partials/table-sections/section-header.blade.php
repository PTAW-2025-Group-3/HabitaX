<div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
    <div class="flex flex-wrap gap-2 items-center">
        @foreach ($filters as $filter)
            <button class="px-4 py-1.5 rounded-lg text-sm font-medium
            @if($loop->index === 0) bg-blue-50 text-blue-600 border border-blue-200
            @else bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 @endif">
                {{ $filter }}
            </button>
        @endforeach

        @if(!empty($filters))
            <div class="w-px h-6 bg-gray-200 mx-1"></div>
        @endif
            <!-- Botão de Filtros -->
            <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-2">
                <!-- Ícone de filtro (formato funil) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 10h12m-4 6H10" />
                </svg>
                Filtros
            </button>
            <!-- Botão de visualização (menu de linhas) -->
            <button class="p-1.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm hover:bg-gray-50">
                <!-- Ícone de menu com 3 linhas horizontais -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
    </div>
</div>
