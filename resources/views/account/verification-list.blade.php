@extends('account.account-layout')

@section('title', 'Minhas Verificações')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-primary">Minhas Verificações</h1>

            @if(isset($verifications))@endif

            @if($canCreateNew && $pendingCount == 0)
                <a href="{{ route('advertiser-verifications.create') }}" class="btn-primary py-2 px-4 text-sm">
                    <i class="bi bi-plus-lg mr-1"></i> Nova Verificação
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-800 rounded-lg p-4 mb-6 flex items-start">
                <i class="bi bi-check-circle-fill mr-3 text-green-600 text-xl mt-0.5"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-800 rounded-lg p-4 mb-6 flex items-start">
                <i class="bi bi-exclamation-circle-fill mr-3 text-red-600 text-xl mt-0.5"></i>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Alerta de limite de tentativas -->
        @if($rejectedCount >= $maxTrials)
            <div class="bg-red-50 text-red-800 rounded-lg p-4 mb-6 flex items-start">
                <i class="bi bi-exclamation-triangle-fill mr-3 text-red-600 text-xl mt-0.5"></i>
                <p>Atingiu o limite máximo de {{ $maxTrials }} tentativas. Entre em contacto com o suporte para mais informações.</p>
            </div>
        @endif

        @if($verifications->isEmpty())
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-file-earmark-text text-2xl text-gray-500"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Nenhuma verificação encontrada</h3>
                <p class="text-gray-500 mb-6">Ainda não enviou nenhum pedido de verificação de anunciante.</p>
                <a href="{{ route('advertiser-verifications.create') }}" class="btn-secondary py-2 px-6">
                    Solicitar Verificação
                </a>
            </div>
        @else
            <div class="space-y-4">
                @php
                    $totalCount = $verifications->count();
                @endphp

                @foreach($verifications as $index => $verification)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col md:flex-row">
                            <!-- Barra de estado na lateral -->
                            <div class="w-full md:w-2 h-2 md:h-auto
                                @if($verification->verification_advertiser_state === 0) bg-yellow-400
                                @elseif($verification->verification_advertiser_state === 1) bg-green-500
                                @else bg-red-500 @endif">
                            </div>

                            <div class="flex-1 p-5">
                                <div class="flex flex-col md:flex-row justify-between">
                                    <div class="flex items-center mb-3 md:mb-0">
                                        <span class="text-gray-500 text-sm mr-2 font-medium">
                                            Tentativa {{ $totalCount - $index }}
                                        </span>

                                        @if($verification->verification_advertiser_state === 0)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="bi bi-clock-history mr-1"></i> Pendente
                                            </span>
                                        @elseif($verification->verification_advertiser_state === 1)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="bi bi-check-circle mr-1"></i> Aprovado
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <i class="bi bi-x-circle mr-1"></i> Rejeitado
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        <i class="bi bi-calendar3 mr-1"></i> Submetido: {{ $verification->submitted_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                <div class="mt-4 border-t border-gray-100 pt-4">
                                    @if($verification->verification_advertiser_state === 0)
                                        <div class="p-3 bg-blue-50 rounded-md">
                                            <h4 class="text-sm font-medium text-blue-800">Verificação em andamento</h4>
                                            <p class="text-sm text-blue-700 mt-1">
                                                Possui uma verificação pendente. A nossa equipa está a analisar os seus documentos e avaliará a sua situação em breve.
                                                O tempo médio de aprovação será de 1-3 dias úteis, pois temos mais projetos para desenvolver.
                                            </p>
                                        </div>
                                    @elseif($verification->validator_comments)
                                        <div class="mb-3">
                                            <h4 class="text-sm font-medium text-gray-700 mb-1">Comentários:</h4>
                                            <p class="text-sm text-gray-600">{{ $verification->validator_comments }}</p>
                                        </div>
                                    @endif

                                    @if($verification->validated_at)
                                        <div class="flex items-center text-sm text-gray-500 mt-2">
                                            <i class="bi bi-check2-all mr-1"></i>
                                            Analisado em: {{ $verification->validated_at->format('d/m/Y H:i') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Rodapé com informações sobre limite de tentativas -->
            <div class="mt-6 text-sm text-gray-500 flex items-center">
                <i class="bi bi-info-circle mr-2"></i>
                <span>Utilizou {{ $rejectedCount }} de {{ $maxTrials }} tentativas permitidas.</span>
            </div>
        @endif
    </div>
@endsection
