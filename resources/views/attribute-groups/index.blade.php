@extends('layout.app')

@section('title', 'Opções de Atributo')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('admin.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Opções de Atributo</h2>
                <a href="{{ route('attribute-groups.create') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Adicionar Grupo de Atributos
                </a>
            </div>
            @if ($groups->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow text-center text-gray">
                    Nenhum grupo de atributos encontrado.
                </div>
            @else
                <!-- Tabela de grupos de atributos -->
                <div class="overflow-x-auto rounded-xl shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-100 text-left">
                        <tr>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Icone
                                </div>
                            </th>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Nome
                                </div>
                            </th>
                            <th class="p-4 text-center">Descrição</th>
                            <th class="p-4 text-right">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($groups as $group)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="p-4 font-medium">
                                    @if ($group->icon_path)
                                        <img src="{{ Storage::url($group->icon_path) }}" alt="{{ $group->name }} Icon"
                                             class="w-8 h-8 rounded-full">
                                    @else
                                        <span class="text-gray">Sem ícone</span>
                                    @endif
                                </td>
                                <td class="p-4 font-medium">{{ $group->name }}</td>
                                <td class="p-4 text-center">{{ \Illuminate\Support\Str::limit($group->description, 50, '...') }}</td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('attribute-groups.edit', $group->id) }}" class="text-blue-500 hover:text-blue-700">
                                        Editar
                                    </a>
                                    <form action="{{ route('attribute-groups.destroy', $group->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $groups->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
