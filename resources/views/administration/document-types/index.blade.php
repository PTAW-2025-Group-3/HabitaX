@extends('layout.app')

@section('title', 'Tipo de Documento')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-4">
            <a href="{{ route('admin.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                <i class="bi bi-arrow-left mr-2"></i>
                Voltar para Dashboard
            </a>
        </div>
        <div class="mt-12">
            <h2 class="text-xl font-bold text-primary mb-4">
                <i class="bi bi-file-earmark-text mr-2"></i> Gerir Tipos de Documento
            </h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded flash-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
                <!-- Botão para criar novo -->
                <div>
                    <a href="{{ route('document-types.create') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                        <i class="bi bi-plus-circle mr-2"></i>
                        Criar Novo Tipo de Documento
                    </a>
                </div>
            </div>

            <!-- Tabela de tipos de documento -->
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
                        <th class="p-4">
                            <div class="flex items-center">
                                Descrição
                            </div>
                        </th>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="active">
                            <div class="flex items-center">
                                Estado<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($documentTypes as $documentType)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-900">{{ $documentType->id }}</td>
                            <td class="p-4 font-medium">{{ $documentType->name }}</td>
                            <td class="p-4 text-gray-600">{{ $documentType->description }}</td>
                            <td class="p-4">
                                @if ($documentType->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Ativo</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inativo</span>
                                @endif
                            </td>
                            <td class="p-4 space-x-1">
                                <a href="{{ route('document-types.edit', $documentType->id) }}"
                                   class="btn-secondary text-xs px-2 py-1 inline-block">
                                    Editar
                                </a>
                                <form action="{{ route('document-types.destroy', $documentType->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-warning text-xs px-2 py-1"
                                            onclick="return confirm('Tem certeza que deseja eliminar este tipo de documento?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4" id="pagination-container">
                    {{ $documentTypes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
