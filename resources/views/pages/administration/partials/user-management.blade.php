<div class="mt-12 animate-fade-in">
    <h2 class="text-xl font-bold text-primary mb-4">Gerir Utilizadores</h2>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
        <!-- Campo de pesquisa -->
        <div class="relative flex-grow md:max-w-xl">
            <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="pl-4 pr-2 text-gray-400">
                    <i class="bi bi-search"></i>
                </div>
                <input
                    type="text"
                    id="userSearchInput"
                    placeholder="Pesquisar por nome ou email"
                    class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                >
                <button id="clearSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div id="searchResults" class="mt-2 text-sm text-gray-500 hidden">
                <span id="resultCount">0</span> resultados encontrados
            </div>
        </div>

        <!-- Dropdown de ordenação -->
        <div class="relative">
            <button id="sortDropdownButton" class="flex items-center justify-between w-full md:w-48 p-3 bg-white rounded-lg shadow-md border border-gray-200 text-left">
                <span id="currentSortLabel">Mais recentes</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div id="sortDropdownMenu" class="absolute right-0 mt-2 w-full md:w-48 bg-white rounded-lg shadow-lg z-10 border border-gray-200 hidden">
                <ul class="py-1">
                    <li class="sort-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-sort="created_at" data-order="desc">
                        <i class="bi bi-clock mr-2"></i>Mais recentes
                    </li>
                    <li class="sort-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-sort="created_at" data-order="asc">
                        <i class="bi bi-clock-history mr-2"></i>Mais antigos
                    </li>
                    <li class="sort-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-sort="name" data-order="asc">
                        <i class="bi bi-sort-alpha-down mr-2"></i>Nome (A-Z)
                    </li>
                    <li class="sort-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-sort="name" data-order="desc">
                        <i class="bi bi-sort-alpha-up mr-2"></i>Nome (Z-A)
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tabela de usuários -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                    <div class="flex items-center">
                        ID<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="name">
                    <div class="flex items-center">
                        Nome<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="email">
                    <div class="flex items-center">
                        Email<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="created_at">
                    <div class="flex items-center">
                        Data de Registo<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">Estado</th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody id="userTableBody">
            @forelse ($users as $user)
                <tr class="border-t hover:bg-gray-50 transition user-row"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-created_at="{{ $user->created_at->timestamp }}"
                    data-suspended="{{ $user->is_suspended ? 'true' : 'false' }}">
                    <td class="p-4">#{{ $user->id }}</td>
                    <td class="p-4 font-medium user-name">{{ $user->name }}</td>
                    <td class="p-4 text-gray-600 user-email">{{ $user->email }}</td>
                    <td class="p-4 text-gray-500">{{ $user->created_at->format('d/m/Y - H:i') }}</td>
                    <td class="p-4">
                        @if ($user->is_suspended)
                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">
                                Suspenso
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">
                                Ativo
                            </span>
                        @endif
                    </td>
                    <td class="p-4 space-x-1">
                        <button class="btn-secondary text-xs px-2 py-1 suspend-user-btn"
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-is-suspended="{{ $user->is_suspended ? 'true' : 'false' }}">
                            {{ $user->is_suspended ? 'Reativar' : 'Suspender' }}
                        </button>
                        <button class="btn-secondary text-xs px-2 py-1 permissions-btn"
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-user-role="{{ $user->userType ?? 'user' }}">
                            Permissões
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="border-t">
                    <td colspan="6" class="p-4 text-center text-gray-500">Nenhum utilizador encontrado</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="p-4" id="pagination-container">
            {{ $users->links() }}
        </div>
    </div>
</div>

@include('pages.administration.partials.modals.suspend-user')
@include('pages.administration.partials.modals.permissions-user')

<script src="{{ asset('js/pages/admin/user-search.js') }}"></script>
<script src="{{ asset('js/pages/admin/sorting.js') }}"></script>
<script src="{{ asset('js/pages/admin/modals.js') }}"></script>
<script src="{{ asset('js/pages/admin/pagination.js') }}"></script>
<script src="{{ asset('js/pages/admin/user-management.js') }}"></script>
