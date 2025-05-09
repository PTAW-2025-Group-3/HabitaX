@extends('layout.app')

        @section('title', 'Pedido de contacto connosco')

        @section('content')
            <div class="container mx-auto p-4">
                <div class="mt-4 flex justify-between mb-4">
                    <a href="{{ route('contact-us.index') }}" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark">
                        Voltar para a lista
                    </a>
                </div>

                <h1 class="text-2xl font-bold mb-6">Pedido de contacto connosco</h1>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <p><strong>ID:</strong> {{ $contact->id }}</p>
                    <p><strong>Nome:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Telefone:</strong> {{ $contact->telephone }}</p>
                    <p><strong>Mensagem:</strong> {{ $contact->message }}</p>
                    <p><strong>Criado em:</strong> {{ $contact->created_at }}</p>
                    <p><strong>Processado:</strong>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contact->is_processed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $contact->is_processed ? 'Sim' : 'Não' }}
                        </span>
                    </p>
                    @if($contact->is_processed)
                        <p><strong>Processado por:</strong> {{ $contact->processed_by->user_type . ' - ' . $contact->processed_by->name . ' - ID: ' . $contact->processed_by->id }}</p>
                    @endif
                </div>

                <form action="{{ route('contact-us.mark-as-read', $contact->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        {{ $contact->is_processed ? 'Desmarcar como Processado' : 'Marcar como Processado' }}
                    </button>
                </form>
            </div>
        @endsection
