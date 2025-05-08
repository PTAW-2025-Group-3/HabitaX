<div class="bg-gradient-to-tr from-white to-gray-50 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-7 space-y-6 animate-fade-in">
<div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-lg md:text-xl font-bold text-primary flex items-center gap-2">
            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Contactar o Anunciante
        </h3>

        <div class="flex flex-col items-center gap-1 text-center">
            @if($ad->creator && $ad->creator->profile_picture_path)
                <img src="{{ Storage::url($ad->creator->profile_picture_path) }}"
                     alt="{{ $ad->creator->name }}"
                     class="w-10 h-10 rounded-full object-cover shadow-sm">
            @else
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 shadow-sm">
                    <i class="bi bi-person text-lg"></i>
                </div>
            @endif
            <span class="text-xs text-gray-500 truncate max-w-[80px]">{{ $ad->creator->name ?? 'Anunciante' }}</span>
        </div>
    </div>

    {{-- Success message --}}
    <div id="successMessage" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center {{ session('success') ? '' : 'hidden' }}">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') ?? 'O seu pedido de contacto foi enviado com sucesso!' }}</span>
    </div>

    {{-- Formulário --}}
    <form method="POST" action="{{ route('contact-requests.store') }}" id="contactForm" class="space-y-4 text-sm md:text-base">
        @csrf
        <input type="hidden" name="advertisement_id" value="{{ $ad->id }}">

        {{-- Nome --}}
        <div>
            <label for="name" class="block text-gray-600 text-xs md:text-sm mb-1">O seu nome</label>
            <input type="text" id="name" name="name" class="form-input @error('name') border-red-300 @enderror"
                   placeholder="O seu nome" value="{{ auth()->user()?->name ?? old('name') }}" required>
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-600 text-xs md:text-sm mb-1">O seu email</label>
            <input type="email" id="email" name="email" class="form-input @error('email') border-red-300 @enderror"
                   placeholder="exemplo@email.com" value="{{ auth()->user()?->email ?? old('email') }}" required>
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Telefone --}}
        <div>
            <label for="telephone" class="block text-gray-600 text-xs md:text-sm mb-1">O seu telefone</label>
            <input type="tel" id="telephone" name="telephone" class="form-input @error('telephone') border-red-300 @enderror"
                   placeholder="+351..." value="{{ old('telephone') }}" required>
            @error('telephone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mensagem --}}
        <div>
            <label for="message" class="block text-gray-600 text-xs md:text-sm mb-1">Mensagem</label>
            <textarea id="message" name="message" class="form-input @error('message') border-red-300 @enderror"
                      rows="4" placeholder="Estou interessado neste imóvel..." required>{{ old('message') }}</textarea>
            @error('message')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botão enviar --}}
        <button type="submit" id="submitBtn" class="btn-secondary w-full py-3 flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            <span id="submitBtnText">Enviar Contacto</span>
        </button>
    </form>

    {{-- Mostrar telefone --}}
    <div class="text-center">
        <a href="#" id="showPhoneBtn" class="text-sm text-blue-600 font-medium hover:underline flex items-center justify-center group" data-phone="{{ $ad->creator->telephone ?? '+351 XXX XXX XXX' }}">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span id="phoneText">Ver número de telefone</span>
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const successMessage = document.getElementById('successMessage');
        const phoneBtn = document.getElementById('showPhoneBtn');
        const phoneText = document.getElementById('phoneText');

        if (form) {
            form.addEventListener('submit', function(e) {
                // Prevent default submission to handle with ajax
                e.preventDefault();

                // Change button text and add loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75');
                submitBtnText.textContent = 'A enviar...';

                // Submit the form with fetch
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                    .then(response => {
                        // Parse the JSON response regardless of status code
                        return response.json().then(data => {
                            if (response.ok) {
                                return data;
                            } else {
                                // If response is not ok, throw the data which contains validation errors
                                throw data;
                            }
                        });
                    })
                    .then(data => {
                        // Success handling
                        successMessage.classList.remove('hidden');
                        form.reset();

                        // Keep email if user is logged in
                        const userEmail = "{{ auth()->user()?->email ?? '' }}";
                        if (userEmail) {
                            document.getElementById('email').value = userEmail;
                        }

                        // Scroll to success message
                        successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    })
                    .catch(errors => {
                        console.error('Error:', errors);
                        // Clear previous error messages
                        document.querySelectorAll('.text-red-500').forEach(el => el.remove());

                        // Display validation errors if they exist
                        if (errors.errors) {
                            Object.keys(errors.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    input.classList.add('border-red-300');
                                    const errorMsg = document.createElement('p');
                                    errorMsg.className = 'text-red-500 text-xs mt-1';
                                    errorMsg.textContent = errors.errors[field][0];
                                    input.parentNode.appendChild(errorMsg);
                                }
                            });
                        }
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75');
                        submitBtnText.textContent = 'Enviar Contacto';
                    });
            });
        }

        if (phoneBtn) {
            phoneBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Get the advertiser ID from the ad
                const advertiserId = {{ $ad->creator->id ?? 0 }};

                if (phoneText.textContent === 'Ver número de telefone') {
                    // Show loading state
                    phoneText.textContent = 'A carregar...';
                    phoneText.classList.add('animate-pulse');

                    // Fetch phone number with a simple GET request
                    fetch(`/advertiser/${advertiserId}/phone`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            const phone = data.telephone || 'Número não disponível';

                            // Remove loading state
                            phoneText.classList.remove('animate-pulse');

                            // Apply animation to show the number
                            phoneText.textContent = phone;
                            phoneText.classList.add('animate-fade-in');
                            phoneText.classList.add('text-blue-600', 'font-bold');

                            // Add copy functionality
                            phoneBtn.title = "Clique para copiar";
                        })
                        .catch(error => {
                            console.error('Error fetching phone number:', error);
                            phoneText.textContent = 'Erro ao obter número';
                            phoneText.classList.remove('animate-pulse');
                            phoneText.classList.add('text-red-500');
                        });
                } else {
                    // Copy to clipboard
                    navigator.clipboard.writeText(phoneText.textContent).then(() => {
                        const originalText = phoneText.textContent;

                        phoneText.textContent = "Copiado!";
                        phoneText.classList.add('text-green-500');

                        setTimeout(() => {
                            phoneText.textContent = originalText;
                            phoneText.classList.remove('text-green-500');
                        }, 1500);
                    });
                }
            });
        }
    });
</script>
