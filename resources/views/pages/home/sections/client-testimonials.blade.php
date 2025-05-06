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
                        ['nome' => 'John Doe I', 'imagem' => 'client1.jpg', 'profissao' => 'Arquiteto', 'mensagem' => 'O HabitaX ajudou-me a arrendar o apartamento rapidamente. Em menos de uma semana já tinha interessados. Recomendo pela segurança e facilidade.'],
                        ['nome' => 'John Doe II', 'imagem' => 'client2.jpg', 'profissao' => 'Professor Assistente', 'mensagem' => 'Encontrei exatamente o que procurava para o meu estúdio de tatuagem. A plataforma é rápida e o proprietário respondeu de imediato!']
                    ],
                    [
                        ['nome' => 'Jane Doe', 'imagem' => 'client3.jpg', 'profissao' => 'Freelancer', 'mensagem' => 'I found a perfect place in Lisbon. HabitaX makes things really easy!'],
                        ['nome' => 'Carlos Pinto', 'imagem' => 'client4.jpg', 'profissao' => 'Digital Nomad', 'mensagem' => 'Easy booking and smooth process. Recommended for anyone looking to rent short-term!']
                    ],
                    [
                        ['nome' => 'Maria Silva', 'imagem' => 'client5.jpg', 'profissao' => 'Designer Gráfico', 'mensagem' => 'A plataforma é intuitiva e fácil de usar. Encontrei o apartamento perfeito em Lisboa!'],
                        ['nome' => 'Pedro Santos', 'imagem' => 'client6.jpg', 'profissao' => 'Engenheiro de Software', 'mensagem' => 'O suporte ao cliente foi excepcional. Resolvi todas as minhas dúvidas rapidamente.']
                    ],
                    [
                        ['nome' => 'Mia Costa', 'imagem' => 'client7.jpg', 'profissao' => 'Atriz', 'mensagem' => 'Amei a experiência de alugar através do HabitaX. O processo foi simples e rápido!'],
                        ['nome' => 'Luís Almeida', 'imagem' => 'client8.jpg', 'profissao' => 'Fotógrafo', 'mensagem' => 'Encontrei o espaço perfeito para o meu estúdio. Recomendo a todos!']
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
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
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

@push('scripts')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        //
    </script>
@endpush
