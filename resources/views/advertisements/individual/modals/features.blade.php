@php use App\Enums\AttributeType; @endphp
<div id="all-features-modal" class="fixed inset-0 flex items-center justify-center z-50 overflow-y-auto animate-fade-in" style="display: none;">
    <div class="modal-overlay absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-3xl mx-auto rounded-xl shadow-lg z-50 overflow-hidden transform transition-all">
        <div class="modal-header flex justify-between items-center px-6 py-4 border-b border-gray-100">
            <h3 class="text-xl font-bold text-primary flex items-center gap-2">
                <i class="bi bi-grid-3x3-gap-fill text-secondary"></i>
                Todas as Características
            </h3>
            <button id="closeAllFeaturesModal" class="text-gray-400 hover:text-gray-700 focus:outline-none">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <div class="modal-content px-6 py-4 max-h-[70vh] overflow-y-auto">
            @foreach($groupedParameters as $groupId => $parameters)
                <div class="mb-6 last:mb-0">
                    <h4 class="text-md md:text-lg font-semibold mb-3 pb-1 border-b border-gray-100 text-secondary">
                        {{ $groups->get($groupId)?->name ?? 'Categoria desconhecida' }}
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                        @php
                            $path = 'advertisements.individual.parameters.';
                            $attributeIncludes = [
                                AttributeType::TEXT->value => $path. 'text',
                                AttributeType::LONG_TEXT->value => $path . 'long-text',
                                AttributeType::INT->value => $path . 'int',
                                AttributeType::FLOAT->value => $path . 'float',
                                AttributeType::BOOLEAN->value => $path . 'boolean',
                                AttributeType::DATE->value => $path . 'date',
                                AttributeType::SELECT_SINGLE->value => $path . 'select-single',
                                AttributeType::SELECT_MULTIPLE->value => $path . 'select-multiple',
                            ];

                            // Separa os LONG_TEXT dos restantes
                            [$longTexts, $others] = collect($parameters)->partition(
                                fn($p) => $p->attribute->type->value === \App\Enums\AttributeType::LONG_TEXT->value
                            );
                        @endphp

                        {{-- Renderiza primeiro os long texts, forçando uma linha inteira --}}
                        @foreach($longTexts as $parameter)
                            @if(isset($attributeIncludes[$parameter->attribute->type->value]))
                                <div class="w-full col-span-full">
                                    @include($attributeIncludes[$parameter->attribute->type->value], ['parameter' => $parameter])
                                </div>
                            @endif
                        @endforeach

                        {{-- Depois os restantes normalmente --}}
                        @foreach($others as $parameter)
                            @if(isset($attributeIncludes[$parameter->attribute->type->value]))
                                <div>
                                    @include($attributeIncludes[$parameter->attribute->type->value], ['parameter' => $parameter])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    // Adicione este script ao seu arquivo scripts existente ou crie um novo para o modal de características
    document.addEventListener('DOMContentLoaded', function () {
        const allFeaturesModal = document.getElementById('all-features-modal');
        const showAllFeaturesBtn = document.getElementById('showAllFeaturesBtn');
        const closeAllFeaturesModal = document.getElementById('closeAllFeaturesModal');

        function openAllFeaturesModal() {
            allFeaturesModal.style.display = 'flex';
            allFeaturesModal.classList.add('modal-visible');
        }

        function closeAllFeaturesModalFunction() {
            allFeaturesModal.style.display = 'none';
            allFeaturesModal.classList.remove('modal-visible');
        }

        if (showAllFeaturesBtn) {
            showAllFeaturesBtn.addEventListener('click', function() {
                openAllFeaturesModal();
            });
        }

        if (closeAllFeaturesModal) {
            closeAllFeaturesModal.addEventListener('click', function() {
                closeAllFeaturesModalFunction();
            });
        }

        if (allFeaturesModal) {
            allFeaturesModal.addEventListener('click', function(e) {
                if (e.target === allFeaturesModal || e.target.classList.contains('modal-overlay')) {
                    closeAllFeaturesModalFunction();
                }
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && allFeaturesModal && !allFeaturesModal.classList.contains('hidden')) {
                closeAllFeaturesModalFunction();
            }
        });
    });
</script>
