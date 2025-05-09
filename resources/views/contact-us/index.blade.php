@extends('layout.app')

@section('title', 'Pedidos de contacto connosco')

@section('content')
    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-6">Pedidos de contacto connosco</h1>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider border-r border-gray-300">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider border-r border-gray-300">Nome</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider border-r border-gray-300">Mensagem</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider border-r border-gray-300">Processado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">Criado em</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($contacts as $contact)
                        <tr onclick="window.location='{{ route('contact-us.show', $contact->id) }}'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">{{ $contact->id }}</td>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider border-r border-gray-300">Nome</th>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">{{ $contact->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contact->is_processed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $contact->is_processed ? 'Sim' : 'Não' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $contact->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
