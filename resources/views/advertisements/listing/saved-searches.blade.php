<div x-data="{ open: false }" x-cloak>
    <!-- Trigger Button -->
    <button @click="open = true"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Ver Pesquisas Guardadas
    </button>

    <!-- Modal Overlay -->
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         @click.self="open = false"
         x-transition>
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6 space-y-4" @click.stop>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Pesquisas Guardadas</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>

            @if($savedSearches->isEmpty())
                <p class="text-gray-500">Ainda não guardou nenhuma pesquisa.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($savedSearches as $search)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <div class="font-medium">{{ $search->title ?? 'Pesquisa #' . $search->id }}</div>
                                <div class="text-sm text-gray-500">
                                    Guardado em {{ $search->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('search.apply', ['id' => $search->id]) }}"
                                   class="text-blue-600 hover:underline text-sm">
                                    Aplicar
                                </a>
                                <form action="{{ route('search.delete', $search->id) }}" method="POST" onsubmit="return confirm('Tem a certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
