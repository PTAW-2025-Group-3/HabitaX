@extends('layout.app')

@section('title', 'Sobre Nós')

@section('content')
    <div class="bg-back min-h-screen">
        <div class="container mx-auto px-6 mt-2">

            {{-- Secção: Sobre Nós --}}
            @include('pages.about.sections.title', [
                'title' => 'Sobre Nós',
                'class' => '',
                'slot' => 'Somos um grupo de cinco desenvolvedores do curso de Tecnologias de Informação da ESTGA-UA, apaixonados por tecnologia e inovação.
                Criámos este projeto com o objetivo de facilitar a compra, venda e aluguer de imóveis em Portugal inteiro,
                conectando pessoas às suas casas ideais.'
            ])

            {{-- Secção: Missão --}}
            @include('pages.about.sections.title', [
                'title' => 'A Nossa Missão',
                'class' => 'mt-16',
                'slot' => 'Ajudar todas as pessoas a encontrar ou vender sua casa de forma simples, segura e eficiente, usando tecnologia para conectar compradores e vendedores.'
            ])

            {{-- Secção: Equipa --}}
            @include('pages.about.sections.title', [
                'title' => 'A Nossa Equipa',
                'class' => 'mt-16 mb-8',
                'slot' => 'Conhece as pessoas por trás deste projeto! Somos uma equipa dedicada a tornar o mercado imobiliário mais acessível.'
            ])

            @php
                $path = 'images/team/';
                $equipa = [
                    ['nome' => 'Luis Assis', 'imagem' => 'Luiz Assis.jpg', 'cargo' => 'Gestor de Grupo',
                    ['nome' => 'Gustavo Gião', 'imagem' => 'GustavoGiao.png', 'cargo' => 'Desenvolvedor'],
                    ['nome' => 'Pedro Sampaio', 'imagem' => 'SedroPampaio.jpg', 'cargo' => 'Desenvolvedor'],
                    ['nome' => 'Ratmir Mukazhanov', 'imagem' => 'Ratmir.jpg', 'cargo' => 'Desenvolvedor'],
                    ['nome' => 'Kousha Rezaei', 'imagem' => 'Kousha.jpg', 'cargo' => 'Desenvolvedor'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 max-w-6xl mx-auto">
                @foreach($equipa as $membro)
                    @include('pages.about.sections.team-card', [
                        'nome' => $membro['nome'],
                        'imagem' => $path . $membro['imagem'],
                        'cargo' => $membro['cargo'],
                    ])
                @endforeach
            </div>

            {{-- Secção: Impacto --}}
            @include('pages.about.sections.title', [
                'title' => 'O Nosso Impacto',
                'class' => 'mt-16 mb-12'
            ])

            @php
                $estatisticas = [
                    ['valor' => '+10,000', 'texto' => 'Casas vendidas', 'icone' => 'home'],
                    ['valor' => '+5,000', 'texto' => 'Anúncios ativos', 'icone' => 'document'],
                    ['valor' => '+50', 'texto' => 'Cidades atendidas', 'icone' => 'location'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                @foreach($estatisticas as $item)
                    @include('pages.about.sections.stats-card', [
                        'valor' => $item['valor'],
                        'texto' => $item['texto'],
                        'icone' => $item['icone']
                    ])
                @endforeach
            </div>

            {{-- Botão Voltar --}}
            <div class="text-center mt-16">
                <a href="{{ url('/') }}" class="relative inline-flex btn-secondary px-6 py-3">
                    <span class="z-10">Voltar ao Início</span>
                    <span class="absolute inset-0 bg-secondary blur-xl opacity-30 rounded-xl"></span>
                </a>
            </div>

        </div>
    </div>
@endsection
