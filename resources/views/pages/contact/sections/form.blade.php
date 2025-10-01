<div class="max-w-7xl mx-auto px-6 lg:px-8 mt-24 mb-32">
    <div class="grid grid-cols-1 md:grid-cols-2 bg-white shadow-2xl rounded-3xl overflow-hidden transition-all duration-500 hover:scale-[1.01]">
        {{-- Left Info Box --}}
        <div class="bg-gradient-to-br from-indigo-700 to-indigo-900 text-white p-10 flex flex-col justify-between relative overflow-hidden">
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
                        <span>info@habitax.pt</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-geo-alt-fill text-xl"></i>
                        <span>Rua Comandante Pinho e Freitas, nº 28, 3750 – 127 Águeda, Portugal</span>
                    </div>
                </div>
            </div>
            {{-- Decoration --}}
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-primary rounded-full translate-x-1/2 translate-y-1/2 blur-3xl opacity-40 z-0"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 bg-secondary rounded-full translate-x-1/3 translate-y-1/2 blur-2xl opacity-30 z-0"></div>
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
                               placeholder="João"
                               value="{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : old('first_name') }}">
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
                               placeholder="Silva"
                               value="{{ auth()->check() && str_word_count(auth()->user()->name) > 1 ? substr(auth()->user()->name, strlen(explode(' ', auth()->user()->name)[0]) + 1) : old('last_name') }}">
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
                               placeholder="joao.silva@exemplo.com"
                               value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
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
                               placeholder="+351912345678"
                               value="{{ auth()->check() && auth()->user()->telephone ? auth()->user()->telephone : old('telephone') }}">
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
                              placeholder="Escreva a sua mensagem aqui...">{{ old('message') }}</textarea>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.querySelector('form[action="{{ route('contact-us.store') }}"]');
        const telephoneInput = document.getElementById('telephone');
        // Validação do número de telefone
        function validatePhone(phone) {
            // Aceita números com ou sem código de país (+XXX)
            const phoneRegex = /^(\+[0-9]{1,3})?[0-9]{9,15}$/;
            return phoneRegex.test(phone.replace(/\s+/g, ''));
        }
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Validar telefone antes de enviar
            const phoneValue = telephoneInput.value.trim();

            if (!validatePhone(phoneValue)) {
                // Remover mensagens de erro anteriores
                const existingPhoneError = document.getElementById('telephone-error');
                if (existingPhoneError) {
                    existingPhoneError.remove();
                }
                // Criar e mostrar mensagem de erro
                const errorDiv = document.createElement('div');
                errorDiv.id = 'telephone-error';
                errorDiv.className = 'text-red-500 text-sm mt-1';
                errorDiv.textContent = 'Por favor, insira um número de telefone válido (apenas dígitos, pode incluir o prefixo +).';
                telephoneInput.parentNode.appendChild(errorDiv);
                telephoneInput.focus();
                return;
            }
            // Criar FormData do formulário
            const formData = new FormData(contactForm);
            // Desabilitar botão durante o envio
            const submitButton = contactForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>A enviar...';

            // Remover mensagens de erro ou sucesso anteriores
            const existingAlert = document.getElementById('contact-form-alert');
            if (existingAlert) {
                existingAlert.remove();
            }
            fetch('{{ route('contact-us.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => response.json())
                .then(data => {
                    // Restaurar botão
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                    // Criar elemento de alerta
                    const alertDiv = document.createElement('div');
                    alertDiv.id = 'contact-form-alert';
                    alertDiv.className = data.success
                        ? 'mt-4 p-4 bg-green-100 text-green-800 rounded'
                        : 'mt-4 p-4 bg-red-100 text-red-800 rounded';
                    alertDiv.textContent = data.message || 'Ocorreu um erro inesperado.';
                    // Inserir alerta após o formulário
                    contactForm.after(alertDiv);
                    // Limpar formulário se for sucesso
                    if (data.success) {
                        contactForm.reset();
                    }
                })

                .catch(error => {
                    console.error('Erro:', error);
                    // Restaurar botão
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    // Mostrar mensagem de erro
                    const alertDiv = document.createElement('div');
                    alertDiv.id = 'contact-form-alert';
                    alertDiv.className = 'mt-4 p-4 bg-red-100 text-red-800 rounded';
                    alertDiv.textContent = 'Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente ou contacte-nos diretamente.';
                    contactForm.after(alertDiv);
                });
        });
        // Adicionar validação em tempo real ao campo de telefone
        telephoneInput.addEventListener('input', function() {
            const errorDiv = document.getElementById('telephone-error');
            if (errorDiv) {
                if (validatePhone(this.value.trim())) {
                    errorDiv.remove();
                    this.classList.remove('border-red-500');
                }
            }
        });
    });
</script>
