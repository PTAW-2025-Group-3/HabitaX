@extends('pages.account.account')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <h1 class="text-2xl font-bold text-primary mb-6">Verificação de Anunciante</h1>
        <p class="text-gray mb-6">
            Para garantir a segurança e confiabilidade na nossa plataforma, precisamos verificar a sua identidade.
            Por favor, carregue os documentos solicitados abaixo.
        </p>

        <form action="/account/verification" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Documento de Identificação -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-primary mb-3">1. Documento de Identificação</h2>
                <p class="text-gray mb-4">Carregue uma foto clara do seu documento de identificação (frente e verso, se aplicável).</p>

                <div class="mb-4">
                    <label for="id_type" class="block text-gray-secondary font-medium mb-2">Tipo de Documento</label>
                    <div class="relative dropdown-wrapper">
                        <select id="id_type" name="id_type" class="dropdown-select py-2 pl-4 pr-10 w-full h-10">
                            <option value="" disabled selected>Selecione o tipo de documento</option>
                            <option value="cc">Cartão de Cidadão (CC)</option>
                            <option value="passport">Passaporte</option>
                            <option value="driver">Carta de Condução</option>
                            <option value="other">Outro</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                        </div>
                    </div>

                    @error('id_type')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Upload do Documento - Frente -->
                    <div class="flex-1 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer" id="id_front_container">
                        <input type="file" name="id_front" id="id_front" class="hidden" accept="image/*">
                        <div class="id-preview-container hidden mb-3">
                            <img id="id_front_preview" class="max-h-48 mx-auto rounded-lg" src="#" alt="Preview">
                        </div>
                        <div class="upload-prompt">
                            <i class="bi bi-upload text-secondary  text-3xl mb-2"></i>
                            <p class="font-medium text-gray-secondary">Frente do documento</p>
                            <p class="text-sm text-gray mt-1">Clique para escolher ou arraste o arquivo aqui</p>
                        </div>
                    </div>

                    <!-- Upload do Documento - Verso (se aplicável) -->
                    <div class="flex-1 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer" id="id_back_container">
                        <input type="file" name="id_back" id="id_back" class="hidden" accept="image/*">
                        <div class="id-preview-container hidden mb-3">
                            <img id="id_back_preview" class="max-h-48 mx-auto rounded-lg" src="#" alt="Preview">
                        </div>
                        <div class="upload-prompt">
                            <i class="bi bi-upload text-secondary text-3xl mb-2"></i>
                            <p class="font-medium text-gray-secondary">Verso do documento</p>
                            <p class="text-sm text-gray mt-1">Clique para escolher ou arraste o arquivo aqui</p>
                        </div>
                    </div>
                </div>
                @error('id_front')
                    <p class="text-red text-sm mt-2">{{ $message }}</p>
                @enderror
                @error('id_back')
                    <p class="text-red text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Selfie com Documento -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray">
                <h2 class="text-xl font-semibold text-primary mb-3">2. Selfie com Documento</h2>
                <p class="text-gray mb-4">Tire uma selfie segurando seu documento de identificação visível ao lado do rosto.</p>

                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer" id="selfie_container">
                    <input type="file" name="selfie" id="selfie" class="hidden" accept="image/*">
                    <div class="selfie-preview-container hidden mb-3">
                        <img id="selfie_preview" class="max-h-64 mx-auto rounded-lg" src="#" alt="Preview">
                    </div>
                    <div class="upload-prompt">
                        <i class="bi bi-camera text-secondary text-3xl mb-2"></i>
                        <p class="font-medium text-gray-secondary">Selfie com documento</p>
                        <p class="text-sm text-gray mt-1">Clique para escolher ou arraste o arquivo aqui</p>
                    </div>
                </div>
                @error('selfie')
                    <p class="text-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Diretrizes e dicas -->
            <div class="bg-blue-50 rounded-lg p-5 border border-blue-200">
                <h3 class="font-semibold text-primary flex items-center">
                    <i class="bi bi-info-circle-fill mr-2"></i> Dicas para aprovação rápida
                </h3>
                <ul class="text-primary text-sm mt-2 space-y-1 pl-6 list-disc">
                    <li>Certifique-se que o documento está completamente visível e legível</li>
                    <li>Evite reflexos, sombras ou dedos cobrindo informações importantes</li>
                    <li>Na selfie, seu rosto e o documento devem estar claramente visíveis</li>
                    <li>Envie imagens com boa iluminação e qualidade</li>
                </ul>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" class="btn-gray py-2 px-6">Cancelar</button>
                <button type="submit" class="btn-primary py-2 px-6">Enviar Verificação</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Função para configurar os uploads
        function setupFileUpload(inputId, previewId, containerId) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(containerId);
            const preview = document.getElementById(previewId);
            const previewContainer = preview.parentElement;

            // Evento de clique no container
            container.addEventListener('click', () => {
                input.click();
            });

            // Evento de alteração de arquivo
            input.addEventListener('change', (e) => {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        container.querySelector('.upload-prompt').classList.add('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Configuração para drag and drop
            ['dragover', 'dragenter'].forEach(eventName => {
                container.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    container.classList.add('border-indigo-500', 'bg-indigo-50');
                }, false);
            });

            ['dragleave', 'dragend', 'drop'].forEach(eventName => {
                container.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    container.classList.remove('border-indigo-500', 'bg-indigo-50');
                }, false);
            });

            container.addEventListener('drop', (e) => {
                e.preventDefault();
                input.files = e.dataTransfer.files;

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        container.querySelector('.upload-prompt').classList.add('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }, false);
        }

        // Inicializar os uploads quando a página carregar
        document.addEventListener('DOMContentLoaded', () => {
            setupFileUpload('id_front', 'id_front_preview', 'id_front_container');
            setupFileUpload('id_back', 'id_back_preview', 'id_back_container');
            setupFileUpload('selfie', 'selfie_preview', 'selfie_container');
        });
    </script>
    @endpush
@endsection
