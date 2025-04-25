@extends('layout.app')

@section('title', 'Revisão da Denúncia')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="bg-primary text-white p-6">
                    <h3 class="text-2xl font-bold text-center mb-2">Revisão da Denúncia</h3>
                    <div class="flex justify-center">
                        @switch($denunciation->report_state)
                            @case(0)
                                <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Por Resolver</span>
                                @break
                            @case(1)
                                <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Aprovado</span>
                                @break
                            @case(2)
                                <span class="bg-red-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Rejeitado</span>
                                @break
                            @default
                                <span class="bg-secondary text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Desconhecido</span>
                        @endswitch
                    </div>
                    <div class="flex justify-center items-center space-x-6 mt-4 text-sm">
                        <div>
                            <span class="text-blue-200 block">Data</span>
                            <span class="font-semibold">{{ $denunciation->submitted_at->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="text-blue-200 block">Hora</span>
                            <span class="font-semibold">{{ $denunciation->submitted_at->format('H:i') }}h</span>
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="bg-gray-50 border-b border-gray-200 p-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="bi bi-house-door text-gray-600 me-2"></i>
                        <span class="font-medium">{{ $denunciation->advertisement->title ?? 'Anúncio sem título' }}</span>
                    </div>
                    <a href="{{ route('advertisements.show', $denunciation->advertisement_id) }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                        <i class="bi bi-box-arrow-up-right me-1"></i>
                        Ver Anúncio
                    </a>
                </div>

                <!-- Report Details -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ID Section -->
                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">ID da Denúncia</label>
                            <div class="flex">
                                <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-md font-medium">#{{ $denunciation->id }}</span>
                            </div>
                        </div>
                        <!-- Reporter Section -->
                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Denunciante</label>
                            <div class="flex">
                                <span class="bg-gray-100 text-gray-800 px-3 py-2 rounded-md">{{ $denunciation->creator->name ?? 'Anónimo' }}</span>
                            </div>
                        </div>

                        <!-- Reason Section -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Motivo da Denúncia</label>
                            <div class="flex">
                                <span class="bg-orange-100 text-orange-800 px-3 py-2 rounded-md font-medium">{{ $denunciation->reason->name ?? 'Não especificado' }}</span>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Descrição do Report</label>
                            <div class="bg-gray-100 border border-gray-300 rounded-md p-4 text-gray-secondary">
                                {{ $denunciation->desc ?? 'Não foi fornecida uma descrição.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="border-t border-gray-200 bg-gray-50 p-6 flex justify-center space-x-4">
                    @if($denunciation->report_state === 0)
                        <form action="{{ route('reported-advertisement.approve', $denunciation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-success px-6 py-2">
                                <i class="bi bi-check-lg me-2"></i>
                                Aprovar Denúncia
                            </button>
                        </form>
                        <form action="{{ route('reported-advertisement.reject', $denunciation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-warning px-6 py-2">
                                <i class="bi bi-x-lg me-2"></i>
                                Rejeitar Denúncia
                            </button>
                        </form>
                    @else
                        <div class="text-gray-600">
                            @if($denunciation->validator)
                                <span>Validado por: {{ $denunciation->validator->name }} em {{ $denunciation->validated_at->format('d/m/Y H:i') }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
{{--            <!-- Additional Actions Card -->--}}
{{--            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mt-6">--}}
{{--                <div class="p-6">--}}
{{--                    <h5 class="text-lg font-semibold mb-4 flex items-center text-gray-secondary">--}}
{{--                        <i class="bi bi-gear me-2 text-gray"></i>--}}
{{--                        Ações Adicionais--}}
{{--                    </h5>--}}
{{--                    <div class="flex flex-wrap gap-2">--}}
{{--                        <a href="{{ route('reported-advertisement.history', $denunciation->advertisement_id) }}" class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">--}}
{{--                            <i class="bi bi-clock-history me-2"></i>--}}
{{--                            Ver Histórico de Reports--}}
{{--                        </a>--}}
{{--                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">--}}
{{--                            <i class="bi bi-person-slash me-2"></i>--}}
{{--                            Suspender Utilizador--}}
{{--                        </button>--}}
{{--                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">--}}
{{--                            <i class="bi bi-flag me-2"></i>--}}
{{--                            Marcar Anúncio--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
