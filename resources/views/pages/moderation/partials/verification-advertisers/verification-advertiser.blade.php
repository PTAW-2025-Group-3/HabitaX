@extends('layout.app')

@section('title', 'Verificação de Anunciante')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-5xl mx-auto">
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
                                <a href="{{ route('moderation') }}" class="text-gray-500 hover:text-primary">
                                    Verificações
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-gray-800 font-medium">Verificação #{{ $verification->id }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mb-6">
                <div class="bg-primary text-white p-6">
                    <h3 class="text-2xl font-bold text-center mb-2">Verificação de Anunciante</h3>
                    <div class="flex justify-center">
                        <span class="bg-secondary text-white px-4 py-1 rounded-full text-sm font-semibold">
                            Estado Atual:
                            @php
                                $states = [
                                    0 => 'Por Aprovar',
                                    1 => 'Aprovado',
                                    2 => 'Rejeitado'
                                ];
                            @endphp
                            {{ $states[$verification->verification_advertiser_state] ?? 'Desconhecido' }}
                        </span>
                    </div>
                    <div class="flex justify-center items-center space-x-6 mt-4 text-sm">
                        <div>
                            <span class="text-blue-200 block">Data de Submissão</span>
                            <span class="font-semibold">
                                {{ $verification->submitted_at ? $verification->submitted_at->format('d/m/Y') : 'N/A' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-blue-200 block">ID da Submissão</span>
                            <span class="font-semibold">#{{ $verification->id }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mb-6">
                <div class="border-b border-gray-200">
                    <h4 class="text-lg font-semibold p-4 flex items-center">
                        <i class="bi bi-person me-2 text-gray"></i>
                        Informações do Anunciante
                    </h4>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Nome Completo</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-person text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->name ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Email</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-envelope text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->email ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Telefone</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-telephone text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->telephone ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Nº Contribuinte</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-card-text text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->nif ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Tipo de Documento</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-card-text text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->document_type->name ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Nº de Documento</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-card-text text-gray"></i>
                                </span>
                                <input type="text" value="{{ $verification->submitter->document_number ?? 'N/A' }}" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documentos do Anunciante -->
            <div class="mb-6">
                <div class="border-b border-gray-200 bg-white rounded-t-lg shadow-md p-4">
                    <h4 class="text-lg font-semibold flex items-center">
                        <i class="bi bi-card-image me-2 text-gray-500"></i>
                        Documentos Enviados
                    </h4>
                </div>

                @if($verification->hasMedia('documents'))
                    @php
                        $documents = $verification->getMedia('documents');

                        // Definir nomes para os documentos
                        $docNames = [
                            'Documento de Identificação Frontal',
                            'Documento de Identificação Dorsal',
                            'Selfie Com Documento'
                        ];
                    @endphp

                    <div id="documents-gallery" class="gallery-container bg-white rounded-b-lg shadow-md p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($documents as $index => $document)
                                <div class="border rounded-lg p-4">
                                    <h5 class="font-medium text-gray-700 mb-3">
                                        {{ $docNames[$index] ?? 'Documento Adicional' }}
                                    </h5>
                                    <a href="{{ $document->getUrl() }}" data-index="{{ $index }}" class="block">
                                        <img src="{{ $document->getUrl('preview') }}"
                                             alt="{{ $docNames[$index] ?? 'Documento' }}"
                                             class="w-full h-48 object-cover rounded shadow-sm hover:opacity-90 transition-opacity cursor-pointer">
                                    </a>
                                </div>
                            @endforeach

                            @for($i = count($documents); $i < 3; $i++)
                                <div class="border rounded-lg p-4">
                                    <h5 class="font-medium text-gray-700 mb-3">
                                        {{ $docNames[$i] }}
                                    </h5>
                                    <div class="w-full h-48 bg-gray-100 rounded flex items-center justify-center">
                                        <span class="text-gray-400"><i class="bi bi-file-earmark-x text-3xl"></i></span>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Modal para todas as fotos -->
                    <div id="documents-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-auto bg-black bg-opacity-75 p-4">
                        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                            <div class="p-4 border-b flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Todos os documentos</h3>
                                <button id="closeDocumentsModal" class="p-2 hover:bg-gray-100 rounded-full">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($documents as $index => $document)
                                    <div class="document-photo-item cursor-pointer" data-index="{{ $index }}">
                                        <div class="relative h-48 overflow-hidden rounded border">
                                            <img src="{{ $document->getUrl('preview') }}"
                                                 alt="{{ $docNames[$index] ?? 'Documento' }}"
                                                 class="w-full h-full object-cover hover:scale-105 transition-transform">
                                        </div>
                                        <div class="mt-2 text-sm text-gray-600">
                                            {{ $docNames[$index] ?? ('Documento ' . ($index + 1)) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-b-lg shadow-md p-6 text-center">
                        <div class="flex flex-col items-center justify-center p-8 text-gray-500">
                            <i class="bi bi-file-earmark-x text-4xl mb-2"></i>
                            <p>Nenhum documento foi enviado pelo anunciante.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mb-6">
                <div class="border-b border-gray-200 bg-white rounded-t-lg shadow-md p-4">
                    <h4 class="text-lg font-semibold flex items-center">
                        <i class="bi bi-card-image me-2 text-gray-500"></i>
                        Verificação de Identidade
                    </h4>
                </div>

                @if($verification->hasMedia('identity_verifications'))
                    @php
                        $verifications = $verification->getMedia('identity_verifications');

                        // Definir nomes para os documentos
                        $docNames = [
                            'Documento de Identificação Frontal',
                            'Documento de Identificação Dorsal',
                            'Selfie Com Documento'
                        ];
                    @endphp

                    <div id="verifications-gallery" class="gallery-container bg-white rounded-b-lg shadow-md p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($verifications as $index => $document)
                                <div class="border rounded-lg p-4">
                                    <h5 class="font-medium text-gray-700 mb-3">
                                        {{ $docNames[$index] ?? 'Documento Adicional' }}
                                    </h5>
                                    <a href="{{ $document->getUrl() }}" data-index="{{ $index }}" class="block">
                                        <img src="{{ $document->getUrl('preview') }}"
                                             alt="{{ $docNames[$index] ?? 'Documento' }}"
                                             class="w-full h-48 object-cover rounded shadow-sm hover:opacity-90 transition-opacity cursor-pointer">
                                    </a>
                                </div>
                            @endforeach

                            @for($i = count($verifications); $i < 3; $i++)
                                <div class="border rounded-lg p-4">
                                    <h5 class="font-medium text-gray-700 mb-3">
                                        {{ $docNames[$i] }}
                                    </h5>
                                    <div class="w-full h-48 bg-gray-100 rounded flex items-center justify-center">
                                        <span class="text-gray-400"><i class="bi bi-file-earmark-x text-3xl"></i></span>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Modal para todas as fotos -->
                    <div id="verifications-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-auto bg-black bg-opacity-75 p-4">
                        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                            <div class="p-4 border-b flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Todos os documentos</h3>
                                <button id="closeDocumentsModal" class="p-2 hover:bg-gray-100 rounded-full">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($documents as $index => $document)
                                    <div class="verification-photo-item cursor-pointer" data-index="{{ $index }}">
                                        <div class="relative h-48 overflow-hidden rounded border">
                                            <img src="{{ $document->getUrl('preview') }}"
                                                 alt="{{ $docNames[$index] ?? 'Documento' }}"
                                                 class="w-full h-full object-cover hover:scale-105 transition-transform">
                                        </div>
                                        <div class="mt-2 text-sm text-gray-600">
                                            {{ $docNames[$index] ?? ('Documento ' . ($index + 1)) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-b-lg shadow-md p-6 text-center">
                        <div class="flex flex-col items-center justify-center p-8 text-gray-500">
                            <i class="bi bi-file-earmark-x text-4xl mb-2"></i>
                            <p>Nenhum documento foi enviado pelo anunciante.</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($verification->verification_advertiser_state === 0)
                <!-- Decision Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <h4 class="text-lg font-semibold p-4 flex items-center">
                            <i class="bi bi-check-circle me-2 text-gray"></i>
                            Decisão de Verificação
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Comentário/Justificação</label>
                            <textarea id="verification-comments" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white" rows="3" placeholder="Adicione um comentário ou justificação para a sua decisão..."></textarea>
                        </div>
                        <div class="flex justify-center space-x-4">
                            <button id="approve-btn" class="btn-success px-8 py-3">
                                <i class="bi bi-check-lg me-2"></i>
                                Aprovar Verificação
                            </button>
                            <button id="reject-btn" class="btn-warning px-8 py-3">
                                <i class="bi bi-x-lg me-2"></i>
                                Rejeitar Verificação
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <!-- Verification Result -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <h4 class="text-lg font-semibold p-4 flex items-center">
                            <i class="bi bi-info-circle me-2 text-gray"></i>
                            Resultado da Verificação
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <p class="text-xs uppercase text-gray-500 font-semibold mb-1">Estado Final</p>
                            <p class="px-3 py-1 rounded-full inline-block text-sm font-medium
                                @if($verification->verification_advertiser_state === 1) bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $states[$verification->verification_advertiser_state] ?? 'Desconhecido' }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="text-xs uppercase text-gray-500 font-semibold mb-1">Validado por</p>
                            <p class="text-gray-800">{{ $verification->validator->name ?? 'N/A' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-xs uppercase text-gray-500 font-semibold mb-1">Data de Validação</p>
                            <p class="text-gray-800">{{ $verification->validated_at ? $verification->validated_at->format('d/m/Y H:i') : 'N/A' }}</p>
                        </div>

                        @if(isset($verification->validator_comments))
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-xs uppercase text-gray-500 font-semibold mb-2">Comentários do Validador</p>
                                <div class="bg-gray-50 p-3 rounded-md text-gray-700">
                                    {{ $verification->validator_comments }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($verification->hasMedia('documents') || $verification->hasMedia('identity_verifications') || $verification->verification_advertiser_state === 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                @if($verification->hasMedia('documents'))
                const triggers = Array.from(document.querySelectorAll('#documents-gallery a'));

                window.documentsGallery = lightGallery(document.getElementById('documents-gallery'), {
                    dynamic: true,
                    plugins: [lgThumbnail, lgZoom],
                    download: true,
                    zoom: true,
                    speed: 500,
                    licenseKey: 'your-license-key',
                    dynamicEl: triggers.map(a => ({
                        src: a.getAttribute('href'),
                        thumb: a.querySelector('img').getAttribute('src')
                    }))
                });

                const documentsModal = document.getElementById('documents-modal');
                const closeDocumentsModal = document.getElementById('closeDocumentsModal');
                const documentPhotoItems = document.querySelectorAll('.document-photo-item');

                // Funções abrir/fechar modal
                function openDocumentsModal() {
                    documentsModal.classList.remove('hidden');
                    document.body.classList.add('modal-open');
                }

                function closeDocumentsModalFunction() {
                    documentsModal.classList.add('hidden');
                    document.body.classList.remove('modal-open');
                }

                // Clique nas miniaturas da galeria
                triggers.forEach((trigger, index) => {
                    trigger.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.documentsGallery.openGallery(index);
                    });
                });


                // Fechar modal por botão, clique fora ou tecla ESC
                if (closeDocumentsModal) {
                    closeDocumentsModal.addEventListener('click', closeDocumentsModalFunction);
                }

                if (documentsModal) {
                    documentsModal.addEventListener('click', function (e) {
                        if (e.target === documentsModal) {
                            closeDocumentsModalFunction();
                        }
                    });
                }

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !documentsModal.classList.contains('hidden')) {
                        closeDocumentsModalFunction();
                    }
                });

                // Abrir galeria ao clicar em fotos dentro do modal
                documentPhotoItems.forEach(item => {
                    item.addEventListener('click', function () {
                        const index = parseInt(this.dataset.index);
                        closeDocumentsModalFunction();
                        setTimeout(() => {
                            window.documentsGallery.openGallery(index);
                        }, 100);
                    });
                });
                @endif

                @if($verification->hasMedia('identity_verifications'))
                const triggersV = Array.from(document.querySelectorAll('#verifications-gallery a'));

                window.documentsGallery = lightGallery(document.getElementById('verifications-gallery'), {
                    dynamic: true,
                    plugins: [lgThumbnail, lgZoom],
                    download: true,
                    zoom: true,
                    speed: 500,
                    dynamicEl: triggersV.map(a => ({
                        src: a.getAttribute('href'),
                        thumb: a.querySelector('img').getAttribute('src')
                    }))
                });

                const verificationsModal = document.getElementById('verifications-modal');
                const closeVerificationsModal = document.getElementById('closeVerificationsModal');
                const verificationPhotoItems = document.querySelectorAll('.verification-photo-item');

                // Funções abrir/fechar modal
                function openVerificationModal() {
                    verificationsModal.classList.remove('hidden');
                    document.body.classList.add('modal-open');
                }

                function closeVerificationModalFunction() {
                    verificationsModal.classList.add('hidden');
                    document.body.classList.remove('modal-open');
                }

                // Clique nas miniaturas da galeria
                triggersV.forEach((trigger, index) => {
                    trigger.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.documentsGallery.openGallery(index);
                    });
                });


                // Fechar modal por botão, clique fora ou tecla ESC
                if (closeVerificationsModal) {
                    closeVerificationsModal.addEventListener('click', closeVerificationModalFunction);
                }

                if (verificationsModal) {
                    verificationsModal.addEventListener('click', function (e) {
                        if (e.target === verificationsModal) {
                            closeVerificationModalFunction();
                        }
                    });
                }

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !verificationsModal.classList.contains('hidden')) {
                        closeVerificationModalFunction();
                    }
                });

                // Abrir galeria ao clicar em fotos dentro do modal
                verificationPhotoItems.forEach(item => {
                    item.addEventListener('click', function () {
                        const index = parseInt(this.dataset.index);
                        closeVerificationModalFunction();
                        setTimeout(() => {
                            window.documentsGallery.openGallery(index);
                        }, 100);
                    });
                });
                @endif

                @if($verification->verification_advertiser_state === 0)
                // Lógica de Aprovação/Rejeição
                const approveBtn = document.getElementById('approve-btn');
                const rejectBtn = document.getElementById('reject-btn');
                const commentsField = document.getElementById('verification-comments');

                approveBtn.addEventListener('click', function () {
                    updateVerificationState(1);
                });

                rejectBtn.addEventListener('click', function () {
                    updateVerificationState(2);
                });

                function updateVerificationState(state) {
                    const comments = commentsField ? commentsField.value : '';
                    const isApprove = state === 1;

                    // Mostrar modal de confirmação personalizado
                    const confirmModal = document.createElement('div');
                    confirmModal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center animate-fade-in';
                    confirmModal.id = 'confirmStateModal';

                    const modalContent = `
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
                            <div class="p-5 ${isApprove ? 'bg-green-50' : 'bg-red-50'}">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi ${isApprove ? 'bi-check-circle text-green-500' : 'bi-x-circle text-red-500'} text-xl"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium ${isApprove ? 'text-green-800' : 'text-red-800'}">
                                            ${isApprove ? 'Aprovar Verificação' : 'Rejeitar Verificação'}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-700 mb-4">
                                    Tem certeza que deseja ${isApprove ? 'APROVAR' : 'REJEITAR'} esta verificação?
                                </p>
                                <div class="flex justify-end gap-3">
                                    <button id="cancelStateBtn" class="btn-secondary px-4 py-2 text-sm">
                                        Cancelar
                                    </button>
                                    <button id="confirmStateBtn" class="${isApprove ? 'btn-success' : 'btn-warning'} text-white px-4 py-2 rounded text-sm font-medium">
                                        ${isApprove ? 'Sim, Aprovar' : 'Sim, Rejeitar'}
                                    </button>
                                </div>
                            </div>
                        </div>`;

                    confirmModal.innerHTML = modalContent;
                    document.body.appendChild(confirmModal);
                    document.body.classList.add('overflow-hidden');

                    // Adicionar handlers de eventos
                    document.getElementById('cancelStateBtn').addEventListener('click', () => {
                        closeConfirmModal();
                    });

                    document.getElementById('confirmStateBtn').addEventListener('click', () => {
                        closeConfirmModal();
                        proceedWithUpdate(state, comments);
                    });

                    // Fechar ao clicar fora do modal
                    confirmModal.addEventListener('click', (e) => {
                        if (e.target === confirmModal) {
                            closeConfirmModal();
                        }
                    });

                    // Fechar ao pressionar ESC
                    document.addEventListener('keydown', function escHandler(e) {
                        if (e.key === 'Escape') {
                            closeConfirmModal();
                            document.removeEventListener('keydown', escHandler);
                        }
                    });

                    function closeConfirmModal() {
                        confirmModal.classList.add('opacity-0');
                        setTimeout(() => {
                            document.body.removeChild(confirmModal);
                            document.body.classList.remove('overflow-hidden');
                        }, 200);
                    }

                    function proceedWithUpdate(state, comments) {
                        approveBtn.disabled = true;
                        rejectBtn.disabled = true;

                        const activeBtn = state === 1 ? approveBtn : rejectBtn;
                        const originalText = activeBtn.innerHTML;
                        activeBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Processando...';

                        // Continuação do seu código original para enviar a requisição...
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('/moderation/verification-advertisers/{{ $verification->id }}/update-state', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                state: state,
                                comments: comments
                            })
                        })
                            .then(response => {
                                // Verificar primeiro se a resposta é JSON antes de tentar fazer o parse
                                const contentType = response.headers.get('content-type');
                                if (contentType && contentType.includes('application/json')) {
                                    return response.json().then(data => {
                                        if (data.success) {
                                            // Se tiver um redirecionamento, usar
                                            if (data.redirect) {
                                                window.location.href = data.redirect;
                                            } else {
                                                alert(`Verificação ${state === 1 ? 'aprovada' : 'rejeitada'} com sucesso!`);
                                                window.location.reload();
                                            }
                                        } else {
                                            alert('Erro ao atualizar: ' + (data.message || 'Erro desconhecido'));
                                        }
                                    });
                                } else {
                                    // Se a resposta não for JSON, redirecionar para a página principal de moderação
                                    window.location.href = "{{ route('moderation') }}";
                                }
                            })
                            .catch(error => {
                                console.error('Erro:', error);
                                alert('Erro ao processar. Por favor, tente novamente.');
                            })
                            .finally(() => {
                                approveBtn.disabled = false;
                                rejectBtn.disabled = false;
                                activeBtn.innerHTML = originalText;
                            });
                    }
                }
                @endif
            });
        </script>
    @endif
@endsection
