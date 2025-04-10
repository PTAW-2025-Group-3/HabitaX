@extends('pages.account.account')

@section('account-content')
<div class="animate-fade-in">
    <h1 class="text-2xl font-bold text-primary mb-6">Configurações da Conta</h1>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Notificações -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-primary mb-4">Notificações</h2>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-medium text-gray-secondary">Notificações por email</label>
                        <p class="text-sm text-gray mt-1">Receba atualizações sobre suas propriedades e mensagens</p>
                    </div>
                    <button type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ auth()->user()->email_notifications ? 'bg-indigo-500' : 'bg-gray-200' }}"
                            onclick="this.classList.toggle('bg-indigo-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                        <input type="hidden" name="email_notifications" value="{{ auth()->user()->email_notifications ? '0' : '1' }}">
                        <span class="sr-only">Ativar notificações</span>
                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->email_notifications ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-medium text-gray-secondary">Notificações de mensagens</label>
                        <p class="text-sm text-gray mt-1">Receba alertas quando receber novas mensagens</p>
                    </div>
                    <button type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ auth()->user()->message_notifications ? 'bg-indigo-500' : 'bg-gray-200' }}"
                            onclick="this.classList.toggle('bg-indigo-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                        <input type="hidden" name="message_notifications" value="{{ auth()->user()->message_notifications ? '0' : '1' }}">
                        <span class="sr-only">Ativar notificações</span>
                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->message_notifications ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary py-2 px-6">
                        Salvar alterações
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Privacidade -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-primary mb-4">Privacidade</h2>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-medium text-gray-secondary">Perfil público</label>
                        <p class="text-sm text-gray mt-1">Torne seu perfil visível para outros usuários</p>
                    </div>
                    <button type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ auth()->user()->public_profile ? 'bg-indigo-500' : 'bg-gray-200' }}"
                            onclick="this.classList.toggle('bg-indigo-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                        <input type="hidden" name="public_profile" value="{{ auth()->user()->public_profile ? '0' : '1' }}">
                        <span class="sr-only">Ativar perfil público</span>
                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->public_profile ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-medium text-gray-secondary">Mostrar email</label>
                        <p class="text-sm text-gray mt-1">Permita que outros usuários vejam seu email</p>
                    </div>
                    <button type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ auth()->user()->show_email ? 'bg-indigo-500' : 'bg-gray-200' }}"
                            onclick="this.classList.toggle('bg-indigo-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                        <input type="hidden" name="show_email" value="{{ auth()->user()->show_email ? '0' : '1' }}">
                        <span class="sr-only">Mostrar email</span>
                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->show_email ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary py-2 px-6">
                        Salvar alterações
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Segurança -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-primary mb-4">Segurança</h2>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block font-medium text-gray-secondary mb-1">Senha atual</label>
                    <input type="password" name="current_password" id="current_password"
                           class="form-input">
                    @error('current_password')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-medium text-gray-secondary mb-1">Nova senha</label>
                    <input type="password" name="password" id="password"
                           class="form-input">
                    @error('password')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-medium text-gray-secondary mb-1">Confirmar nova senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-input">
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary py-2 px-6">
                        Alterar senha
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Conta -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-primary mb-4">Conta</h2>

        <!-- Dicas e informações -->
        <div class="bg-red-50 rounded-lg p-5 border border-red-200 mb-6">
            <h3 class="font-semibold text-red-900 flex items-center">
                <i class="bi bi-exclamation-triangle-fill mr-2"></i> Atenção
            </h3>
            <p class="text-red-800 text-sm mt-2">
                A exclusão da sua conta é permanente. Todos os seus dados, incluindo propriedades,
                mensagens e configurações serão removidos permanentemente.
            </p>
        </div>

        <form action="" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
            @csrf
            @method('DELETE')
            <div class="space-y-4">
                <div>
                    <label for="delete_password" class="block font-medium text-gray-secondary mb-1">Confirme sua senha para excluir</label>
                    <input type="password" name="password" id="delete_password"
                           class="form-input">
                    @error('password')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-warning py-2 px-6">
                        Excluir conta
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('button[type="button"]').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.querySelector('input[type="hidden"]');
            input.value = input.value === '1' ? '0' : '1';
        });
    });
</script>
@endpush
@endsection
