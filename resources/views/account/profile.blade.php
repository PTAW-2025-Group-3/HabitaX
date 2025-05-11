@extends('account.account-layout')

@section('account-content')
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 animate-fade-in">
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
                        <label for="image" class="block text-gray-secondary font-medium mb-2">Foto de perfil</label>
                        <input
                            type="file"
                            class="filepond"
                            name="image"
                            id="image"
                        />
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
                        <label for="phone" class="block text-gray-secondary font-medium mb-2">Telefone</label>
                        <input type="tel" name="phone" id="phone" value="{{ auth()->user()->phone ?? '' }}"
                               class="form-input w-full">
                        @error('phone')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        Document
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const existingImage = {!! auth()->user()->profile_picture_path ? json_encode(Storage::url(auth()->user()->profile_picture_path)) : 'null' !!};
            const pondOptions = {
                instantUpload: false,
                storeAsFile: true,
                allowReplace: true,
                allowImageCrop: true,
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
            };
            if (existingImage) {
                pondOptions.files = [{
                    source: existingImage,
                    options: {
                        type: 'local',
                        file: {
                            name: existingImage.split('/').pop(),
                            size: existingImage.length,
                            type: existingImage.split('.').pop(),
                        },
                        metadata: {
                            poster: existingImage
                        }
                    }
                }];
            }
            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
