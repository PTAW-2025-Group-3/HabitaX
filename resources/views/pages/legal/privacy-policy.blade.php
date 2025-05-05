@extends('layout.app')

@section('title', 'Política de Privacidade')

@section('content')
    <div class="bg-gray-100 py-10">
        <div class="container mx-auto px-4 max-w-5xl animate-fade-in">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-blue-900 mb-2">Política de Privacidade</h1>
                <div class="w-20 h-1 bg-indigo-500 mx-auto"></div>
                <p class="mt-4 text-gray-600 max-w-3xl mx-auto">
                    Entenda como tratamos seus dados pessoais na plataforma HabitaX.
                </p>
            </div>

            <!-- Introduction -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="flex items-start">
                    <div class="mr-4 hidden sm:block">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="bi bi-info-circle-fill text-blue-900 text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <p class="mb-4">A <strong class="text-blue-900">HabitaX</strong> recomenda a leitura atenta da presente Política de Privacidade, a qual fornece informações importantes sobre a forma como a plataforma recolhe, utiliza, armazena e partilha os dados pessoais dos seus utilizadores, no respeito absoluto pela legislação aplicável.</p>

                        <p class="mb-4">Nos termos e para os efeitos do Regulamento (UE) 2016/679 do Parlamento Europeu e do Conselho, de 27 de abril de 2016 (Regulamento Geral sobre a Proteção de Dados – RGPD), da Lei n.º 58/2019, de 8 de agosto, e demais legislação nacional ou comunitária aplicável, a HabitaX informa os utilizadores do seu Website sobre a sua política de privacidade e proteção de dados pessoais.</p>

                        <p>A utilização da plataforma HabitaX implica a aceitação dos termos desta Política de Privacidade. Caso não concorde com os seus termos, o utilizador deverá abster-se de utilizar o Website.</p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="space-y-8">
                <!-- Section 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-building text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">1. Quem Somos</h2>
                    </div>
                    <p class="ml-9">A <strong class="text-indigo-600">HabitaX</strong> é uma plataforma digital de anúncios e gestão de contactos no setor imobiliário, registada na Conservatória do Registo Comercial, designada apenas por "HabitaX".</p>
                </div>

                <!-- Section 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-globe-europe-africa text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">2. Âmbito de Aplicação</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A presente Política de Privacidade aplica-se ao website <strong class="text-indigo-600">www.habitax.pt</strong> e respetivos subdomínios, aplicações e outras plataformas digitais sob a responsabilidade da HabitaX.</p>
                        <p>Através da plataforma, os utilizadores podem consultar imóveis, publicar anúncios, contactar anunciantes, guardar favoritos, utilizar simuladores de crédito e subscrever comunicações.</p>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-file-earmark-person-fill text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">3. Dados Pessoais Recolhidos</h2>
                    </div>
                    <div class="ml-9">
                        <p class="mb-3">Os dados pessoais recolhidos pela HabitaX podem incluir:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Nome completo</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Email</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Número de telefone</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Morada e localização do imóvel</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>NIF (quando aplicável)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Dados técnicos (IP, navegador)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Informações de uso da plataforma</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Preferências de contacto</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-clipboard-check-fill text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">4. Finalidades do Tratamento</h2>
                    </div>
                    <div class="ml-9">
                        <p class="mb-3">Os dados recolhidos são utilizados para as seguintes finalidades:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Gestão de registos e contas de utilizadores</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Publicação e administração de anúncios</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Facilitação do contacto entre interessados</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Envio de notificações personalizadas</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Prevenção de fraudes e segurança</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Cumprimento de obrigações legais</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Análises estatísticas e estudos</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-journal-text text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">5. Fundamento Jurídico</h2>
                    </div>
                    <div class="ml-9">
                        <p class="mb-3">O tratamento de dados pela HabitaX tem por base:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>O consentimento do titular dos dados</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>A execução de um contrato</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>O cumprimento de obrigações legais</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>O interesse legítimo da HabitaX</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-clock-history text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">6. Conservação dos Dados</h2>
                    </div>
                    <div class="ml-9">
                        <p>Os dados pessoais serão conservados pelo período necessário à prestação dos serviços, ou enquanto durar a relação contratual com o utilizador. Poderão ser conservados por períodos mais longos para efeitos legais, fiscais ou para defesa em processos judiciais.</p>
                    </div>
                </div>

                <!-- Section 7 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-share-fill text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">7. Partilha de Dados com Terceiros</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A HabitaX poderá partilhar dados com entidades parceiras e prestadores de serviços (ex. servidores de alojamento, ferramentas analíticas, email marketing), desde que garantam confidencialidade, segurança e estejam vinculadas por contrato de subcontratação.</p>
                        <p>Em caso algum os dados pessoais serão vendidos, trocados ou divulgados para fins comerciais sem o consentimento expresso do utilizador.</p>
                        <p>Os dados poderão também ser partilhados com autoridades judiciais ou administrativas, quando exigido por lei.</p>
                    </div>
                </div>

                <!-- Section 8 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-shield-lock-fill text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">8. Segurança dos Dados</h2>
                    </div>
                    <div class="ml-9">
                        <p class="mb-3">A HabitaX implementa medidas técnicas e organizativas apropriadas para proteger os dados pessoais contra destruição, perda, alteração, divulgação ou acesso não autorizados, incluindo:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Criptografia de dados</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Firewalls e controlo de acessos</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Servidores com certificações de segurança</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Acesso restrito por parte da equipa técnica</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 9 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-person-check-fill text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">9. Direitos dos Titulares dos Dados</h2>
                    </div>
                    <div class="ml-9">
                        <p class="mb-3">Nos termos do RGPD, os utilizadores podem, a qualquer momento:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-eye-fill text-indigo-600 text-xl"></i>
                                <span>Aceder aos seus dados pessoais</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-pencil-square text-indigo-600 text-xl"></i>
                                <span>Corrigir ou atualizar informações incorretas</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-trash-fill text-indigo-600 text-xl"></i>
                                <span>Solicitar o apagamento dos dados</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-slash-circle-fill text-indigo-600 text-xl"></i>
                                <span>Limitar ou opor-se ao tratamento</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-arrow-left-right text-indigo-600 text-xl"></i>
                                <span>Solicitar a portabilidade dos dados</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x-circle-fill text-indigo-600 text-xl"></i>
                                <span>Retirar o consentimento, quando aplicável</span>
                            </div>
                        </div>
                        <div class="mt-4 bg-blue-50 border-l-4 border-blue-900 p-4 rounded">
                            <p class="mb-2">Estes direitos podem ser exercidos através do email: <strong class="text-blue-900">privacidade@habitax.pt</strong>, mediante prova de identidade.</p>
                            <p>O utilizador poderá ainda apresentar reclamação à <a href="https://www.cnpd.pt" target="_blank" class="text-indigo-600 hover:text-indigo-800 transition-colors font-medium">Comissão Nacional de Proteção de Dados</a>.</p>
                        </div>
                    </div>
                </div>

                <!-- Sections 10-12 -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Section 10 -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-center mb-4 text-blue-900">
                            <div class="mr-3 flex-shrink-0">
                                <i class="bi bi-people-fill text-blue-900 text-2xl"></i>
                            </div>
                            <h2 class="text-xl font-bold">10. Menores de Idade</h2>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm">O Website não se destina à utilização por menores de 18 anos. A HabitaX não recolhe intencionalmente dados de menores e eliminará quaisquer dados pessoais recolhidos involuntariamente.</p>
                        </div>
                    </div>

                    <!-- Section 11 -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-center mb-4 text-blue-900">
                            <div class="mr-3 flex-shrink-0">
                                <i class="bi bi-arrow-repeat text-blue-900 text-2xl"></i>
                            </div>
                            <h2 class="text-xl font-bold">11. Alterações à Política</h2>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm">A presente Política de Privacidade poderá ser revista a qualquer momento. Todas as alterações serão publicadas nesta página e a sua consulta é recomendada de forma regular.</p>
                            <p class="text-sm font-medium mt-2">Última atualização: <span class="text-indigo-600">Junho de 2025</span></p>
                        </div>
                    </div>

                    <!-- Section 12 -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-center mb-4 text-blue-900">
                            <div class="mr-3 flex-shrink-0">
                                <i class="bi bi-envelope-fill text-blue-900 text-2xl"></i>
                            </div>
                            <h2 class="text-xl font-bold">12. Contactos</h2>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm">Para esclarecimentos adicionais, contacte:</p>
                            <div class="flex items-center mt-2">
                                <i class="bi bi-envelope-fill text-indigo-600 text-sm mr-2"></i>
                                <span class="text-sm font-medium">privacidade@habitax.pt</span>
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-geo-alt-fill text-indigo-600 text-base mr-2"></i>
                                <span class="text-sm">Rua Comandante Pinho e Freitas, nº 28, 3750 – 127 Águeda</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
