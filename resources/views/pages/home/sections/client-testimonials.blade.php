{{-- Section: Client Testimonials --}}
<section class="py-12 sm:py-16 md:py-24 px-4 sm:px-6 bg-back">
    <div class="max-w-6xl mx-auto text-center">

        {{-- Section Title --}}
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-secondary mb-8 md:mb-12">
            O que os <span class="text-secondary">Nossos Clientes</span> dizem
        </h2>

        {{-- Carousel Wrapper --}}
        <div class="relative">
            @php
                $path = 'images/clients/';
                $testemunhos = [
                    [
                        [
                            'nome' => 'João Figueira',
                            'imagem' => 'client1.jpg',
                            'profissao' => 'Arquiteto',
                            'mensagem' => 'O HabitaX ajudou-me a arrendar o T1 mais rápido do que o tempo que demorei a montar o IKEA. Em três dias já tinha visitas marcadas. Recomendo!'
                        ],
                        [
                            'nome' => 'Beatriz Lopes',
                            'imagem' => 'client2.jpg',
                            'profissao' => 'Professora Assistente',
                            'mensagem' => 'Achei o espaço ideal para as minhas aulas de yoga online. Silencioso, boa luz e sem vizinhos a tocar flauta às 8h da manhã. 10/10!'
                        ]
                    ],
                    [
                        [
                            'nome' => 'André Costa',
                            'imagem' => 'client3.jpg',
                            'profissao' => 'Freelancer em TI',
                            'mensagem' => 'Encontrei um T0 com internet melhor que a do meu antigo escritório. Agora trabalho de pantufas e café sempre à mão. Obrigado, HabitaX!'
                        ],
                        [
                            'nome' => 'Inês Matos',
                            'imagem' => 'client4.jpg',
                            'profissao' => 'Nómada Digital',
                            'mensagem' => 'Arrendei um loft em menos tempo do que o delivery da UberEats. O senhorio respondeu mais rápido que o meu ex. Fantástico!'
                        ]
                    ],
                    [
                        [
                            'nome' => 'Manuela Moura Guedes',
                            'imagem' => 'client5.jpg',
                            'profissao' => 'Designer Gráfico',
                            'mensagem' => 'O site é tão fácil de usar que até o meu gato quase fez uma reserva enquanto dormia em cima do teclado.'
                        ],
                        [
                            'nome' => 'Cláudia Ferreira',
                            'imagem' => 'client6.jpg',
                            'profissao' => 'Engenheira de Software',
                            'mensagem' => 'O suporte respondeu-me num piscar de olhos. Mais rápido que a minha app em produção (e com menos bugs).'
                        ]
                    ],
                    [
                        [
                            'nome' => 'Marta Cruz',
                            'imagem' => 'client7.jpg',
                            'profissao' => 'Atriz',
                            'mensagem' => 'A experiência foi tão boa que quase pedi uma segunda casa... só porque sim. Simples, rápido e sem dramas (nem ensaios!).'
                        ],
                        [
                            'nome' => 'Tiago Rocha',
                            'imagem' => 'client8.jpg',
                            'profissao' => 'Fotógrafo',
                            'mensagem' => 'Encontrei o estúdio ideal. Luz natural impecável, vizinhos discretos e uma parede branca digna de catálogo.'
                        ]
                    ]
                ];
            @endphp

            {{-- Carousel (Flickity) --}}
            <div class="carousel" data-flickity='{
                "cellAlign": "center",
                "contain": true,
                "wrapAround": true,
                "autoPlay": 10000,
                "prevNextButtons": true,
                "pageDots": true,
                "adaptiveHeight": true,
                "selectedAttraction": 0.015,
                "friction": 0.25
            }'>
                @foreach ($testemunhos as $grupo)
                    @foreach ($grupo as $cliente)
                        <div class="carousel-cell px-4">
                            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-4 h-72 sm:p-6 shadow hover:shadow-lg transition flex items-center justify-center flex-col">
                                <img src="{{ asset($path . $cliente['imagem']) }}" alt="{{ $cliente['nome'] }}"
                                     class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mx-auto mb-3 sm:mb-4 border-2 border-secondary object-cover" />
                                <h4 class="text-base sm:text-lg font-semibold text-gray-800">{{ $cliente['nome'] }}</h4>
                                <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ $cliente['profissao'] }}</p>
                                <p class="text-xs sm:text-sm text-gray-600 italic leading-relaxed text-center">
                                    <i class="bi bi-quote text-xl sm:text-2xl text-gray mb-1 sm:mb-2"></i>
                                    {{ $cliente['mensagem'] }}
                                    <i class="bi bi-quote text-xl sm:text-2xl text-gray mb-1 sm:mb-2 inline-block rotate-180"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Flickity CSS/JS --}}
@push('styles')
    <style>
        .carousel-cell {
            max-width: 33rem;
            margin: 0 3rem;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.5;
            transform: scale(0.85);
            filter: blur(1px);
            overflow: hidden;
        }
        .carousel-cell.is-selected {
            opacity: 1;
            transform: scale(1);
            filter: none;
        }
        @media screen and (min-width: 768px) {
            .carousel-cell {
                height: 400px;
            }
        }
        @media screen and (min-width: 960px) {
            .carousel-cell {
                width: 60%;
            }
        }
    </style>
@endpush
