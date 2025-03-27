{{-- Section: Client Testimonials --}}
<section class="py-24 px-6 h-[560px] bg-white">
    <div class="max-w-6xl mx-auto text-center">
      {{-- Section Title --}}
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">
        O que os  <span class="text-indigo-500">Nossos Clientes</span> dizem
      </h2>

      {{-- Carousel Wrapper --}}
      <div class="relative">
        {{-- Left Arrow --}}
        <button id="testimonial-prev"
          class="absolute -left-6 top-1/2 transform -translate-y-1/2 bg-indigo-100 text-indigo-600 rounded-full w-10 h-10 shadow hover:bg-indigo-200 transition z-10 hidden">
          <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        {{-- Right Arrow --}}
        <button id="testimonial-next"
          class="absolute -right-6 top-1/2 transform -translate-y-1/2 bg-indigo-100 text-indigo-600 rounded-full w-10 h-10 shadow hover:bg-indigo-200 transition z-10">
          <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        {{-- Slides Groups --}}
        <div class="flex flex-col items-center gap-8">
          {{-- Slide 1 --}}
          <div id="testimonial-group-1" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl">
            {{-- Client 1 --}}
            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-6 shadow hover:shadow-lg transition">
              <img src="{{ asset('images/clien1.jpg') }}" alt="Client 1"
                class="w-16 h-16 rounded-full mx-auto mb-4 border-2 border-indigo-500" />
              <h4 class="text-lg font-semibold text-gray-800">John Doe I</h4>
              <p class="text-sm text-gray-500 mb-2">Arquiteto</p>
              <p class="text-sm text-gray-600 italic leading-relaxed">
                  <i class="bi bi-quote text-2xl text-gray-400 mb-2"></i>
                  O HabitaX ajudou-me a arrendar o apartamento rapidamente.
                  Em menos de uma semana já tinha interessados. Recomendo pela segurança e facilidade."
                  <i class="bi bi-quote text-2xl text-gray-400 mb-2 inline-block rotate-180"></i>
              </p>
            </div>

            {{-- Client 2 --}}
            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-6 shadow hover:shadow-lg transition">
              <img src="{{ asset('images/client2.jpg') }}" alt="Client 2"
                class="w-16 h-16 rounded-full mx-auto mb-4 border-2 border-indigo-500" />
              <h4 class="text-lg font-semibold text-gray-800">John Doe II</h4>
              <p class="text-sm text-gray-500 mb-2">Professor Assistente</p>
              <p class="text-sm text-gray-600 italic leading-relaxed">
                <i class="bi bi-quote text-2xl text-gray-400 mb-2"></i>
                "Encontrei exatamente o que procurava para o meu estúdio. A plataforma é rápida e o proprietário respondeu de imediato!"
                <i class="bi bi-quote text-2xl text-gray-400 mb-2 inline-block rotate-180"></i>
              </p>
            </div>
          </div>

          {{-- Slide 2 (Initially hidden) --}}
          <div id="testimonial-group-2" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl hidden">
            {{-- Client 3 --}}
            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-6 shadow hover:shadow-lg transition">
              <img src="{{ asset('images/client3.jpg') }}" alt="Client 3"
                class="w-16 h-16 rounded-full mx-auto mb-4 border-2 border-indigo-500" />
              <h4 class="text-lg font-semibold text-gray-800">Jane Doe</h4>
              <p class="text-sm text-gray-500 mb-2">Freelancer</p>
              <p class="text-sm text-gray-600 italic leading-relaxed">
                “I found a perfect place in Lisbon. HabitaX makes things really easy!”
              </p>
            </div>

            {{-- Client 4 --}}
            <div class="bg-gray-50 border border-indigo-200 rounded-lg p-6 shadow hover:shadow-lg transition">
              <img src="{{ asset('images/client4.jpg') }}" alt="Client 4"
                class="w-16 h-16 rounded-full mx-auto mb-4 border-2 border-indigo-500" />
              <h4 class="text-lg font-semibold text-gray-800">Carlos Pinto</h4>
              <p class="text-sm text-gray-500 mb-2">Digital Nomad</p>
              <p class="text-sm text-gray-600 italic leading-relaxed">
                “Easy booking and smooth process. Recommended for anyone looking to rent short-term!”
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- JavaScript Logic --}}
    <script>
      const group1 = document.getElementById('testimonial-group-1');
      const group2 = document.getElementById('testimonial-group-2');
      const nextBtn = document.getElementById('testimonial-next');
      const prevBtn = document.getElementById('testimonial-prev');

      nextBtn.addEventListener('click', () => {
        group1.classList.add('hidden');
        group2.classList.remove('hidden');
        nextBtn.classList.add('hidden');
        prevBtn.classList.remove('hidden');
      });

      prevBtn.addEventListener('click', () => {
        group2.classList.add('hidden');
        group1.classList.remove('hidden');
        prevBtn.classList.add('hidden');
        nextBtn.classList.remove('hidden');
      });
    </script>
  </section>
