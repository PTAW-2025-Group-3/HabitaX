@extends('account.account-layout')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 animate-fade-in">
        <div class="fixed top-0 left-0 w-full z-50">
            <div class="container mx-auto p-4">
                <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <h1 class="text-xl sm:text-2xl font-bold text-primary mb-4 sm:mb-6">Meu Perfil</h1>
        <p class="text-gray mb-4 sm:mb-6">
            Mantenha seus dados atualizados para melhorar sua experiência na plataforma.
        </p>

        <div class="space-y-6 sm:space-y-8">
            <!-- Informações de Perfil -->
            <div class="bg-gray-50 rounded-lg p-4 sm:p-5 border border-gray-200">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 sm:space-y-5" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="text-center sm:text-left">
                        <h3 class="text-xl font-medium text-primary">{{ auth()->user()->name }}</h3>
                        <p class="text-gray">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="mb-2">
                        <label for="file" class="block text-gray-secondary font-medium mb-2">Foto de perfil</label>
                        <input
                            type="file"
                            class="filepond"
                            name="file"
                            id="picture"
                        />
                        <div id="hidden-picture-input"></div>
                    </div>

                    <div>
                        <label for="name" class="block text-gray-secondary font-medium mb-2">Nome</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                               class="form-input w-full">
                        @error('name')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-gray-secondary font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                               class="form-input w-full">
                        @error('email')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone" class="block text-gray-secondary font-medium mb-2">Telefone</label>
                        <input type="tel" name="telephone" id="telephone" value="{{ auth()->user()->telephone ?? '' }}"
                               class="form-input w-full">
                        @error('telephone')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bio" class="block text-gray-secondary font-medium mb-2">Biografia</label>
                        <textarea name="bio" id="bio" rows="4"
                                  class="form-input w-full"
                                  placeholder="Conte um pouco sobre você...">{{ auth()->user()->bio ?? '' }}</textarea>
                        @error('bio')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center sm:justify-end">
                        <button type="submit" class="btn-primary py-2 px-6 w-full sm:w-auto">
                            Salvar alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .filepond--root {
            height: auto;
            max-width: 300px;
        }

        /* Reduzir o padding do topo na área de perfil */
        .bg-gray-50.rounded-lg {
            padding-top: 0 !important;
        }

        /* Reduzir espaçamento entre os elementos */
        .space-y-4 > * + * {
            margin-top: 1rem !important;
        }

        .space-y-5 > * + * {
            margin-top: 1.25rem !important;
        }
    </style>
@endpush

@push('scripts')
    @php
        $existingImage = auth()->user()?->getMedia('picture')->first();

        if ($existingImage) {
            $existingImage = [
                'source' => $existingImage->file_name,
                'name' => $existingImage->file_name,
                'size' => $existingImage->size,
                'type' => $existingImage->mime_type,
                'preview' => $existingImage->getUrl(),
            ];
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hiddenContainer = document.getElementById('hidden-picture-input');
            let currentInput = null;

            const createHiddenInput = (filename) => {
                if (!currentInput) {
                    currentInput = document.createElement('input');
                    currentInput.type = 'hidden';
                    currentInput.name = 'uploaded_picture';
                    hiddenContainer.appendChild(currentInput);
                }

                currentInput.value = filename;
            };

            const removeHiddenInput = () => {
                if (!currentInput) {
                    currentInput = document.createElement('input');
                    currentInput.type = 'hidden';
                    currentInput.name = 'uploaded_picture';
                    hiddenContainer.appendChild(currentInput);
                }

                currentInput.value = '';
            };

            const pondOptions = {
                maxFileSize: '2MB',
                allowImageCrop: true,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 300,
                imageResizeTargetHeight: 300,
                acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'],
                allowReplace: true,
                maxFiles: 1,
                labelIdle: 'Arraste e solte ou <span class="filepond--label-action">Selecione</span>',
                server: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: {
                        url: '{{ route('uploads.process') }}',
                        method: 'POST',
                        onload: (response) => {
                            const filename = response.replace(/^["']+|["']+$/g, '');
                            createHiddenInput(filename);
                            return filename;
                        },
                        onerror: (err) => {
                            console.error('Erro ao carregar ícone:', err);
                        }
                    },
                    revert: {
                        url: '{{ route('uploads.revert') }}',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        onload: removeHiddenInput
                    }
                },
                onremovefile: (error) => {
                    if (error) {
                        console.error('Erro ao remover arquivo:', error);
                    } else {
                        removeHiddenInput();
                    }
                },
                onerror: (error) => {
                    console.error('Erro ao carregar ícone:', error);
                }
            };

            const existingImage = @json($existingImage);
            if (existingImage) {
                createHiddenInput(existingImage.name);
                pondOptions.files = [{
                    source: existingImage.name,
                    options: {
                        type: 'local',
                        file: {
                            name: existingImage.name,
                            size: existingImage.size,
                            type: existingImage.type,
                        },
                        metadata: {
                            poster: existingImage.preview,
                        }
                    }
                }];
            }

            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
