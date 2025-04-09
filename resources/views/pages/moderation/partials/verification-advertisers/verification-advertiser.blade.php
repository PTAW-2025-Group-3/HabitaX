@extends('layout.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mb-6">
                <div class="bg-primary text-white p-6">
                    <h3 class="text-2xl font-bold text-center mb-2">Verificação de Anunciante</h3>
                    <div class="flex justify-center">
                        <span class="bg-secondary text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Pendente</span>
                    </div>
                    <div class="flex justify-center items-center space-x-6 mt-4 text-sm">
                        <div>
                            <span class="text-blue-200 block">Data de Submissão</span>
                            <span class="font-semibold">15/03/2025</span>
                        </div>
                        <div>
                            <span class="text-blue-200 block">ID da Submissão</span>
                            <span class="font-semibold">#VRF-20250315-134</span>
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
                                <input type="text" value="Ana Sofia Cardoso" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Email</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-envelope text-gray"></i>
                                </span>
                                <input type="text" value="anasofiacardoso@gmail.com" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Telefone</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-telephone text-gray"></i>
                                </span>
                                <input type="text" value="+351 912 345 678" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Tipo de Documento</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-card-text text-gray"></i>
                                </span>
                                <input type="text" value="Cartão de Cidadão" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Verification - Improved Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- ID Document -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <h4 class="text-lg font-semibold p-4 flex items-center">
                            <i class="bi bi-card-heading me-2 text-gray"></i>
                            Documento de Identificação
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-md overflow-hidden mb-4">
                            <img src="https://dusseldorf.consuladoportugal.mne.gov.pt/images/cc_frente_e_verso.jpg?c2e158e2a102405db627791d8d308fd9" alt="Documento de Identificação" class="w-full h-full object-cover" />
                        </div>

                        <div class="flex space-x-3">
                            <button class="flex-1 btn-primary px-4 py-2">
                                <i class="bi bi-download me-1"></i>
                                Download
                            </button>
                            <button class="flex-1 btn-gray px-4 py-2">
                                <i class="bi bi-search me-1"></i>
                                Ampliar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Selfie with ID -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <h4 class="text-lg font-semibold p-4 flex items-center">
                            <i class="bi bi-camera me-2 text-gray"></i>
                            Selfie com Documento
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-md overflow-hidden mb-4">
                            <img src="https://www.totvs.com/wp-content/uploads/2023/12/selfie-com-documento.jpg" alt="Selfie com Documento" class="w-full h-full object-cover object-center" />
                        </div>

                        <div class="flex space-x-3">
                            <button class="flex-1 btn-primary px-4 py-2">
                                <i class="bi bi-download me-1"></i>
                                Download
                            </button>
                            <button class="flex-1 btn-gray px-4 py-2">
                                <i class="bi bi-search me-1"></i>
                                Ampliar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Checklist -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mb-6">
                <div class="border-b border-gray-200">
                    <h4 class="text-lg font-semibold p-4 flex items-center">
                        <i class="bi bi-clipboard-check me-2 text-gray"></i>
                        Checklist de Verificação
                    </h4>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <input id="check1" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check1" class="ms-2 text-gray-700">Documento legível e válido</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check2" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check2" class="ms-2 text-gray-700">Informações do documento correspondem ao registo</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check3" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check3" class="ms-2 text-gray-700">Selfie mostra claramente o rosto do utilizador</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check4" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check4" class="ms-2 text-gray-700">O documento na selfie corresponde ao documento enviado</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check5" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check5" class="ms-2 text-gray-700">Não há sinais de manipulação nos documentos</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check6" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check6" class="ms-2 text-gray-700">Documento não expirado</label>
                        </div>
                    </div>
                </div>
            </div>

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
                        <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white" rows="3" placeholder="Adicione um comentário ou justificação para a sua decisão..."></textarea>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <button class="btn-success px-8 py-3">
                            <i class="bi bi-check-lg me-2"></i>
                            Aprovar Verificação
                        </button>
                        <button class="btn-warning px-8 py-3">
                            <i class="bi bi-x-lg me-2"></i>
                            Rejeitar Verificação
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
