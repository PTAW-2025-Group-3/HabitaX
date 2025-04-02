@extends('pages.account.account')

@section('account-content')
<div class="p-6">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Configurações</h2>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Notificações</h3>
                <form action="{{ route('profile.notifications') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Notificações por email</label>
                                <p class="text-sm text-gray-500">Receba atualizações sobre suas propriedades e mensagens</p>
                            </div>
                            <button type="button" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 {{ auth()->user()->email_notifications ? 'bg-blue-800' : 'bg-gray-200' }}"
                                    onclick="this.classList.toggle('bg-blue-800'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                                <input type="hidden" name="email_notifications" value="{{ auth()->user()->email_notifications ? '0' : '1' }}">
                                <span class="sr-only">Ativar notificações</span>
                                <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->email_notifications ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Notificações de mensagens</label>
                                <p class="text-sm text-gray-500">Receba alertas quando receber novas mensagens</p>
                            </div>
                            <button type="button" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 {{ auth()->user()->message_notifications ? 'bg-blue-800' : 'bg-gray-200' }}"
                                    onclick="this.classList.toggle('bg-blue-800'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                                <input type="hidden" name="message_notifications" value="{{ auth()->user()->message_notifications ? '0' : '1' }}">
                                <span class="sr-only">Ativar notificações</span>
                                <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->message_notifications ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800">
                                Salvar alterações
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Privacidade</h3>
                <form action="{{ route('profile.privacy') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Perfil público</label>
                                <p class="text-sm text-gray-500">Torne seu perfil visível para outros usuários</p>
                            </div>
                            <button type="button" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 {{ auth()->user()->public_profile ? 'bg-blue-800' : 'bg-gray-200' }}"
                                    onclick="this.classList.toggle('bg-blue-800'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                                <input type="hidden" name="public_profile" value="{{ auth()->user()->public_profile ? '0' : '1' }}">
                                <span class="sr-only">Ativar perfil público</span>
                                <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->public_profile ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Mostrar email</label>
                                <p class="text-sm text-gray-500">Permita que outros usuários vejam seu email</p>
                            </div>
                            <button type="button" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 {{ auth()->user()->show_email ? 'bg-blue-800' : 'bg-gray-200' }}"
                                    onclick="this.classList.toggle('bg-blue-800'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                                <input type="hidden" name="show_email" value="{{ auth()->user()->show_email ? '0' : '1' }}">
                                <span class="sr-only">Mostrar email</span>
                                <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ auth()->user()->show_email ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800">
                                Salvar alterações
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Segurança</h3>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Senha atual</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Nova senha</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar nova senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800">
                                Alterar senha
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Conta</h3>
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
                    @csrf
                    @method('DELETE')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Excluir conta</label>
                            <p class="mt-1 text-sm text-gray-500">Uma vez excluída, sua conta não poderá ser recuperada.</p>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Confirme sua senha</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Excluir conta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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