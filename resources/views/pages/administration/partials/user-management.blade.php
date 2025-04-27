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
    </div>

    <!-- Tabela de utilizadores -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                    <div class="flex items-center">
                        ID<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">
                    <div class="flex items-center">
                        Imagem de perfil<span class="sort-icon ml-1"></span>
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
            @include('pages.administration.partials.user-rows', ['users' => $users])
            </tbody>
        </table>
        <div class="p-4" id="pagination-container">
            {{ $users->links() }}
        </div>
    </div>
</div>

@include('pages.administration.partials.modals.suspend-user')
@include('pages.administration.partials.modals.permissions-user')

<script src="{{ asset('js/pages/admin/user-management/user-search.js') }}"></script>
<script src="{{ asset('js/pages/admin/user-management/sorting.js') }}"></script>
<script src="{{ asset('js/pages/admin/user-management/modals.js') }}"></script>
<script src="{{ asset('js/pages/admin/user-management/pagination.js') }}"></script>
<script src="{{ asset('js/pages/admin/user-management/user-management.js') }}"></script>
