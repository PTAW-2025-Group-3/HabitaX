@extends('layout.app')

@section('title', 'Variáveis Globais')

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
                <i class="bi bi-gear-fill mr-2"></i> Lista de Variáveis Globais
            </h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded flash-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabela de variáveis globais -->
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
                                Valor
                            </div>
                        </th>
                        <th class="p-4 cursor-pointer sortable-column" data-sort="updated_at">
                            <div class="flex items-center">
                                Editado em<span class="sort-icon ml-1"></span>
                            </div>
                        </th>
                        <th class="p-4">Editado por</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($globalVariables as $globalVariable)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-900">{{ $globalVariable->id }}</td>
                            <td class="p-4 font-medium">{{ $globalVariable->name }}</td>
                            <td class="p-4">
                                <input
                                    type="text"
                                    value="{{ $globalVariable->value }}"
                                    class="editable-value border border-gray-300 rounded px-2 py-1 w-full"
                                    data-id="{{ $globalVariable->id }}"
                                />
                            </td>
                            <td class="p-4 text-gray-500">{{ $globalVariable->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4 text-gray-600">
                                {{ $globalVariable->updated_by ? $globalVariable->updated_by->name : 'Desconhecido' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4" id="pagination-container">
                    {{ $globalVariables->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.editable-value').forEach(input => {
                input.addEventListener('change', async (event) => {
                    const id = event.target.dataset.id;
                    const value = event.target.value;

                    console.log(`ID: ${id}, Value: ${value}`);

                    try {
                        const response = await fetch(`/admin/global-variables/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ value })
                        });

                        if (!response.ok) {
                            throw new Error(`${response.statusText}`);
                        }

                        const result = await response.json();
                        alert(result.message || 'Valor atualizado com sucesso!');
                    } catch (error) {
                        alert('Occoreu um erro ao atualizar o valor: ' + error.message);
                    }
                });
            });
        });
    </script>
@endpush
