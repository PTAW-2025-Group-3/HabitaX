@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 mt-20">
        <!-- Título Principal -->
        <div class="text-center">
            <h1 class="text-5xl font-bold text-gray-900 tracking-tight">Sobre Nós</h1>
            <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">
                Somos um grupo de cinco desenvolvedores do curso de Tecnologias de Informação da Estga-Ua, apaixonados por tecnologia e inovação.
                Criámos este projeto com o objetivo de facilitar a compra, venda e aluguer de imóveis em Portugal inteiro,
                conectando pessoas às suas casas ideais.
            </p>
        </div>

        <!-- Missão -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-semibold text-gray-900">A Nossa Missão</h2>
            <p class="text-lg text-gray-600 mt-4 max-w-3xl mx-auto">
                Ajudar todas as pessoas a encontrar ou vender sua casa de forma simples, segura e eficiente, usando tecnologia para conectar compradores e vendedores.
            </p>
        </div>

        <!-- Equipa -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-semibold text-gray-900">A Nossa Equipa</h2>
            <p class="text-lg text-gray-600 mt-4 max-w-3xl mx-auto">
                Conhece as pessoas por trás deste projeto! Somos uma equipa dedicada a tornar o mercado imobiliário mais acessível.
            </p>

            <div class="flex flex-wrap justify-center mt-10 gap-8">
                <div class="text-center">
                    <img src="{{ asset('images/Luiz Assis.jpg') }}" class="w-32 h-32 rounded-full shadow-lg" alt="Luiz de Assis">
                    <h3 class="text-lg font-medium mt-3">Luis Assis</h3>
                    <p class="text-sm text-gray-500">Gestor de Grupo/</p>
                    <p class="text-sm text-gray-500">Desenvolvedor</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/GustavoGiao.jpg') }}" class="w-32 h-32 rounded-full shadow-lg" alt="Gustavo Gião">
                    <h3 class="text-lg font-medium mt-3">Gustavo Gião</h3>
                    <p class="text-sm text-gray-500">Desenvolvedor</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/PedroSampaio2.jpg') }}" class="w-32 h-32 rounded-full shadow-lg" alt="Pedro Sampaio">
                    <h3 class="text-lg font-medium mt-3">Pedro Sampaio</h3>
                    <p class="text-sm text-gray-500">Desenvolvedor</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/Ratmir.jpg') }}" class="w-32 h-32 rounded-full shadow-lg" alt="Ratmir Mukazhanov">
                    <h3 class="text-lg font-medium mt-3">Ratmir Mukazhanov</h3>
                    <p class="text-sm text-gray-500">Desenvolvedor</p>
                </div>
                <div class="text-center">
                    <img src="https://i.pravatar.cc/150?img=3" class="w-32 h-32 rounded-full shadow-lg" alt="Kousha Rezaei">
                    <h3 class="text-lg font-medium mt-3">Kousha Rezaei</h3>
                    <p class="text-sm text-gray-500">Desenvolvedor</p>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-semibold text-gray-900">O Nosso Impacto</h2>
            <div class="flex justify-center mt-6 gap-12">
                <div>
                    <h3 class="text-4xl font-bold text-indigo-600">+10,000</h3>
                    <p class="text-gray-600">Casas vendidas</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-indigo-600">+5,000</h3>
                    <p class="text-gray-600">Anúncios ativos</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-indigo-600">+50</h3>
                    <p class="text-gray-600">Cidades atendidas</p>
                </div>
            </div>
        </div>

        <!-- Depoimentos -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-semibold text-gray-900">O que nossos clientes dizem</h2>
            <div class="flex flex-wrap justify-center mt-6 gap-8">
                <div class="max-w-md bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 italic">"Encontrei minha casa ideal em apenas 3 dias! Super recomendo."</p>
                    <p class="text-sm text-gray-500 mt-2">- Ana Pereira</p>
                </div>
                <div class="max-w-md bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 italic">"O suporte é incrível! Muito fácil de usar."</p>
                    <p class="text-sm text-gray-500 mt-2">- Carlos Mendes</p>
                </div>
            </div>
        </div>


        <!-- Botão de Voltar -->
        <div class="text-center mt-16">
            <a href="{{ url('/') }}"
               class="relative inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md transition-all duration-300 hover:bg-indigo-700 hover:scale-105 active:scale-95">
                <span class="z-10">Voltar ao Início</span>
                <span class="absolute inset-0 bg-indigo-400 blur-xl opacity-30 rounded-xl"></span>
            </a>
        </div>
    </div>
@endsection
