<section class="max-w-5xl mx-auto mb-24 px-4">
    <h2 class="text-center text-5xl font-bold text-black tracking-tight">FAQ’s</h2>
    <p class="text-center text-gray mt-4 mb-10">As Perguntas Mais Frequentes</p>

    <div class="bg-gray-50 rounded-2xl shadow-xl divide-y divide-gray-200">

        @php
            $faqs = [
  ['question' => 'É necessário criar uma conta para publicar um anúncio?',
   'answer' => 'Sim, para garantir a segurança e permitir a gestão dos seus anúncios, é necessário criar uma conta antes de publicar.'],

  ['question' => 'Como posso recuperar a minha password?',
   'answer' => 'Clique em "Esqueci-me da Password" na página de login e siga as instruções para redefinir a sua password.'],

  ['question' => 'Como faço para criar um anúncio?',
   'answer' => 'Primeiro, conclua a verificação de anunciante. Em seguida, vá à secção "Minhas Propriedades" para adicionar uma ou mais propriedades. Por fim, aceda à secção "Meus Anúncios", preencha o formulário com os detalhes necessários e clique em "Publicar Anúncio". A sua propriedade será listada de imediato.'],

  ['question' => 'Existe algum custo para publicar um anúncio?',
   'answer' => 'A publicação de anúncios básicos é gratuita. No entanto, pode optar por serviços pagos para destacar o seu anúncio e obter mais visibilidade.'],

  ['question' => 'Como posso entrar em contacto com o proprietário de um anúncio?',
   'answer' => 'Utilize o formulário de contacto disponível na página do anúncio ou ligue para o número de telefone fornecido.'],

  ['question' => 'Como posso alterar a minha password?',
   'answer' => 'Vá até às definições da sua conta e clique na opção "Alterar Password".'],

  ['question' => 'Como faço para editar ou eliminar um anúncio?',
   'answer' => 'Aceda à sua dashboard, selecione o anúncio que pretende editar ou eliminar e utilize o respetivo botão.'],

  ['question' => 'Como reporto um problema com uma propriedade?',
   'answer' => 'Contacte a nossa equipa de suporte utilizando o formulário acima ou envie-nos um email diretamente para suporte@habitax.pt.'],

  ['question' => 'Como posso fazer o meu número aparecer nos meus anúncios?',
   'answer' => 'Aceda às definições da sua conta e ative a opção para mostrar o número de telefone nos anúncios.'],

  ['question' => 'Posso incluir mais de uma imagem no meu anúncio?',
   'answer' => 'Sim, pode adicionar várias imagens durante o processo de criação ou edição do anúncio. Isso ajuda a aumentar o interesse dos potenciais compradores.']
];

        @endphp

        @foreach ($faqs as $index => $faq)
            <div class="p-6 transition-all hover:bg-gray-100 group">
                <div class="flex justify-between items-start cursor-pointer" onclick="toggleFaq({{ $index }})">
                    <div class="flex items-center space-x-3">
                        <span
                            class="text-xl font-extrabold text-black">{{ $index + 1 < 10 ? '0' . ($index + 1) : $index + 1 }}</span>
                        <h3 class="text-secondary  font-bold text-lg">{{ $faq['question'] }}</h3>
                    </div>
                    <button
                        class="text-secondary text-2xl font-bold focus:outline-none transition-transform duration-300 transform"
                        id="toggle-icon-{{ $index }}">+
                    </button>
                </div>
                <div
                    class="mt-4 pl-11 text-sm text-gray max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out"
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
