@extends('layout.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="bg-primary text-white p-6">
                    <h3 class="text-2xl font-bold text-center mb-2">Revisão do Report</h3>
                    <div class="flex justify-center">
                        <span class="bg-secondary text-white px-4 py-1 rounded-full text-sm font-semibold">Estado Atual: Em Análise</span>
                    </div>
                    <div class="flex justify-center items-center space-x-6 mt-4 text-sm">
                        <div>
                            <span class="text-blue-200 block">Data</span>
                            <span class="font-semibold">27/02/2025</span>
                        </div>
                        <div>
                            <span class="text-blue-200 block">Hora</span>
                            <span class="font-semibold">17:56h</span>
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="bg-gray-50 border-b border-gray-200 p-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium">Apartamento T2 Porto</span>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
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
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </span>
                                <input type="text" value="#20250317-001" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-secondary" />
                            </div>
                        </div>

                        <!-- Reporter Section -->
                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Denunciante</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                                <input type="text" value="Luís Assis" readonly class="bg-gray-100 border-t border-b border-gray-300 px-3 py-2 w-full focus:outline-none text-gray-secondary" />
                                <a href="mailto:luisassis@ua.pt" class="bg-gray-100 border border-l-0 border-gray-300 rounded-r-md px-3 flex items-center text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Reason Section -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Motivo da Denúncia</label>
                            <div class="flex">
                            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                                <input type="text" value="Conteúdo Inapropriado" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-secondary" />
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Descrição do Report</label>
                            <div class="bg-gray-100 border border-gray-300 rounded-md p-4 text-gray-secondary">
                                <p>O anúncio contém imagens e descrições enganosas que não correspondem ao imóvel real. Além disso, há informações contraditórias no valor do aluguel.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="border-t border-gray-200 bg-gray-50 p-6 flex justify-center space-x-4">
                    <button class="btn-success px-6 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Aprovar Denúncia
                    </button>
                    <button class="btn-warning px-6 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Rejeitar Denúncia
                    </button>
                </div>
            </div>
            <!-- Additional Actions Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mt-6">
                <div class="p-6">
                    <h5 class="text-lg font-semibold mb-4 flex items-center text-gray-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Ações Adicionais
                    </h5>
                    <div class="flex flex-wrap gap-2">
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contactar Anunciante
                        </button>
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contactar Denunciante
                        </button>
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Histórico de Reports do Anúncio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
