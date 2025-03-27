<div class="w-full md:w-1/4">
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="font-bold text-2xl mb-6 text-blue-900 text-center">Filtros</h2>

        <!-- Map View Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ver no Mapa
            </h3>
            <div class="w-full h-48 bg-gray-200 rounded-lg overflow-hidden relative">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49369.99053093508!2d-8.661563!3d40.641013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd23b8ac5643d6d5%3A0x4da7817b0ddf00f4!2sAveiro!5e0!3m2!1spt-PT!2spt!4v1711570225305!5m2!1spt-PT!2spt"
                    class="absolute top-0 left-0 w-full h-full border-0"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
                <button
                    class="absolute bottom-2 right-2 bg-blue-700 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-800 transition-colors">
                    Expandir
                </button>
            </div>
        </div>

        <!-- Quartos Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Quartos
            </h3>
            <div class="grid grid-cols-5 gap-2 filter-group">
                <button data-selected class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">All</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors">1+</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors">2+</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors">3+</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors">4+</button>
            </div>
        </div>

        <!-- Casas de Banho Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Casas de Banho
            </h3>
            <div class="grid grid-cols-4 gap-2 filter-group" data-filter-type="default">
                <button data-selected class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">All</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">1+</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">2+</button>
                <button class="py-2 px-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">3+</button>
            </div>
        </div>

        <!-- Estado Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                </svg>
                Estado
            </h3>
            <div class="space-y-2 filter-group" data-filter-type="light">
                <button data-selected class="w-full py-2 px-4 border-2 border-gray-300 text-gray-700 bg-white rounded-lg font-medium text-left hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">Qualquer</button>
                <button class="w-full py-2 px-4 border-2 border-gray-300 text-gray-700 bg-white rounded-lg font-medium text-left hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">Novo/Renovado</button>
                <button class="w-full py-2 px-4 border-2 border-gray-300 text-gray-700 bg-white rounded-lg font-medium text-left hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">Usado</button>
                <button class="w-full py-2 px-4 border-2 border-gray-300 text-gray-700 bg-white rounded-lg font-medium text-left hover:border-blue-700 hover:bg-blue-50 transition-colors focus:outline-none">Para Renovar</button>
            </div>
        </div>

        <!-- Divider -->
        <div class="w-full h-px bg-gray-200 my-6"></div>

        <!-- Publicação Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Publicação
            </h3>
            <div class="relative">
                <select
                    class="w-full p-3 bg-white border-2 border-gray-300 rounded-lg appearance-none text-gray-800 pr-10">
                    <option>Últimas 24 horas</option>
                    <option>Últimos 3 dias</option>
                    <option>Última semana</option>
                    <option>Último mês</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Preço Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Preço
            </h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <select
                        class="w-full p-3 bg-white border-2 border-gray-300 rounded-lg appearance-none text-gray-800 pr-10">
                        <option>Mínimo</option>
                        <option>100.000€</option>
                        <option>200.000€</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <select
                        class="w-full p-3 bg-white border-2 border-gray-300 rounded-lg appearance-none text-gray-800 pr-10">
                        <option>Máximo</option>
                        <option>500.000€</option>
                        <option>1.000.000€</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tamanho Filter -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
                Tamanho
            </h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <select
                        class="w-full p-3 bg-white border-2 border-gray-300 rounded-lg appearance-none text-gray-800 pr-10">
                        <option>Mínimo</option>
                        <option>50 m²</option>
                        <option>100 m²</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <select
                        class="w-full p-3 bg-white border-2 border-gray-300 rounded-lg appearance-none text-gray-800 pr-10">
                        <option>Máximo</option>
                        <option>200 m²</option>
                        <option>500 m²</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="w-full h-px bg-gray-200 my-6"></div>

        <!-- Amenities Filter -->
        <div class="mb-4">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Comodidades
            </h3>
            <div class="grid grid-cols-1 gap-3">
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="ac"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="ac" class="text-sm font-medium">Ar Condicionado</label>
                </div>
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="garagem"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="garagem" class="text-sm font-medium">Garagem</label>
                </div>
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="jardim"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="jardim" class="text-sm font-medium">Jardim</label>
                </div>
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="piscina"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="piscina" class="text-sm font-medium">Piscina</label>
                </div>
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="paineis"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="paineis" class="text-sm font-medium">Painéis Solares</label>
                </div>
                <div
                    class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <div class="w-5 mr-3 flex items-center justify-center">
                        <input type="checkbox" id="mobilidade"
                               class="h-5 w-5 text-blue-700 rounded border-gray-300 focus:ring-blue-500">
                    </div>
                    <label for="mobilidade" class="text-sm font-medium">Mobilidade Reduzida</label>
                </div>
            </div>
        </div>

        <!-- Apply Filters Button -->
        <div class="mt-8">
            <button
                class="w-full py-3 bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg shadow-md transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Aplicar Filtros
            </button>
        </div>
    </div>
</div>
<!-- Script para ativação de filtros -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.filter-group').forEach(group => {
            const type = group.dataset.filterType || 'default';
            const buttons = group.querySelectorAll('button');

            const applyActiveStyle = (button) => {
                if (type === 'light') {
                    button.classList.remove('border-gray-300', 'text-gray-700', 'hover:bg-blue-50');
                    button.classList.add('bg-blue-100', 'text-blue-900', 'border-blue-600');
                } else {
                    button.classList.remove('border-gray-300', 'text-gray-700', 'bg-white', 'hover:bg-blue-50');
                    button.classList.add('bg-blue-700', 'text-white', 'border-blue-700');
                    button.classList.remove('hover:text-white');
                }
            };

            const resetButtons = () => {
                buttons.forEach(b => {
                    b.classList.remove(
                        'bg-blue-700', 'text-white', 'border-blue-700',
                        'bg-blue-100', 'text-blue-900', 'border-blue-600',
                        'hover:bg-blue-50', 'hover:text-white'
                    );
                    b.classList.add('border-gray-300', 'text-gray-700', 'bg-white', 'hover:bg-blue-50');
                    b.blur();
                });
            };

            // Evento de clique
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    resetButtons();
                    applyActiveStyle(button);
                });
            });

            // Ativa botão com data-selected
            const preselected = group.querySelector('button[data-selected]');
            if (preselected) applyActiveStyle(preselected);
        });
    });
</script>


