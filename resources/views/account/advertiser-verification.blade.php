@extends('account.account-layout')

@section('title', 'Verificação de Anunciante')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
        <h1 class="text-2xl font-bold text-primary mb-6">Verificação de Anunciante</h1>
        <p class="text-gray mb-6">
            Para garantir a segurança e confiabilidade na nossa plataforma, precisamos verificar a sua identidade.
            Por favor, carregue os documentos solicitados abaixo.
        </p>

        <form action="{{ route('advertiser-verifications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Documento de Identificação -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-primary mb-3">1. Documento de Identificação</h2>

                <div class="mb-4">
                    <label for="document_type_id" class="block text-gray-secondary font-medium mb-2">Tipo de Documento</label>
                    <div class="relative dropdown-wrapper">
                        <select id="document_type_id" name="document_type_id" class="dropdown-select py-2 pl-4 pr-10 w-full h-10">
                            <option value="" disabled {{ old('document_type_id') ? '' : 'selected' }}>Selecione o tipo de documento</option>
                            @foreach($documentTypes as $documentType)
                                <option value="{{ $documentType->id }}" {{ old('document_type_id') == $documentType->id ? 'selected' : '' }}>
                                    {{ $documentType->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                        </div>
                    </div>
                    @error('document_type_id')
                    <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="document_number" class="block text-gray-secondary font-medium mb-2">Número do Documento</label>
                    <input type="text" name="document_number" id="document_number"
                           class="form-input w-full mt-2"
                           value="{{ old('document_number') }}" required
                           placeholder="Número do documento">
                    @error('document_number')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nif" class="block text-gray-secondary font-medium mb-2">Numero do Contribuinte</label>
                    <input type="number" name="nif" id="nif"
                           class="form-input w-full mt-2"
                           value="{{ old('document_number') }}" required
                           placeholder="Número do documento">
                    @error('nif')
                    <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload do Documentos -->
                @php
                    $uploadedDocuments = old('uploaded_documents', []);
                @endphp
                <div class="mb-4">
                    <label for="documents" class="block text-gray-secondary font-medium mb-2">Carregar Documentos</label>
                    <div class="filepond-wrapper">
                        <input type="file"
                               name="file"
                               class="filepond"
                                 id="documents-upload"
                               multiple
                        >
                        <div id="hidden-uploaded-documents">
                            @foreach($uploadedDocuments as $document)
                                <input type="hidden" name="uploaded_documents[]" value="{{ $document }}">
                            @endforeach
                        </div>
                    </div>
                    @error('documents')
                        <p class="text-red text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Selfie com Documento -->
            @php
                $uploadedSelfies = old('uploaded_selfies', []);
            @endphp
            <div class="bg-gray-50 rounded-lg p-6 border border-gray">
                <h2 class="text-xl font-semibold text-primary mb-3">2. Verificação da Identidade</h2>
                <p class="text-gray mb-4">Tire uma selfie segurando seu documento de identificação visível ao lado do rosto.</p>

                <div class="filepond-wrapper">
                    <input type="file"
                           name="file"
                           class="filepond"
                           id="selfie-upload"
                           multiple
                    >
                    <div id="hidden-uploaded-selfies">
                        @foreach($uploadedSelfies as $selfie)
                            <input type="hidden" name="uploaded_selfies[]" value="{{ $selfie }}">
                        @endforeach
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
                @if(isset($verifications) && count($verifications) > 0)
                    <a href="{{ route('advertiser-verifications.list') }}" class="btn-gray py-2 px-6 inline-block text-center">Cancelar</a>
                @endif
                <button type="submit" class="btn-primary py-2 px-6">Enviar Verificação</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const uploadedDocuments = document.getElementById('hidden-uploaded-documents');
            const uploadedSelfies = document.getElementById('hidden-uploaded-selfies');

            function createHiddenInput(target, name, value) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                target.appendChild(input);
            }

            function removeHiddenInputByName(target, name) {
                const inputs = target.querySelectorAll(`input[name="${target.id === 'hidden-uploaded-documents' ? 'uploaded_documents[]' : 'uploaded_selfies[]'}"]`);
                for (const input of inputs) {
                    if (input.value === name) {
                        input.remove();
                        console.log(`Removed input for ${name}`);
                        return;
                    }
                }
                console.warn('No input found for:', name);
            }

            function initPond(inputSelector, targetWrapper, fieldName, existingFiles = []) {
                FilePond.create(document.querySelector(inputSelector), {
                    maxFiles: 5,
                    maxFileSize: '5MB',
                    allowMultiple: true,
                    allowReorder: true,
                    acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                    labelIdle: 'Arraste e solte suas imagens ou <span class="filepond--label-action">Selecione</span>',
                    server: {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        process: {
                            url: '/uploads/process',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                const filename = response.replace(/^["']+|["']+$/g, '');
                                createHiddenInput(targetWrapper, fieldName, filename);
                                return filename;
                            },
                            onerror: (error) => {
                                console.error('Upload failed:', error);
                            }
                        },
                        revert: {
                            url: '/uploads/revert',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }
                    },
                    files: existingFiles.map(file => ({
                        source: file,
                        options: {
                            type: 'local'
                        }
                    })),
                    onreorderfiles: (files) => {
                        targetWrapper.innerHTML = '';

                        files.forEach(file => {
                            createHiddenInput(targetWrapper, fieldName, file.serverId || file.source || file.file?.name);
                        });
                    },
                    onremovefile: (error, file) => {
                        const name = file?.file?.name;
                        if (name) {
                            removeHiddenInputByName(targetWrapper, name);
                        }
                    },
                    onerror: (error) => {
                        console.error('Upload error:', error);
                    }
                });
            }

            initPond('#documents-upload', uploadedDocuments, 'uploaded_documents[]', @json($uploadedDocuments));
            initPond('#selfie-upload', uploadedSelfies, 'uploaded_selfies[]', @json($uploadedSelfies));
        });
    </script>
@endpush
