@extends('pages.account.account')

@section('account-content')
<div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 animate-fade-in">
    <h1 class="text-xl sm:text-2xl font-bold text-primary mb-4 sm:mb-6">Meu Perfil</h1>
    <p class="text-gray mb-4 sm:mb-6">
        Mantenha seus dados atualizados para melhorar sua experiência na plataforma.
    </p>

    <div class="space-y-6 sm:space-y-8">
        <!-- Informações de Perfil -->
        <div class="bg-gray-50 rounded-lg p-4 sm:p-6 border border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 mb-6">
                <div class="flex-shrink-0 relative group mx-auto sm:mx-0 mb-4 sm:mb-0">
                    <img src="https://i.pravatar.cc/150?u={{ auth()->user()->id }}"
                         alt="Profile"
                         class="h-24 w-24 sm:h-28 sm:w-28 rounded-full object-cover border-2 border-indigo-100">
                    <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <span class="text-white text-sm">Mudar foto</span>
                    </div>
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="text-xl font-medium text-primary">{{ auth()->user()->name }}</h3>
                    <p class="text-gray">{{ auth()->user()->email }}</p>
                    <div class="mt-3 flex flex-wrap justify-center sm:justify-start gap-2">
                        <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800">
                            <i class="bi bi-camera mr-1"></i> Alterar foto
                        </button>
                        <button class="inline-flex items-center px-3 py-1.5 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="bi bi-trash mr-1"></i> Remover
                        </button>
                    </div>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 sm:space-y-6">
                @csrf
                @method('PUT')

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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script para preview da foto de perfil quando for implementado o upload
    });
</script>
@endpush
@endsection
