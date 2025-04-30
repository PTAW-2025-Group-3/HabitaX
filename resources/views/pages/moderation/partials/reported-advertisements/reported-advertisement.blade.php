@extends('layout.app')

@section('title', 'Revisão da Denúncia')

@section('content')
    <div class="container mx-auto py-6 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Breadcrumb and Back Button -->
            <div class="flex justify-between items-center mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('moderation') }}" class="text-gray-600 hover:text-primary">
                                <i class="bi bi-house-door me-2"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-gray-500">Denúncias</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-gray-800 font-medium">Revisão #{{ $denunciation->id }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Status Summary -->
            <div class="bg-primary text-white p-6 rounded-t-lg shadow-md">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-2xl font-bold flex items-center">
                            <i class="bi bi-flag-fill me-3"></i>
                            Denúncia #{{ $denunciation->id }}
                        </h2>
                        <p class="text-blue-100 mt-1">Submetida em {{ $denunciation->submitted_at->format('d/m/Y') }} às {{ $denunciation->submitted_at->format('H:i') }}h</p>
                    </div>
                    <div>
                        @switch($denunciation->report_state)
                            @case(0)
                                <span class="bg-yellow-500 text-white px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                                    <i class="bi bi-hourglass-split me-2"></i>
                                    Pendente
                                </span>
                                @break
                            @case(1)
                                <span class="bg-green-500 text-white px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Aprovada
                                </span>
                                @break
                            @case(2)
                                <span class="bg-red-500 text-white px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                                    <i class="bi bi-x-circle-fill me-2"></i>
                                    Rejeitada
                                </span>
                                @break
                            @default
                                <span class="bg-secondary text-white px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                                    <i class="bi bi-question-circle-fill me-2"></i>
                                    Desconhecido
                                </span>
                        @endswitch
                    </div>
                </div>
            </div>

            <!-- Main Card Content -->
            <div class="bg-white rounded-b-lg shadow-lg overflow-hidden border border-gray-200">
                <!-- Property Card -->
                <div class="bg-gray-50 p-5 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-center mb-3 md:mb-0">
                            <div class="bg-primary-light p-3 rounded-full text-primary me-4">
                                <i class="bi bi-house-door text-xl"></i>
                            </div>
                            <div>
                                <span class="text-gray-500 text-sm">Anúncio Reportado</span>
                                <h4 class="font-semibold text-lg">{{ $denunciation->advertisement->title ?? 'Anúncio sem título' }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('advertisements.show', $denunciation->advertisement_id) }}" class="btn-outline-primary flex items-center">
                            <i class="bi bi-eye me-2"></i>
                            Ver Anúncio
                        </a>
                    </div>
                </div>

                <!-- Report Details -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Denunciante Section -->
                        <div class="md:col-span-6">
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Denunciante</label>
                            <div class="flex items-center">
                                <div class="me-3">
                                    @if($denunciation->creator)
                                        <img src="{{ $denunciation->creator->getProfilePictureUrl() }}"
                                             alt="Foto de {{ $denunciation->creator->name }}"
                                             class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div class="bg-gray-100 p-2 rounded-full">
                                            <i class="bi bi-person text-gray-600"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="bg-gray-100 text-gray-800 px-4 py-3 rounded-lg flex-grow">
                                    {{ $denunciation->creator->name }}
                                </div>
                            </div>
                        </div>

                        <!-- Motivo Section -->
                        <div class="md:col-span-6">
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Motivo da Denúncia</label>
                            <div class="bg-orange-50 border border-orange-200 text-orange-800 px-4 py-3 rounded-lg font-medium">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ $denunciation->reason->name ?? 'Não especificado' }}
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="md:col-span-12">
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Descrição da Denúncia</label>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 text-gray-700 min-h-[120px] leading-relaxed shadow-inner">
                                {{ $denunciation->desc ?? 'Não foi fornecida uma descrição.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Info -->
                @if($denunciation->report_state !== 0 && $denunciation->validator)
                    <div class="bg-gray-50 border-t border-gray-200 p-4">
                        <div class="flex items-center justify-center text-gray-600">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Validado por: <strong>{{ $denunciation->validator->name }}</strong> em {{ $denunciation->validated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Footer Actions -->
                <div class="border-t border-gray-200 bg-gray-50 p-6">
                    @if($denunciation->report_state === 0)
                        <div class="flex flex-col md:flex-row justify-center gap-4">
                            <form action="{{ route('reported-advertisement.approve', $denunciation->id) }}" method="POST" class="w-full md:w-auto">
                                @csrf
                                <button type="submit" class="btn-success px-8 py-3 w-full md:w-auto flex items-center justify-center">
                                    <i class="bi bi-check-lg me-2"></i>
                                    Aprovar Denúncia
                                </button>
                            </form>
                            <form action="{{ route('reported-advertisement.reject', $denunciation->id) }}" method="POST" class="w-full md:w-auto">
                                @csrf
                                <button type="submit" class="btn-warning px-8 py-3 w-full md:w-auto flex items-center justify-center">
                                    <i class="bi bi-x-lg me-2"></i>
                                    Rejeitar Denúncia
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
