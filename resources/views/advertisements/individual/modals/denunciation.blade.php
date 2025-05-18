<div id="reportModal" hidden class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-0 transition-all duration-300 hidden">
    <div class="modal-content relative w-full max-w-md transform scale-95 opacity-0 transition-all duration-300">
        <!-- Cartão com efeito de vidro -->
        <div class="bg-white bg-opacity-90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in">
            <!-- Cabeçalho do modal -->
            <div class="bg-gradient-to-r from-blue-900 to-indigo-600 p-5 text-white relative">
                <button id="closeReportModal" class="absolute top-4 right-4 text-white hover:text-gray-200 transition">
                    <i class="bi bi-x-lg"></i>
                </button>
                <h3 class="text-xl font-bold flex items-center">
                    <i class="bi bi-flag-fill mr-2"></i>
                    Reportar Anúncio
                </h3>
                <p class="text-blue-100 text-sm mt-1">
                    Ajude-nos a manter a plataforma segura para todos
                </p>
            </div>

            <!-- Conteúdo do modal -->
            <form id="reportForm" class="p-6 space-y-4">
                <input type="hidden" name="ad_id" value="{{ $adId }}">

                <div class="space-y-2">
                    <label for="reportReason" class="block text-sm font-medium text-gray-700">
                        Motivo da denúncia <span class="text-red">*</span>
                    </label>
                    <div class="relative dropdown-wrapper w-full sm:w-auto">
                        <select id="reportReason" name="reason" class="py-2 pl-4 pr-10 w-full h-10 dropdown-select" required>
                            <option value="" disabled selected>Selecione um motivo</option>
                            @foreach(\App\Models\DenunciationReason::where('is_active', true)->get() as $reason)
                                <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="reportDescription" class="block text-sm font-medium text-gray-700">
                        Descrição detalhada
                    </label>
                    <textarea
                        id="reportDescription"
                        name="description"
                        rows="4"
                        class="form-input resize-none"
                        placeholder="Descreva o problema com mais detalhes para nos ajudar a entender melhor a situação..."
                    ></textarea>
                    <p class="text-xs text-gray-500 italic">
                        A sua identidade permanecerá anónima durante este processo.
                    </p>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-3">
                    <button
                        type="button"
                        id="cancelReport"
                        class="px-4 py-2 btn-gray text-sm">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        id="submitReport"
                        class="px-4 py-2 btn-primary text-sm">
                        <i class="bi bi-send-fill mr-2"></i> Enviar denúncia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('reportModal');
        if (modal) {
            modal.removeAttribute('hidden');
        }

        window.openReportModal = function() {
            const modal = document.getElementById('reportModal');
            if (!modal) return console.error('Report modal not found');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('bg-opacity-50');
                const content = modal.querySelector('.modal-content');
                if (content) {
                    content.classList.add('scale-100', 'opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                }
            }, 10);
        };

        window.closeReportModal = function() {
            const modal = document.getElementById('reportModal');
            if (!modal) return;

            const content = modal.querySelector('.modal-content');
            if (content) {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
            }
            modal.classList.remove('bg-opacity-50');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        };

        const closeBtn = document.getElementById('closeReportModal');
        const cancelBtn = document.getElementById('cancelReport');
        const form = document.getElementById('reportForm');

        if (closeBtn) closeBtn.addEventListener('click', window.closeReportModal);
        if (cancelBtn) cancelBtn.addEventListener('click', window.closeReportModal);

        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) window.closeReportModal();
            });
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                @if(!auth()->check())
                alert('Faça login ou registe-se para denunciar um anúncio.');
                window.closeReportModal();
                // Será que faria sentido redirecionar para a página de login? rever isto
                // window.location.href = '{{ route("login") }}';
                return;
                @endif

                const adId = this.querySelector('input[name="ad_id"]').value;
                const reasonId = document.getElementById('reportReason').value;
                const description = document.getElementById('reportDescription').value;

                if (!reasonId) {
                    alert('Por favor, selecione um motivo para a denúncia.');
                    return;
                }

                const submitBtn = document.getElementById('submitReport');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i> A enviar...';

                    // Create the fetch request to the denunciations.store endpoint
                    fetch('{{ route("denunciations.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            advertisement_id: adId,
                            reason_id: reasonId,
                            description: description
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw new Error(data.message || 'Erro na submissão');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            submitBtn.innerHTML = '<i class="bi bi-check-circle-fill mr-2"></i> Enviado!';
                            submitBtn.classList.remove('btn-primary');
                            submitBtn.classList.add('btn-success');

                            setTimeout(() => {
                                window.closeReportModal();
                                setTimeout(() => {
                                    form.reset();
                                    submitBtn.disabled = false;
                                    submitBtn.innerHTML = '<i class="bi bi-send-fill mr-2"></i> Enviar denúncia';
                                    submitBtn.classList.remove('btn-success');
                                    submitBtn.classList.add('btn-primary');
                                }, 300);
                            }, 1500);
                        })
                        // Substituir a parte do .catch no script atual
                        .catch(error => {
                            console.error('Error:', error);
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bi bi-send-fill mr-2"></i> Enviar denúncia';

                            // Criar um alerta bonito em vez do alert() padrão
                            const alertContainer = document.createElement('div');
                            alertContainer.className = 'bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 mb-4 rounded-md';
                            alertContainer.innerHTML = `
                                <div class="flex items-center">
                                    <i class="bi bi-exclamation-circle-fill mr-2 text-rose-500"></i>
                                    <p>${error.message || 'Ocorreu um erro ao enviar a denúncia. Por favor, tente novamente.'}</p>
                                </div>
                            `;
                            // Inserir o alerta no topo do formulário
                            const form = document.getElementById('reportForm');
                            form.prepend(alertContainer);

                            // Auto-remover o alerta após 5 segundos
                            setTimeout(() => {
                                if (alertContainer.parentNode) {
                                    alertContainer.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                                    setTimeout(() => alertContainer.remove(), 300);
                                }
                            }, 5000);

                            // Mover o scroll para o topo para mostrar o erro
                            modal.scrollTo({top: 0, behavior: 'smooth'});
                        });
                }
            });
        }
    });
</script>
