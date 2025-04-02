<section class="max-w-5xl mx-auto mt-20 mb-24 px-4">
    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">FAQ’s</h2>
    <p class="text-center text-sm text-gray-500 mb-10">As Perguntas Mais Frequentemente Feitas</p>

    <div class="bg-gray-50 rounded-2xl shadow-xl divide-y divide-gray-200">

        @php
            $faqs = [
              ['question' => 'Como faço para criar um anúncio?', 'answer' => 'Preencha o formulário com os detalhes necessários e clique no botão "Publicar Anúncio". A sua propriedade vai ser listada de imediato!.'],
              ['question' => 'Como faço para editar ou eleminar um anúncio?', 'answer' => 'Vá até a sua dashboard, selecione o anúncio que deseja editar ou eleminar, e utilize o respetivo botão.'],
              ['question' => 'Como posso agendar uma visita?', 'answer' => 'Utilize o formulário de contacto ou o número de telefone fornecido no anúncio para coordenar a visita diretamente com o dono da propriedade.'],
              ['question' => 'Como reporto um problema com uma propriedade?', 'answer' => 'Contacte a nossa equipa de suporte utilizando o formulario acima ou envie-nos um email diretamente no endereço suporte@habitax.pt.']
            ];
        @endphp

        @foreach ($faqs as $index => $faq)
            <div class="p-6 transition-all hover:bg-gray-100 group">
                <div class="flex justify-between items-start cursor-pointer" onclick="toggleFaq({{ $index }})">
                    <div class="flex items-center space-x-3">
                        <span
                            class="text-xl font-extrabold text-gray-800">{{ $index + 1 < 10 ? '0' . ($index + 1) : $index + 1 }}</span>
                        <h3 class="text-indigo-700 font-bold text-lg">{{ $faq['question'] }}</h3>
                    </div>
                    <button
                        class="text-indigo-600 text-2xl font-bold focus:outline-none transition-transform duration-300 transform"
                        id="toggle-icon-{{ $index }}">+
                    </button>
                </div>
                <div
                    class="mt-4 pl-11 text-sm text-gray-700 max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out"
                    id="faq-answer-{{ $index }}">
                    {{ $faq['answer'] }}
                </div>
            </div>
        @endforeach

        <script>
            function toggleFaq(index) {
                const answer = document.getElementById(`faq-answer-${index}`);
                const icon = document.getElementById(`toggle-icon-${index}`);
                const isOpen = answer.style.maxHeight && answer.style.maxHeight !== "0px";

                // Esconde todas as respostas
                document.querySelectorAll('[id^="faq-answer-"]').forEach(el => {
                    el.style.maxHeight = "0px";
                    el.style.opacity = "0";
                });
                document.querySelectorAll('[id^="toggle-icon-"]').forEach(el => el.innerText = '+');

                // Se a caixa não estiver aberta, abra-a
                if (!isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    answer.style.opacity = "1";
                    icon.innerText = '×';
                }
            }
        </script>
    </div>
</section>
