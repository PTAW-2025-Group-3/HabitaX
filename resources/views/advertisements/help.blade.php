@extends('layout.app')

@section('title', 'Como Anunciar na HabitaX')

@section('content')
    <!-- Banner introdutório com imagem de fundo -->
    <div class="relative bg-back py-16">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Anuncia o teu imóvel com eficiência</h1>
                <p class="text-xl text-gray-secondary mb-6">Coloque a sua propriedade à vista de quem procura comprar ou arrendar.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#como-anunciar" class="btn-primary px-6 py-3 text-lg">
                        Começar Agora <i class="bi bi-arrow-right ml-2"></i>
                    </a>
                    <a href="#vantagens" class="btn-secondary px-6 py-3 text-lg">
                        Ver Vantagens <i class="bi bi-info-circle ml-2"></i>
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center md:justify-end">
                <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-white">
                    <div class="p-6 bg-gradient-to-r from-blue-700 to-blue-800 text-white text-center">
                        <i class="bi bi-house-check text-5xl mb-4"></i>
                        <h3 class="text-2xl font-bold">HabitaX</h3>
                        <p class="text-white/90">Sua plataforma de arrendamento</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="bi bi-check-circle-fill text-secondary mr-3"></i>
                                <span>Anúncios para todos os tipos de imóveis</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-check-circle-fill text-secondary mr-3"></i>
                                <span>Gestão completa dos seus anúncios</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-check-circle-fill text-secondary mr-3"></i>
                                <span>Contactos diretos de inquilinos qualificados</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Por que Escolher (Vantagens) -->
    <div id="vantagens" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Por que escolher a HabitaX?</h2>
                <p class="text-gray max-w-2xl mx-auto">A HabitaX adapta-se a diferentes tipos de arrendamento e dá-te ferramentas simples para publicares e gerires os teus imóveis com total controlo.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="home-property-card-style group">
                    <div class="home-icon-style">
                        <i class="bi bi-calendar2-check text-secondary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Ofertas Flexíveis</h3>
                    <p class="text-gray">Cria várias ofertas para a mesma propriedade com diferentes durações e preços.</p>
                </div>
                <div class="home-property-card-style group">
                    <div class="home-icon-style">
                        <i class="bi bi-person-check text-secondary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Utilizadores Qualificados</h3>
                    <p class="text-gray">Todos os contactos vêm de utilizadores registados com interesse real.</p>
                </div>
                <div class="home-property-card-style group">
                    <div class="home-icon-style">
                        <i class="bi bi-ui-checks text-secondary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Gestão Total</h3>
                    <p class="text-gray">Tens acesso a uma área privada onde podes gerir as tuas propriedades, anúncios e os contactos que recebes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Como Publicar -->
    <div id="como-anunciar" class="py-20 bg-back">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary mb-4">Todo o processo, resumido num olhar</h2>
            <p class="text-gray-secondary max-w-2xl mx-auto mb-12">Vê como é simples criar e gerir o teu anúncio na HabitaX — passo a passo, de forma clara e intuitiva.</p>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                <div class="home-property-card-style">
                    <i class="bi bi-person-plus text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">1. Cria Conta</h3>
                    <p class="text-gray">Regista-te gratuitamente para começares a usar a plataforma.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-shield-lock text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">2. Verifica o teu Perfil</h3>
                    <p class="text-gray">Envia os documentos necessários para verificação como anunciante. Após aprovação, poderás continuar.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-house-door text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">3. Adiciona Propriedade</h3>
                    <p class="text-gray">Preenche os dados do imóvel com fotos, descrição, localização, atributos, etc.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-calendar-range text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">4. Cria Ofertas</h3>
                    <p class="text-gray">Define o tipo de oferta: compra ou arrendamento (diário, semanal, mensal), preços e regras.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-megaphone text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">5. Publicação de Anúncio</h3>
                    <p class="text-gray">Ativa o anúncio, gere-o e responde aos interessados através da tua área pessoal.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Boas Práticas para um Bom Anúncio -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary mb-4">Boas Práticas para um Bom Anúncio</h2>
            <p class="text-gray-secondary max-w-2xl mx-auto mb-12">
                Segue estas recomendações para tornares o teu anúncio mais atrativo, confiável e eficaz.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 text-left">
                <div class="home-property-card-style">
                    <i class="bi bi-camera text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">Fotos de Qualidade</h3>
                    <p class="text-gray">Usa imagens reais, bem iluminadas e que mostrem todos os espaços.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-journal-text text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">Descrição Honesta</h3>
                    <p class="text-gray">Sê claro sobre as condições do imóvel e quaisquer restrições (ex: animais).</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-geo-alt text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">Localização Precisa</h3>
                    <p class="text-gray">Indica a localização correta para facilitar a pesquisa e gerar mais confiança.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-cash-coin text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">Preço Justo</h3>
                    <p class="text-gray">Define valores compatíveis com o mercado da zona e com a oferta.</p>
                </div>
                <div class="home-property-card-style">
                    <i class="bi bi-chat-dots text-4xl text-secondary mb-4"></i>
                    <h3 class="text-lg font-semibold text-primary mb-2">Boa Comunicação</h3>
                    <p class="text-gray">Responde com rapidez e simpatia aos contactos que recebes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dúvidas Frequentes sobre os Anúncios -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Dúvidas Frequentes sobre os Anúncios</h2>
                <p class="text-gray-secondary max-w-2xl mx-auto">
                    Respondemos às perguntas mais comuns que os proprietários têm ao publicar um imóvel na HabitaX.
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Pergunta 1 -->
                <div>
                    <h4 class="text-lg font-semibold text-primary mb-2">
                        <i class="bi bi-patch-question-fill text-secondary mr-2"></i> É obrigatório verificar o perfil?
                    </h4>
                    <p class="text-gray">
                        Sim, a verificação é essencial para garantir confiança entre proprietários e inquilinos. Após validação, podes criar anúncios livremente.
                    </p>
                </div>

                <!-- Pergunta 2 -->
                <div>
                    <h4 class="text-lg font-semibold text-primary mb-2">
                        <i class="bi bi-pencil-fill text-secondary mr-2"></i> Posso editar o anúncio depois de o publicar?
                    </h4>
                    <p class="text-gray">
                        Claro! Podes alterar detalhes da propriedade, fotos, ofertas ou regras a qualquer momento na tua área pessoal.
                    </p>
                </div>

                <!-- Pergunta 3 -->
                <div>
                    <h4 class="text-lg font-semibold text-primary mb-2">
                        <i class="bi bi-collection-fill text-secondary mr-2"></i> Quantas ofertas posso ter para o mesmo imóvel?
                    </h4>
                    <p class="text-gray">
                        Quantas quiseres! Podes criar várias ofertas com diferentes durações e preços — por exemplo, arrendamento semanal e mensal em simultâneo.
                    </p>
                </div>

                <!-- Pergunta 4 -->
                <div>
                    <h4 class="text-lg font-semibold text-primary mb-2">
                        <i class="bi bi-camera-fill text-secondary mr-2"></i> É preciso colocar fotos obrigatoriamente?
                    </h4>
                    <p class="text-gray">
                        Sim é obrigatório, os anúncios com boas fotos têm muito mais visualizações e contactos.
                    </p>
                </div>

                <!-- Pergunta 5 -->
                <div>
                    <h4 class="text-lg font-semibold text-primary mb-2">
                        <i class="bi bi-envelope-open-fill text-secondary mr-2"></i> Como recebo os contactos dos interessados?
                    </h4>
                    <p class="text-gray">
                        Recebes tudo diretamente na tua conta HabitaX, com alertas por email. Podes responder via a tua área pessoal.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Final -->
    <div class="py-20 bg-gradient-to-r from-blue-800 to-indigo-600 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6">Pronto para anunciar o teu imóvel?</h2>
                <p class="text-xl text-white/90 mb-8">Junta-te a dezenas de proprietários que usam a HabitaX para encontrar os inquilinos ideais.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="btn-primary px-8 py-4 text-lg">
                        Criar Conta <i class="bi bi-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white text-blue-900 hover:bg-gray-200 inline-flex items-center justify-center font-semibold rounded-xl shadow-md transition-all duration-300 hover:scale-105 active:scale-95 px-8 py-4 text-lg">
                        Continuo com dúvidas... <i class="bi bi-headset ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
