<div class="max-w-7xl mx-auto px-6 lg:px-8 mt-24 mb-32">
    <div
        class="grid grid-cols-1 md:grid-cols-2 bg-white shadow-2xl rounded-3xl overflow-hidden transition-all duration-500 hover:scale-[1.01]">

        {{-- Left Info Box --}}
        <div
            class="bg-gradient-to-br from-indigo-700 to-indigo-900 text-white p-10 flex flex-col justify-between relative overflow-hidden">
            <div>
                <h3 class="text-2xl font-bold mb-4">Informação de Contacto</h3>
                <p class="text-sm text-indigo-200 mb-10">Os nossos contactos</p>
                <div class="space-y-6 text-base font-medium">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-telephone-fill text-xl"></i>
                        <span>+351 912 345 678</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-envelope-fill text-xl"></i>
                        <span>habitax@project.pt</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-geo-alt-fill text-xl"></i>
                        <span>Rua Exemplo, 123, Lisboa, Portugal</span>
                    </div>
                </div>
            </div>

            {{-- Decoration --}}
            <div
                class="absolute bottom-0 left-0 w-32 h-32 bg-primary rounded-full translate-x-1/2 translate-y-1/2 blur-3xl opacity-40 z-0"></div>
            <div
                class="absolute bottom-0 right-0 w-48 h-48 bg-secondary rounded-full translate-x-1/3 translate-y-1/2 blur-2xl opacity-30 z-0"></div>
        </div>

        {{-- Right Form --}}
        <div class="p-10 bg-gray-50">
            <form action="{{ route('contact-us.store') }}" method="POST" class="space-y-6 relative z-10" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray">Nome</label>
                        <input type="text" id="first_name" name="first_name"
                               class="form-input" required
                               placeholder="João">
                        @error('first_name')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray">Apelido</label>
                        <input type="text" id="last_name" name="last_name"
                               class="form-input" required
                               placeholder="Silva">
                        @error('last_name')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray">Email</label>
                        <input type="email" id="email" name="email"
                               class="form-input" required
                               placeholder="joao.silva@exemplo.com">
                        @error('email')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="telephone" class="block text-sm font-semibold text-gray">Número de Telefone</label>
                        <input type="text" id="telephone" name="telephone"
                               class="form-input" required
                               placeholder="+351 912 345 678">
                        @error('telephone')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold text-gray">Mensagem</label>
                    <textarea id="message" name="message" rows="4"
                              class="form-input" minlength="10"
                              required
                              placeholder="Escreva a sua mensagem aqui..."></textarea>
                    @error('message')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full btn-secondary py-3">
                        Enviar Mensagem
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
