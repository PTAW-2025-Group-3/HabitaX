<div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full">
        <h2 class="text-xl font-semibold text-gray-800 whitespace-nowrap">{{ $title }}</h2>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input type="text" class="pl-10 pr-4 py-1.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm w-full focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300" placeholder="Pesquisar...">
        </div>
    </div>
    <div class="flex flex-wrap gap-2 items-center mt-3 sm:mt-0 shrink-0">
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
