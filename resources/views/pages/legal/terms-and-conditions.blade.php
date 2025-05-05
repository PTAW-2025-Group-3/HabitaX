@extends('layout.app')

@section('title', 'Condições Gerais de Utilização')

@section('content')
    <div class="bg-gray-100 py-10">
        <div class="container mx-auto px-4 max-w-5xl animate-fade-in">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-blue-900 mb-2">Condições Gerais de Utilização</h1>
                <div class="w-20 h-1 bg-indigo-500 mx-auto"></div>
                <p class="mt-4 text-gray-600 max-w-3xl mx-auto">
                    Leia atentamente os termos legais que regulam o uso da plataforma HabitaX.
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
                        <p class="mb-4">Ao aceder ao website <strong class="text-blue-900">www.habitax.pt</strong> e seus subdomínios (doravante "Website"), o utilizador compromete-se a respeitar os presentes termos, que regem a navegação e utilização da plataforma HabitaX, propriedade de Habitax, LDA, com sede em Rua Comandante Pinho e Freitas, nº 28, 3750 – 127 Águeda, registada sob o NIF (não é preciso ir tão a fundo, por amor de deus!) e com registo na Conservatória do Registo Comercial.</p>

                        <p class="mb-4">A plataforma HabitaX destina-se à divulgação de imóveis, à intermediação de contactos entre anunciantes e potenciais interessados, e à prestação de funcionalidades digitais de apoio à promoção imobiliária e gestão de anúncios.</p>

                        <p>O utilizador reconhece e aceita estes termos e condições, devendo abster-se de utilizar a plataforma caso não concorde com os mesmos. A HabitaX reserva-se o direito de atualizar estes termos a qualquer momento, sem aviso prévio, recomendando-se a sua consulta regular.</p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="space-y-8">
                <!-- Section 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-card-checklist text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">1. Condições de Utilização</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>Ao aceder e utilizar o website <strong class="text-indigo-600">www.habitax.pt</strong>, o utilizador compromete-se a respeitar os presentes termos e condições, que constituem um acordo legal entre o utilizador e a HabitaX.</p>

                        <p>A HabitaX é uma plataforma digital especializada no setor imobiliário que disponibiliza:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-3">
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-house-door text-indigo-600 text-xl"></i>
                                <span>Anúncios de imóveis para compra, venda e arrendamento</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-chat-dots text-indigo-600 text-xl"></i>
                                <span>Intermediação de contactos entre as partes interessadas</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-calculator text-indigo-600 text-xl"></i>
                                <span>Ferramentas de cálculo e simulação de crédito</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-gear text-indigo-600 text-xl"></i>
                                <span>Funcionalidades de gestão de anúncios e favoritos</span>
                            </div>
                        </div>

                        <p>A utilização continuada do Website após a publicação de quaisquer alterações a estes termos constitui a aceitação dessas alterações por parte do utilizador.</p>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-person-badge text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">2. Maiores de Idade</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A utilização da plataforma HabitaX está exclusivamente reservada a utilizadores maiores de 18 anos. Esta restrição aplica-se a todas as funcionalidades disponibilizadas pelo Website, incluindo:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-3">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Publicação de anúncios imobiliários</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Contacto com anunciantes</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Registo e criação de contas de utilizador</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Utilização de simuladores e ferramentas</span>
                            </div>
                        </div>

                        <p>A HabitaX não recolhe intencionalmente qualquer informação de menores de idade. Caso sejam identificados dados pertencentes a utilizadores com idade inferior a 18 anos, estes serão imediatamente eliminados dos nossos sistemas.</p>

                        <div class="bg-blue-50 border-l-4 border-blue-900 p-4 rounded mt-4">
                            <p>Os representantes legais de menores que suspeitem da existência de dados de pessoas a seu cargo nos nossos sistemas devem contactar-nos através do email <strong class="text-blue-900">privacidade@habitax.pt</strong>.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-door-open text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">3. Acesso ao Website</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>O acesso a determinadas secções e funcionalidades do Website pode requerer registo prévio, durante o qual serão solicitados dados de identificação e contacto do utilizador. Ao fornecer estas informações, o utilizador garante a sua veracidade e exatidão.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Tipos de acesso:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Acesso livre</h4>
                                    <p class="text-sm text-gray-600 mt-1">Consulta de anúncios, navegação básica, pesquisa de imóveis, utilização de simuladores simples.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Acesso mediante registo</h4>
                                    <p class="text-sm text-gray-600 mt-1">Publicação de anúncios, contacto com anunciantes, gestão de favoritos, funcionalidades avançadas.</p>
                                </div>
                            </div>
                        </div>

                        <p>A HabitaX envidará os seus melhores esforços para garantir a disponibilidade e acessibilidade contínua do Website, mas não pode garantir o funcionamento ininterrupto ou isento de erros. A plataforma poderá ser temporariamente suspensa, no todo ou em parte, para manutenção, atualização ou resolução de problemas técnicos, sem aviso prévio.</p>

                        <p>O utilizador reconhece e aceita que a suspensão temporária do acesso ou de funcionalidades do Website, por motivos técnicos ou de manutenção, não gera responsabilidade da HabitaX perante os utilizadores ou terceiros.</p>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-check-circle text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">4. Utilização Correta da Plataforma</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>Para garantir uma experiência positiva a todos os utilizadores e preservar a integridade da plataforma, o utilizador compromete-se expressamente a:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4">
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-check text-green-600 text-xl"></i>
                                <span>Utilizar o Website apenas para fins lícitos e pessoais</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-check text-green-600 text-xl"></i>
                                <span>Fornecer informações verdadeiras e atualizadas</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-check text-green-600 text-xl"></i>
                                <span>Respeitar os direitos de propriedade intelectual</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-check text-green-600 text-xl"></i>
                                <span>Utilizar linguagem adequada e respeitosa</span>
                            </div>
                        </div>

                        <p>Por outro lado, é expressamente proibido:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4">
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Copiar, extrair ou reproduzir conteúdo sem autorização</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Introduzir vírus ou elementos prejudiciais</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Publicar anúncios falsos ou enganosos</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Interferir com a operação normal da plataforma</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Utilizar técnicas de scraping ou crawling automatizado</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-x text-red-600 text-xl"></i>
                                <span>Fazer uso abusivo dos serviços de contacto</span>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mt-3">
                            <p class="font-medium text-yellow-800">Aviso importante:</p>
                            <p class="text-gray-700">A HabitaX reserva-se o direito de eliminar conteúdos que violem estes princípios, incluindo anúncios, comentários ou dados introduzidos pelos utilizadores, bem como suspender ou encerrar contas em caso de incumprimento, sem aviso prévio e sem direito a reembolso de quaisquer serviços contratados.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-people text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">5. Relação com Terceiros</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A HabitaX atua exclusivamente como plataforma intermediária que facilita o contacto entre utilizadores interessados em imóveis e anunciantes. Qualquer relação contratual estabelecida entre o utilizador e terceiros é da responsabilidade exclusiva das partes envolvidas.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Responsabilidades da plataforma:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">O que fazemos</h4>
                                    <ul class="text-sm text-gray-600 mt-1 space-y-1">
                                        <li>• Facilitar o contacto entre interessados</li>
                                        <li>• Disponibilizar ferramentas de divulgação</li>
                                        <li>• Fornecer mecanismos de pesquisa</li>
                                        <li>• Oferecer recursos informativos</li>
                                    </ul>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">O que não fazemos</h4>
                                    <ul class="text-sm text-gray-600 mt-1 space-y-1">
                                        <li>• Verificar a veracidade de todos os anúncios</li>
                                        <li>• Mediar negociações entre as partes</li>
                                        <li>• Garantir a concretização de negócios</li>
                                        <li>• Assumir responsabilidade por acordos entre utilizadores</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <p>A HabitaX não assume qualquer responsabilidade por:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-3">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Negociações entre utilizadores e anunciantes</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Contratos de compra, venda ou arrendamento</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Qualidade ou estado dos imóveis anunciados</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Condições de financiamento com instituições</span>
                            </div>
                        </div>

                        <p>Recomendamos vivamente que o utilizador verifique todas as informações, visite os imóveis e consulte especialistas antes de celebrar qualquer contrato ou efetuar qualquer pagamento relacionado com anúncios encontrados na plataforma.</p>
                    </div>
                </div>

                <!-- Section 6 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-shield-lock text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">6. Propriedade Intelectual</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>Todo o conteúdo publicado na plataforma HabitaX, incluindo mas não limitado a textos, imagens, logótipos, software, bases de dados, design gráfico, estrutura de navegação e código-fonte, encontra-se protegido por direitos de autor e/ou propriedade industrial.</p>

                        <p>Estes direitos são exclusivos da HabitaX ou de terceiros que tenham autorizado a sua utilização, nos termos da legislação nacional e internacional aplicável.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4">
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-lock-fill text-indigo-600 text-xl"></i>
                                <span>Marca e logótipo HabitaX</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-lock-fill text-indigo-600 text-xl"></i>
                                <span>Design e layout da plataforma</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-lock-fill text-indigo-600 text-xl"></i>
                                <span>Textos institucionais e informativos</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-2">
                                <i class="bi bi-lock-fill text-indigo-600 text-xl"></i>
                                <span>Ferramentas e funcionalidades desenvolvidas</span>
                            </div>
                        </div>

                        <p>Está expressamente proibida a reprodução, distribuição, comunicação pública, transformação ou qualquer outro tipo de utilização, total ou parcial, dos conteúdos da plataforma sem a autorização prévia e expressa da HabitaX.</p>

                        <p>O utilizador apenas está autorizado a visualizar e obter uma cópia privada temporária dos conteúdos para seu uso pessoal e não comercial no seu dispositivo, como parte da utilização normal da plataforma.</p>

                        <div class="bg-blue-50 border-l-4 border-blue-900 p-4 rounded mt-4">
                            <p>Qualquer utilização não autorizada dos conteúdos da plataforma pode constituir uma violação da legislação vigente em matéria de propriedade intelectual e industrial e poderá dar origem a processos judiciais.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 7 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-exclamation-triangle text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">7. Exclusão de Garantias</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A HabitaX envidará os seus melhores esforços para manter a plataforma atualizada e em pleno funcionamento. No entanto, não é possível garantir a inexistência de falhas técnicas, erros de conteúdo ou eventuais interrupções no acesso.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Limitações e avisos:</h3>
                            <div class="space-y-2">
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> A plataforma é fornecida "tal como está" e "conforme disponível", sem garantias de qualquer tipo.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> O utilizador reconhece que a utilização da plataforma é feita por sua conta e risco.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> As informações dos anúncios são da responsabilidade exclusiva dos anunciantes.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> Os resultados das ferramentas de simulação são meramente indicativos.</p>
                            </div>
                        </div>

                        <p>A HabitaX não se responsabiliza por:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-3">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Danos diretos ou indiretos resultantes da utilização</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Veracidade dos anúncios publicados por terceiros</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Perdas financeiras relacionadas com negócios</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Interrupções ou falhas técnicas na plataforma</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Conteúdo de websites para os quais existam links</span>
                            </div>
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span>Perda de dados ou danos em dispositivos dos utilizadores</span>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mt-3">
                            <p class="font-medium text-yellow-800">Recomendação importante:</p>
                            <p class="text-gray-700">Antes de tomar qualquer decisão com base em informações obtidas através da plataforma, recomendamos a consulta de especialistas qualificados nas áreas imobiliária, jurídica e financeira para obter aconselhamento profissional adequado.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 8 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-shield-fill-check text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">8. Política de Privacidade</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A utilização da plataforma HabitaX implica o tratamento de dados pessoais, o qual é regido pela <a href="/politica-de-privacidade" class="text-indigo-600 hover:text-indigo-800 font-medium">Política de Privacidade</a> da HabitaX, que constitui parte integrante das presentes Condições Gerais de Utilização.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Principais aspectos da nossa política:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Segurança dos dados</h4>
                                    <p class="text-sm text-gray-600 mt-1">Implementamos medidas técnicas e organizativas adequadas para proteger os seus dados pessoais, incluindo criptografia e controles de acesso.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Direitos dos utilizadores</h4>
                                    <p class="text-sm text-gray-600 mt-1">Asseguramos o direito de acesso, retificação, apagamento, limitação, oposição e portabilidade dos seus dados pessoais, nos termos da legislação aplicável.</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Finalidades do tratamento</h4>
                                    <p class="text-sm text-gray-600 mt-1">Utilizamos os seus dados para gestão de contas, processamento de anúncios, comunicações de serviço e melhorias da plataforma.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Cookies e tecnologias similares</h4>
                                    <p class="text-sm text-gray-600 mt-1">Utilizamos cookies e tecnologias semelhantes para melhorar a experiência na plataforma, análise estatística e personalização.</p>
                                </div>
                            </div>
                        </div>
                        <p>Ao utilizar a plataforma HabitaX, o utilizador reconhece ter lido e compreendido a nossa Política de Privacidade, consentindo expressamente com o tratamento dos seus dados nos termos ali descritos.</p>

                        <div class="bg-blue-50 border-l-4 border-blue-900 p-4 rounded mt-4">
                            <p>Para exercer os seus direitos relativos aos dados pessoais ou obter esclarecimentos adicionais, contacte-nos através do email <strong class="text-blue-900">privacidade@habitax.pt</strong> ou do formulário disponível na secção "Contactos" do Website.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 9 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-cookie text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">9. Política de Cookies</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A plataforma HabitaX utiliza cookies e tecnologias similares para melhorar a experiência de navegação, personalizar conteúdos e analisar o tráfego. Estes elementos são regidos pela nossa <a href="/politica-de-cookies" class="text-indigo-600 hover:text-indigo-800 font-medium">Política de Cookies</a>, que complementa as presentes Condições Gerais de Utilização.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Tipos de cookies utilizados:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Cookies essenciais</h4>
                                    <p class="text-sm text-gray-600 mt-1">Necessários para o funcionamento básico da plataforma, como autenticação, segurança e preferências básicas.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Cookies analíticos</h4>
                                    <p class="text-sm text-gray-600 mt-1">Permitem-nos analisar a utilização da plataforma, melhorar funcionalidades e monitorizar o desempenho.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Cookies de funcionalidade</h4>
                                    <p class="text-sm text-gray-600 mt-1">Lembram as suas preferências e personalizam a sua experiência na plataforma.</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-blue-900">Cookies de marketing</h4>
                                    <p class="text-sm text-gray-600 mt-1">Utilizados para exibir publicidade personalizada e medir a eficácia das campanhas.</p>
                                </div>
                            </div>
                        </div>
                        <p>Ao navegar na plataforma HabitaX, o utilizador consente a utilização de cookies de acordo com as configurações do seu navegador. O utilizador pode, a qualquer momento, modificar as configurações de cookies através das definições do seu navegador ou através do nosso painel de preferências de cookies.</p>
                    </div>
                </div>

                <!-- Section 10 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-journal-text text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">10. Modificações dos Termos e Condições</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>A HabitaX reserva-se o direito de modificar, a qualquer momento e sem aviso prévio, as presentes Condições Gerais de Utilização, bem como a configuração, apresentação e funcionalidades da plataforma.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Processo de atualização:</h3>
                            <div class="space-y-2">
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> As alterações entrarão em vigor na data da sua publicação na plataforma.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> Alterações significativas poderão ser comunicadas por email aos utilizadores registados.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> A data da última atualização será sempre indicada no final deste documento.</p>
                                <p class="text-gray-700"><i class="bi bi-arrow-right-short text-indigo-600"></i> Recomendamos a consulta periódica destas Condições para se manter informado.</p>
                            </div>
                        </div>

                        <p>A utilização continuada da plataforma após a publicação das alterações constituirá a aceitação das mesmas por parte do utilizador. Caso não concorde com as alterações introduzidas, o utilizador deverá cessar imediatamente a utilização da plataforma e, se aplicável, proceder ao cancelamento da sua conta.</p>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mt-3">
                            <p class="font-medium text-yellow-800">Nota importante:</p>
                            <p class="text-gray-700">Consideramos que o utilizador aceita as Condições Gerais de Utilização em vigor cada vez que acede à plataforma. É da responsabilidade do utilizador verificar eventuais alterações a estes termos.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 11 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-4 text-blue-900">
                        <div class="mr-3 flex-shrink-0">
                            <i class="bi bi-bank text-blue-900 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">11. Lei Aplicável e Foro Competente</h2>
                    </div>
                    <div class="ml-9 space-y-3">
                        <p>As presentes Condições Gerais de Utilização, bem como toda a relação estabelecida entre o utilizador e a HabitaX, regem-se pela legislação portuguesa em vigor.</p>

                        <p>Para a resolução de quaisquer conflitos emergentes da aplicação, interpretação ou integração das presentes Condições Gerais de Utilização, designadamente quanto à sua validade, eficácia ou incumprimento, as partes acordam que o foro competente será o da Comarca de Lisboa, com expressa renúncia a qualquer outro.</p>

                        <div class="bg-gray-50 p-4 rounded-lg my-3">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Resolução alternativa de litígios:</h3>
                            <p class="text-gray-700">Em caso de litígio de consumo, o utilizador pode recorrer a uma Entidade de Resolução Alternativa de Litígios de Consumo competente. Para obter mais informações, consulte o Portal do Consumidor em <a href="https://www.consumidor.gov.pt" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:text-indigo-800 font-medium">www.consumidor.gov.pt</a> ou a plataforma europeia de resolução de litígios online disponível em <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:text-indigo-800 font-medium">https://ec.europa.eu/consumers/odr</a>.</p>
                        </div>

                        <p>A eventual declaração de nulidade ou ineficácia de qualquer disposição das presentes Condições Gerais de Utilização não prejudica a validade ou eficácia das restantes disposições.</p>
                    </div>
                </div>
            </div>

            <!-- Última Atualização -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mt-8">
                <div class="text-center">
                    <p class="text-gray-600">Última atualização: <span class="font-medium text-blue-900">15 de abril de 2025</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
