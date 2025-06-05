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
                    ['nome' => 'Luis Assis', 'imagem' => 'Luiz Assis.jpg', 'cargo' => 'Gestor de Grupo'],
                    ['nome' => 'Gustavo Gião', 'imagem' => 'GustavoGiao.png', 'cargo' => 'Software Engineer'],
                    ['nome' => 'Pedro Sampaio', 'imagem' => 'SedroPampaio.jpg', 'cargo' => 'Desenvolvedor'],
                    ['nome' => 'Ratmir Mukazhanov', 'imagem' => 'Ratmir.jpg', 'cargo' => 'Software Architect'],
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

            {{-- Secção: Localização e Contato --}}
            @include('pages.about.sections.title', [
                'title' => 'Onde Nos Encontrar',
                'class' => 'mt-16 mb-8',
                'slot' => 'Estamos localizados na ESTGA em Águeda. Visite-nos ou entre em contato através das nossas plataformas.'
            ])

            @include('pages.about.sections.contact-map', [
                'address' => 'Escola Superior de Tecnologia e Gestão de Águeda (ESTGA), R. Comandante Pinho e Freitas 28, 3750-127 Águeda',
                'mapUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d637.0857441417367!2d-8.44382317198344!3d40.57454979720562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd230982ea9570a1%3A0x15e2e89202d3bff4!2sEscola%20Superior%20de%20Tecnologia%20e%20Gest%C3%A3o%20de%20%C3%81gueda!5e0!3m2!1spt-PT!2spt!4v1749154666876!5m2!1spt-PT!2spt',
                'githubUrl' => 'https://github.com/Projecto-Tematico-em-Aplicacoes-Web/HabitaX'
            ])

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
