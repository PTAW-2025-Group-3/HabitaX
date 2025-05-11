@extends('layout.app')

@section('title', 'Pedidos de Contacto - HabitaX')

@section('content')
    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-4 flex justify-between mb-4">
            <a href="{{ route('moderation') }}" class="group flex items-center space-x-2 text-indigo-600 hover:text-indigo-800 transition duration-200">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 group-hover:bg-indigo-200 transition-all duration-200">
                        <i class="bi bi-arrow-left text-indigo-600"></i>
                    </span>
                <span class="font-medium">Voltar para a Moderação</span>
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6">Pedidos de Contacto para a HabitaX</h1>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
            <!-- Campo de pesquisa -->
            <div class="relative flex-grow md:max-w-xl">
                <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="pl-4 pr-2 text-gray-400">
                        <i class="bi bi-search"></i>
                    </div>
                    <input
                        type="text"
                        id="contactSearchInput"
                        placeholder="Pesquisar por nome ou email"
                        class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                    >
                    <button id="clearContactSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div id="contactSearchResults" class="mt-2 text-sm text-gray-500 hidden">
                    <span id="contactResultCount">0</span> resultados encontrados
                </div>
            </div>
        </div>

        <!-- Filtros de estados -->
        <div class="flex flex-wrap gap-2 mb-4">
            <button
                class="filter-btn px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium"
                data-filter="all">
                Todos
            </button>
            <button
                class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
                data-filter="processed">
                Processados
            </button>
            <button
                class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
                data-filter="not-processed">
                Não Processados
            </button>
        </div>

        <!-- Tabela de contactos -->
        <div class="overflow-x-auto rounded-xl shadow bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-blue-100 text-left">
                <tr>
                    <th class="p-4 cursor-pointer" data-sort="id">
                        <div class="flex items-center">
                            ID<span class="sort-icon ml-1"></span>
                        </div>
                    </th>
                    <th class="p-4 cursor-pointer" data-sort="name">
                        <div class="flex items-center">
                            Nome<span class="sort-icon ml-1"></span>
                        </div>
                    </th>
                    <th class="p-4 cursor-pointer" data-sort="email">
                        <div class="flex items-center">
                            Email<span class="sort-icon ml-1"></span>
                        </div>
                    </th>
                    <th class="p-4">Mensagem</th>
                    <th class="p-4 cursor-pointer" data-sort="state">
                        <div class="flex items-center">
                            Estado<span class="sort-icon ml-1"></span>
                        </div>
                    </th>
                    <th class="p-4 cursor-pointer" data-sort="created_at">
                        <div class="flex items-center">
                            Data de Criação<span class="sort-icon ml-1"></span>
                        </div>
                    </th>
                    <th class="p-4">Ações</th>
                </tr>
                </thead>
                <tbody id="contactsTableBody">
                @forelse ($contacts as $contact)
                    <tr class="border-t hover:bg-gray-50 transition contact-row"
                        data-id="{{ $contact->id }}"
                        data-name="{{ strtolower($contact->first_name . ' ' . $contact->last_name) }}"
                        data-email="{{ strtolower($contact->email) }}"
                        data-processed="{{ $contact->is_processed ? 'processed' : 'not-processed' }}">
                        <td class="p-4">#{{ $contact->id }}</td>
                        <td class="p-4 font-medium">{{ $contact->first_name . ' ' . $contact->last_name }}</td>
                        <td class="p-4 text-gray-600">{{ $contact->email }}</td>
                        <td class="p-4 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($contact->message, 40) }}
                        </td>
                        <td class="p-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $contact->is_processed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $contact->is_processed ? 'Processado' : 'Não Processado' }}
                                </span>
                        </td>
                        <td class="p-4 text-gray-500">{{ $contact->created_at->format('d/m/Y - H:i') }}</td>
                        <td class="p-4">
                            <div class="flex gap-1">
                                <a href="{{ route('contact-us.show', $contact->id) }}" class="btn-secondary px-3 py-1 text-xs">
                                    Ver Detalhes
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t">
                        <td colspan="7" class="p-4 text-center text-gray-500">Não há pedidos de contacto para mostrar</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="p-4 pagination-container" id="pagination-container">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/contact-us/index.js') }}"></script>
@endsection
