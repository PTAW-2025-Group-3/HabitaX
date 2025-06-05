@props(['address', 'mapUrl', 'githubUrl'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <!-- Mapa -->
        <div class="h-[100%] min-h-[300px] relative">
            <iframe
                src="{{ $mapUrl }}"
                class="w-full h-full absolute inset-0 border-0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <!-- Informações de contato -->
        <div class="p-6 bg-gradient-to-br from-white to-gray-50 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-secondary mb-3 flex items-center">
                    <i class="bi bi-geo-alt-fill mr-2"></i>
                    Localização
                </h3>
                <p class="text-gray-700 mb-4 text-sm leading-relaxed">{{ $address }}</p>

                <div class="flex flex-col gap-3 mt-4">
                    <div class="flex items-center gap-2 text-gray-700 text-sm">
                        <i class="bi bi-mortarboard text-secondary"></i>
                        <span>Curso: Tecnologias de Informação</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-700 text-sm">
                        <i class="bi bi-calendar3 text-secondary"></i>
                        <span>2º Ano, 2º Semestre</span>
                    </div>
                </div>

                <!-- Agradecimento -->
                <div class="mt-5 pt-4 border-t border-gray-200">
                    <h4 class="font-bold text-secondary mb-2">Agradecimentos aos Professores:</h4>
                    <div class="bg-gradient-to-r from-primary/10 to-secondary/10 p-3 rounded-lg">
                        <p class="text-gray-700 text-sm italic font-medium text-center">
                            "Compilaram conhecimento, debugaram dúvidas — e nunca deram crash. Obrigado!"
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ $githubUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="group relative w-full flex items-center justify-center gap-2 bg-secondary text-white py-3 px-4 rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <i class="bi bi-github text-xl relative z-10"></i>
                    <span class="relative z-10 font-medium text-sm">Projeto no GitHub</span>
                </a>
            </div>
        </div>
    </div>
</div>
