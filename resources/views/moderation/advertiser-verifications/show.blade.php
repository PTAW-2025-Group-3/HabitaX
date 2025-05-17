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
                                <a href="{{ route('advertiser-verifications.index') }}" class="text-gray-500 hover:text-primary">
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
                                <input type="text" value="{{ $verification->submitter->name ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Email</label>
                            <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                        <i class="bi bi-envelope text-gray"></i>
                    </span>
                                <input type="text" value="{{ $verification->submitter->email ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Telefone</label>
                            <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                        <i class="bi bi-telephone text-gray"></i>
                    </span>
                                <input type="text" value="{{ $verification->submitter->telephone ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Nº Contribuinte</label>
                            <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                        <i class="bi bi-card-text text-gray"></i>
                    </span>
                                <input type="text" value="{{ $verification->submitter->nif ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Tipo de Documento</label>
                            <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                        <i class="bi bi-card-text text-gray"></i>
                    </span>
                                <input type="text" value="{{ $verification->submitter->document_type->name ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Nº de Documento</label>
                            <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                        <i class="bi bi-card-text text-gray"></i>
                    </span>
                                <input type="text" value="{{ $verification->submitter->document_number ?? 'N/A' }}" readonly
                                       class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700"/>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de documentação integrados -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Botão de Documentos -->
                            <div id="documents-gallery" class="gallery-container w-full">
                                @if($verification->hasMedia('documents'))
                                    @php $documentsCount = $verification->getMedia('documents')->count(); @endphp
                                    <button id="view-documents-btn" class="btn-primary px-5 py-2.5 flex items-center justify-center w-full">
                                        <i class="bi bi-images me-2"></i>
                                        Ver Documentação
                                        <span class="ml-2 bg-white text-primary rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">{{ $documentsCount }}</span>
                                    </button>
                                @else
                                    <button disabled class="btn-secondary px-5 py-2.5 opacity-75 flex items-center justify-center w-full">
                                        <i class="bi bi-images me-2"></i>
                                        Sem Documentos
                                    </button>
                                @endif
                            </div>

                            <!-- Botão de Verificação de Identidade -->
                            <div id="verifications-gallery" class="gallery-container w-full">
                                @if($verification->hasMedia('identity_verifications'))
                                    @php $verificationsCount = $verification->getMedia('identity_verifications')->count(); @endphp
                                    <button id="view-verifications-btn" class="btn-primary px-5 py-2.5 flex items-center justify-center w-full">
                                        <i class="bi bi-card-checklist me-2"></i>
                                        Ver Verificação de Identidade
                                        <span class="ml-2 bg-white text-primary rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">{{ $verificationsCount }}</span>
                                    </button>
                                @else
                                    <button disabled class="btn-secondary px-5 py-2.5 opacity-75 flex items-center justify-center w-full">
                                        <i class="bi bi-card-checklist me-2"></i>
                                        Sem Verificação de Identidade
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
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
                            <textarea id="verification-comments"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white"
                                      rows="3"
                                      placeholder="Adicione um comentário ou justificação para a sua decisão..."></textarea>
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
                                <p class="text-xs uppercase text-gray-500 font-semibold mb-2">Comentários do
                                    Validador</p>
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
@endsection

@push('scripts')
    @if($verification->hasMedia('documents') || $verification->hasMedia('identity_verifications') || $verification->verification_advertiser_state === 0)
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                @if($verification->hasMedia('documents'))
                // Configuração para documentos enviados
                const documents = @json($verification->getMedia('documents')->map(function($document) {
                    return [
                        'src' => $document->getUrl(),
                        'thumb' => $document->getUrl('preview')
                    ];
                }));

                const viewDocumentsBtn = document.getElementById('view-documents-btn');

                // Inicializar lightGallery para documentos
                const documentsGallery = lightGallery(document.getElementById('documents-gallery'), {
                    dynamic: true,
                    plugins: [lgThumbnail, lgZoom],
                    download: true,
                    hideScrollbar: true,
                    zoom: true,
                    speed: 500,
                    dynamicEl: documents
                });

                // Abrir lightGallery ao clicar no botão
                viewDocumentsBtn.addEventListener('click', function () {
                    documentsGallery.openGallery(0);
                });
                @endif

                @if($verification->hasMedia('identity_verifications'))
                // Configuração para verificação de identidade
                const verifications = @json($verification->getMedia('identity_verifications')->map(function($document) {
                    return [
                        'src' => $document->getUrl(),
                        'thumb' => $document->getUrl('preview')
                    ];
                }));

                const viewVerificationsBtn = document.getElementById('view-verifications-btn');

                // Inicializar lightGallery para verificações
                const verificationsGallery = lightGallery(document.getElementById('verifications-gallery'), {
                    dynamic: true,
                    plugins: [lgThumbnail, lgZoom],
                    hideScrollbar: true,
                    download: true,
                    zoom: true,
                    speed: 500,
                    dynamicEl: verifications
                });

                // Abrir lightGallery ao clicar no botão
                viewVerificationsBtn.addEventListener('click', function () {
                    verificationsGallery.openGallery(0);
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

                    fetch('/moderation/advertiser-verifications/{{ $verification->id }}/update-state', {
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
                                window.location.href = "{{ route('advertiser-verifications.index') }}";
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
        @endif
    </script>
@endpush
