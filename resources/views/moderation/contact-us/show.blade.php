@extends('layout.app')

@section('title', 'Pedido de Contacto - Detalhes')

@section('content')
    <div class="min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl border-l-4 border-emerald-400 shadow-sm animate-fadeIn">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle-fill text-xl mr-3"></i>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('contact-us.index') }}" class="group flex items-center space-x-2 text-indigo-600 hover:text-indigo-800 transition duration-200">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 group-hover:bg-indigo-200 transition-all duration-200">
                        <i class="bi bi-arrow-left text-indigo-600"></i>
                    </span>
                    <span class="font-medium">Voltar para a lista</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-blue-600 p-6 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-40 h-40 rounded-full bg-white opacity-10"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 rounded-full bg-white opacity-5"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <h1 class="text-2xl font-bold">Pedido de Contacto #{{ $contact->id }}</h1>
                            <span class="px-4 py-1.5 rounded-full text-sm font-medium {{ $contact->is_processed ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $contact->is_processed ? 'Processado' : 'Em Processamento' }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2 text-blue-100">
                            <i class="bi bi-clock"></i>
                            <span>Recebido em {{ $contact->created_at->format('d/m/Y às H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Sender Information -->
                            <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-100">
                                    <h2 class="font-semibold text-gray-700 flex items-center space-x-2">
                                        <i class="bi bi-person-lines-fill text-indigo-500"></i>
                                        <span>Informações do Remetente</span>
                                    </h2>
                                </div>
                                <div class="p-5 bg-white">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-14 h-14 rounded-full bg-gradient-to-r from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xl font-semibold">
                                                {{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $contact->first_name }} {{ $contact->last_name }}</h3>
                                            <div class="mt-1 flex items-center text-gray-600">
                                                <i class="bi bi-envelope-fill text-xs mr-2"></i>
                                                <a href="mailto:{{ $contact->email }}" class="hover:text-indigo-600 transition-colors">{{ $contact->email }}</a>
                                            </div>
                                            <div class="mt-1 flex items-center text-gray-600">
                                                <i class="bi bi-telephone-fill text-xs mr-2"></i>
                                                <span>{{ $contact->telephone ?? 'Não fornecido' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Processing Status -->
                            @if($contact->is_processed)
                                <div class="rounded-xl overflow-hidden shadow-sm border border-emerald-100">
                                    <div class="bg-emerald-50 px-4 py-3 border-b border-emerald-100">
                                        <h2 class="font-semibold text-emerald-700 flex items-center space-x-2">
                                            <i class="bi bi-check2-circle text-emerald-500"></i>
                                            <span>Detalhes do Processamento</span>
                                        </h2>
                                    </div>
                                    <div class="p-5 bg-white">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-500">
                                                    <i class="bi bi-person-check-fill"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800">Processado por {{ $contact->processed_by->name }}</h3>
                                                <p class="text-sm text-gray-500 mt-1">{{ $contact->processed_by->user_type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rounded-xl overflow-hidden shadow-sm border border-amber-100">
                                    <div class="bg-amber-50 px-4 py-3 border-b border-amber-100">
                                        <h2 class="font-semibold text-amber-700 flex items-center space-x-2">
                                            <i class="bi bi-hourglass-split text-amber-500"></i>
                                            <span>Status do Processamento</span>
                                        </h2>
                                    </div>
                                    <div class="p-5 bg-white">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-500">
                                                    <i class="bi bi-clock-history"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800">Em Processamento</h3>
                                                <p class="text-sm text-gray-500 mt-1">Este pedido ainda não foi processado</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column -->
                        <div>
                            <!-- Message -->
                            <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100 h-full flex flex-col">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-100">
                                    <h2 class="font-semibold text-gray-700 flex items-center space-x-2">
                                        <i class="bi bi-chat-left-text-fill text-indigo-500"></i>
                                        <span>Mensagem do Contacto</span>
                                    </h2>
                                </div>
                                <div class="p-5 bg-white flex-grow">
                                    <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-100 h-full">
                                        <p class="text-gray-700 whitespace-pre-line">{{ $contact->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Section -->
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4 flex items-center">
                            <i class="bi bi-gear-fill mr-2 text-gray-400"></i>
                            Ações
                        </h2>

                        <form action="{{ route('contact-us.mark-as-read', $contact->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="{{ $contact->is_processed
                                    ? 'bg-amber-100 hover:bg-amber-200 text-amber-800 border-amber-200'
                                    : 'bg-emerald-100 hover:bg-emerald-200 text-emerald-800 border-emerald-200' }}
                                    px-6 py-3 rounded-xl shadow-sm border flex items-center justify-center transition-all duration-200 font-medium">
                                @if($contact->is_processed)
                                    <i class="bi bi-x-circle mr-2"></i>
                                    Desmarcar como Processado
                                @else
                                    <i class="bi bi-check-circle mr-2"></i>
                                    Marcar como Processado
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
