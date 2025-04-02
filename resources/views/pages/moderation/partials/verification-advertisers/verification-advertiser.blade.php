@extends('layout.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mb-6">
                <div class="bg-blue-600 text-white p-6">
                    <h3 class="text-2xl font-bold text-center mb-2">Verificação de Anunciante</h3>
                    <div class="flex justify-center">
                        <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Pendente</span>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informações do Anunciante
                    </h4>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nome Completo</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                                <input type="text" value="Ana Sofia Cardoso" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                                <input type="text" value="anasofiacardoso@gmail.com" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Telefone</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                                <input type="text" value="+351 912 345 678" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-700" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tipo de Documento</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                            Documento de Identificação
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-md overflow-hidden mb-4">
                            <img src="https://dusseldorf.consuladoportugal.mne.gov.pt/images/cc_frente_e_verso.jpg?c2e158e2a102405db627791d8d308fd9" alt="Documento de Identificação" class="w-full h-full object-cover" />
                        </div>

                        <div class="flex space-x-3">
                            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium text-sm flex items-center justify-center transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </button>
                            <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md font-medium text-sm flex items-center justify-center transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Ampliar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Selfie with ID -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <h4 class="text-lg font-semibold p-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Selfie com Documento
                        </h4>
                    </div>
                    <div class="p-6">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-md overflow-hidden mb-4">
                            <img src="https://www.totvs.com/wp-content/uploads/2023/12/selfie-com-documento.jpg" alt="Selfie com Documento" class="w-full h-full object-cover object-center" />
                        </div>

                        <div class="flex space-x-3">
                            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium text-sm flex items-center justify-center transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </button>
                            <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md font-medium text-sm flex items-center justify-center transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Checklist de Verificação
                    </h4>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <input id="check1" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check1" class="ml-2 text-gray-700">Documento legível e válido</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check2" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check2" class="ml-2 text-gray-700">Informações do documento correspondem ao registo</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check3" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check3" class="ml-2 text-gray-700">Selfie mostra claramente o rosto do utilizador</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check4" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check4" class="ml-2 text-gray-700">O documento na selfie corresponde ao documento enviado</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check5" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check5" class="ml-2 text-gray-700">Não há sinais de manipulação nos documentos</label>
                        </div>
                        <div class="flex items-start">
                            <input id="check6" type="checkbox" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="check6" class="ml-2 text-gray-700">Documento não expirado</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decision Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <div class="border-b border-gray-200">
                    <h4 class="text-lg font-semibold p-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Decisão de Verificação
                    </h4>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Comentário/Justificação</label>
                        <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white" rows="3" placeholder="Adicione um comentário ou justificação para a sua decisão..."></textarea>
                    </div>

                    <div class="flex justify-center space-x-4">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-md font-medium flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Aprovar Verificação
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-md font-medium flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Rejeitar Verificação
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
