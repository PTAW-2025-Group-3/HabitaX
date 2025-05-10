@extends('layout.app')

@section('title', 'Variáveis Globais')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <h2 class="text-xl font-bold text-primary mb-4">Lista de Variáveis Globais</h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">Nome</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">Valor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">Editado em</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">Editado por</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($globalVariables as $globalVariable)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $globalVariable->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $globalVariable->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <input
                                type="text"
                                value="{{ $globalVariable->value }}"
                                class="editable-value border border-gray-300 rounded px-2 py-1"
                                data-id="{{ $globalVariable->id }}"
                            />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $globalVariable->updated_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $globalVariable->updated_by ? $globalVariable->updated_by->name : 'Desconhecido' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $globalVariables->links() }}
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
