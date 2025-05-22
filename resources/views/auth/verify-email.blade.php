@extends('layout.app')

@section('title', 'Verifique seu Endereço de E-mail')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Obrigado pelo registo! Antes de começar, poderia verificar o seu endereço de e-mail clicando no link que acabamos de enviar para o seu email? Se não recebeu o e-mail, teremos o prazer em enviar outro.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registo.
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Reenviar E-mail de Verificação
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
