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
                        <i class="bi bi-house-door text-gray-600 me-2"></i>
                        <span class="font-medium">Apartamento T2 Porto</span>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
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
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-hash text-gray"></i>
                                </span>
                                <input type="text" value="#20250317-001" readonly class="bg-gray-100 border border-gray-300 rounded-r-md px-3 py-2 w-full focus:outline-none text-gray-secondary" />
                            </div>
                        </div>
                        <!-- Reporter Section -->
                        <div>
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Denunciante</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-person text-gray"></i>
                                </span>
                                <input type="text" value="Luís Assis" readonly class="bg-gray-100 border-t border-b border-gray-300 px-3 py-2 w-full focus:outline-none text-gray-secondary" />
                                <a href="mailto:luisassis@ua.pt" class="bg-gray-100 border border-l-0 border-gray-300 rounded-r-md px-3 flex items-center text-blue-600 hover:text-blue-800">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Reason Section -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray uppercase tracking-wide mb-1">Motivo da Denúncia</label>
                            <div class="flex">
                                <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 flex items-center">
                                    <i class="bi bi-exclamation-triangle text-gray"></i>
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
                        <i class="bi bi-check-lg me-2"></i>
                        Aprovar Denúncia
                    </button>
                    <button class="btn-warning px-6 py-2">
                        <i class="bi bi-x-lg me-2"></i>
                        Rejeitar Denúncia
                    </button>
                </div>
            </div>
            <!-- Additional Actions Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 mt-6">
                <div class="p-6">
                    <h5 class="text-lg font-semibold mb-4 flex items-center text-gray-secondary">
                        <i class="bi bi-gear me-2 text-gray"></i>
                        Ações Adicionais
                    </h5>
                    <div class="flex flex-wrap gap-2">
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <i class="bi bi-envelope me-1"></i>
                            Contactar Anunciante
                        </button>
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <i class="bi bi-envelope me-1"></i>
                            Contactar Denunciante
                        </button>
                        <button class="border border-gray-300 text-gray hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                            <i class="bi bi-clock-history me-1"></i>
                            Histórico de Reports do Anúncio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
