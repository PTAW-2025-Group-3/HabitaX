{{-- Section: Client Testimonials --}}
<section class="py-12 sm:py-16 md:py-24 px-4 sm:px-6 bg-white">
    <div class="max-w-6xl mx-auto text-center">

        {{-- Section Title --}}
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-secondary mb-8 md:mb-12">
            O que os <span class="text-secondary">Nossos Clientes</span> dizem
        </h2>

        {{-- Carousel Wrapper --}}
        <div class="relative">
            {{-- Setas --}}
            <button id="testimonial-prev"
                    class="absolute -left-3 sm:-left-6 top-1/2 transform -translate-y-1/2 bg-indigo-100 text-secondary rounded-full w-8 h-8 sm:w-10 sm:h-10 shadow hover:bg-indigo-200 transition z-10 hidden flex items-center justify-center">
                <i class="bi bi-chevron-left text-lg sm:text-xl leading-none"></i>
            </button>

            <button id="testimonial-next"
                    class="absolute -right-3 sm:-right-6 top-1/2 transform -translate-y-1/2 bg-indigo-100 text-secondary rounded-full w-8 h-8 sm:w-10 sm:h-10 shadow hover:bg-indigo-200 transition z-10 flex items-center justify-center">
                <i class="bi bi-chevron-right text-lg sm:text-xl leading-none"></i>
            </button>

            {{-- Slides de Testemunhos --}}
            @php
                $testemunhos = [
                  [
                    ['nome' => 'John Doe I', 'imagem' => 'images/clien1.jpg', 'profissao' => 'Arquiteto', 'mensagem' => 'O HabitaX ajudou-me a arrendar o apartamento rapidamente. Em menos de uma semana já tinha interessados. Recomendo pela segurança e facilidade.'],
                    ['nome' => 'John Doe II', 'imagem' => 'images/client2.jpg', 'profissao' => 'Professor Assistente', 'mensagem' => 'Encontrei exatamente o que procurava para o meu estúdio de tatuagem. A plataforma é rápida e o proprietário respondeu de imediato!']
                  ],
                  [
                    ['nome' => 'Jane Doe', 'imagem' => 'images/client3.jpg', 'profissao' => 'Freelancer', 'mensagem' => 'I found a perfect place in Lisbon. HabitaX makes things really easy!'],
                    ['nome' => 'Carlos Pinto', 'imagem' => 'images/client4.jpg', 'profissao' => 'Digital Nomad', 'mensagem' => 'Easy booking and smooth process. Recommended for anyone looking to rent short-term!']
                  ],
                ];
            @endphp

            <div class="flex flex-col items-center gap-6 md:gap-8">
                @foreach ($testemunhos as $index => $grupo)
                    <div id="testimonial-group-{{ $index + 1 }}"
                         class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 w-full max-w-4xl {{ $index !== 0 ? 'hidden' : '' }}">
                        @foreach ($grupo as $cliente)
                            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-4 h-72 sm:p-6 shadow hover:shadow-lg transition flex items-center justify-center flex-col">
                                <img src="{{ asset($cliente['imagem']) }}" alt="{{ $cliente['nome'] }}"
                                     class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mx-auto mb-3 sm:mb-4 border-2 border-secondary" />
                                <h4 class="text-base sm:text-lg font-semibold text-gray-800">{{ $cliente['nome'] }}</h4>
                                <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ $cliente['profissao'] }}</p>
                                <p class="text-xs sm:text-sm text-gray-600 italic leading-relaxed">
                                    <i class="bi bi-quote text-xl sm:text-2xl text-gray mb-1 sm:mb-2"></i>
                                    {{ $cliente['mensagem'] }}
                                    <i class="bi bi-quote text-xl sm:text-2xl text-gray mb-1 sm:mb-2 inline-block rotate-180"></i>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Dot Indicators (Mobile Only) --}}
        <div class="flex justify-center mt-6 md:hidden">
            <span class="h-2 w-2 rounded-full bg-secondary mx-1 indicator active" data-index="0"></span>
            <span class="h-2 w-2 rounded-full bg-gray-300 mx-1 indicator" data-index="1"></span>
        </div>
    </div>

    {{-- JavaScript Carousel --}}
    <script>
        const groups = [
            document.getElementById('testimonial-group-1'),
            document.getElementById('testimonial-group-2')
        ];
        const nextBtn = document.getElementById('testimonial-next');
        const prevBtn = document.getElementById('testimonial-prev');
        const indicators = document.querySelectorAll('.indicator');
        let current = 0;

        function updateCarousel(index) {
            groups.forEach((g, i) => g.classList.toggle('hidden', i !== index));
            prevBtn.classList.toggle('hidden', index === 0);
            nextBtn.classList.toggle('hidden', index === groups.length - 1);

            // Update indicators
            indicators.forEach((ind, i) => {
                if (i === index) {
                    ind.classList.add('bg-secondary');
                    ind.classList.remove('bg-gray-300');
                } else {
                    ind.classList.remove('bg-secondary');
                    ind.classList.add('bg-gray-300');
                }
            });
        }

        nextBtn.addEventListener('click', () => {
            if (current < groups.length - 1) {
                current++;
                updateCarousel(current);
            }
        });

        prevBtn.addEventListener('click', () => {
            if (current > 0) {
                current--;
                updateCarousel(current);
            }
        });

        // Add indicator click functionality
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                current = index;
                updateCarousel(current);
            });
        });

        // Add touch swipe functionality for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold && current < groups.length - 1) {
                // Swipe left
                current++;
                updateCarousel(current);
            } else if (touchEndX > touchStartX + swipeThreshold && current > 0) {
                // Swipe right
                current--;
                updateCarousel(current);
            }
        }
    </script>
</section>
