<div id="shareModal" hidden class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-0 transition-all duration-300 hidden">
    <div class="modal-content relative w-full max-w-md transform scale-95 opacity-0 transition-all duration-300">
        <div class="bg-white bg-opacity-95 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-900 to-indigo-600 p-5 text-white relative">
                <button id="closeShareModal" class="absolute top-3 right-3 text-white hover:text-gray-200 transition-all">
                    <i class="bi bi-x-lg"></i>
                </button>
                <h3 class="text-xl font-bold flex items-center">
                    <i class="bi bi-share-fill mr-2"></i>
                    Partilhar Anúncio
                </h3>
            </div>

            <div class="p-6 space-y-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray">Link do anúncio</label>
                    <div class="relative focus-within:ring-1 focus-within:ring-indigo-400 transition-all rounded-xl border border-gray-200 bg-gray-50">
                        <input
                            id="shareLink"
                            type="text"
                            class="w-full px-3 py-2 pr-10 bg-transparent border-none rounded-xl text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-0"
                            value="{{ route('advertisements.show', $ad->id) }}"
                            readonly
                        >
                        <button
                            id="copyLinkBtn"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-gray-100 hover:bg-indigo-100 rounded-full text-gray-600 hover:text-indigo-600 transition-all shadow-sm"
                            title="Copiar link"
                        >
                            <i id="copyIcon" class="bi bi-clipboard transition-all duration-300"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray mb-2">Partilhar via</label>
                    <div class="flex space-x-2">
                        <button id="shareWhatsApp" class="flex items-center justify-center flex-1 py-2 px-3 rounded-lg bg-green-500 hover:bg-green-600 text-white transition-all">
                            <i class="bi bi-whatsapp mr-1"></i>
                            WhatsApp
                        </button>
                        <button id="shareFacebook" class="flex items-center justify-center flex-1 py-2 px-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-all">
                            <i class="bi bi-facebook mr-1"></i>
                            Facebook
                        </button>
                        <button id="shareTwitter" class="flex items-center justify-center flex-1 py-2 px-3 rounded-lg bg-blue-400 hover:bg-blue-500 text-white transition-all">
                            <i class="bi bi-twitter-x mr-1"></i>
                            Twitter
                        </button>
                    </div>
                </div>

                <form id="shareEmailForm" action="{{ route('share.email') }}" method="POST" class="pt-3 border-t border-gray-200">
                    @csrf
                    <input type="hidden" name="advertisement_id" value="{{ $ad->id }}">
                    <input type="hidden" name="advertisement_url" value="{{ route('advertisements.show', $ad->id) }}">

                    <label class="block text-sm font-medium text-gray mb-2">Enviar por email</label>

                    <div class="mb-3">
                        <label class="block text-xs text-gray-500 mb-1">O seu email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input
                                id="inputEmail"
                                name="sender_email"
                                type="email"
                                class="w-full pl-10 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="O seu email"
                                value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                {{ auth()->check() ? 'readonly' : '' }}
                                required
                            >
                            @if(auth()->check()) @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-xs text-gray-500 mb-1">Assunto</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="bi bi-chat-dots"></i>
                            </span>
                            <input
                                id="emailSubject"
                                name="subject"
                                type="text"
                                class="w-full pl-10 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Exemplo: O que achas deste anúncio? {{ $ad->title }}"
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-xs text-gray-500 mb-1">Para quem quer enviar?</label>
                        <div class="border border-gray-200 rounded-xl bg-gray-50 px-3 py-2 focus-within:ring-1 focus-within:ring-indigo-500 transition-all">
                            <div class="flex flex-wrap gap-2 mb-2" id="emailTags"></div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500">
                                    <i class="bi bi-people-fill"></i>
                                </span>
                                <input
                                    id="emailInput"
                                    type="email"
                                    class="grow py-1.5 bg-transparent border-none focus:outline-none focus:ring-0 text-sm placeholder:text-gray-400"
                                    placeholder="Digite um email e pressione Enter"
                                >
                                <input type="hidden" name="recipient_emails" id="recipientEmailsInput">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-xs text-gray-500 mb-1">Mensagem (opcional)</label>
                        <div class="relative focus-within:ring-1 focus-within:ring-indigo-500 transition-all rounded-xl border border-gray-200 bg-gray-50">
                            <span class="absolute top-2.5 left-3 text-gray-500">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea
                                id="emailMessage"
                                name="message"
                                rows="3"
                                class="w-full pl-10 pr-3 py-2 bg-transparent border-none resize-none text-sm focus:outline-none focus:ring-0 placeholder:text-gray-400 rounded-xl"
                                placeholder="Mensagem (opcional)"
                            ></textarea>
                        </div>
                    </div>


                    <div class="flex items-center justify-end space-x-3 pt-2">
                        <button type="button" id="cancelShare" class="btn-gray px-4 py-2">
                            Cancelar
                        </button>
                        <button type="submit" id="submitShare" class="btn-primary px-4 py-2">
                            <i class="bi bi-send-fill mr-1"></i>
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/advertisements/share-advertisement.js') }}"></script>
