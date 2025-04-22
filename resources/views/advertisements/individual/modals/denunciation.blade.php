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
                    <div class="relative">
                        <select id="reportReason" name="reason" class="dropdown-select px-4 py-2.5" required>
                            <option value="" disabled selected>Selecione um motivo</option>
                            <option value="false_info">Informações falsas</option>
                            <option value="scam">Possível fraude</option>
                            <option value="inappropriate">Conteúdo inapropriado</option>
                            <option value="duplicate">Anúncio duplicado</option>
                            <option value="unavailable">Propriedade indisponível</option>
                            <option value="wrong_price">Preço incorreto</option>
                            <option value="other">Outro motivo</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                            <i class="bi bi-chevron-down"></i>
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

                const adId = this.querySelector('input[name="ad_id"]').value;
                const reason = document.getElementById('reportReason').value;
                const description = document.getElementById('reportDescription').value;

                if (!reason) {
                    alert('Please select a reason for the report.');
                    return;
                }

                const submitBtn = document.getElementById('submitReport');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-check-circle-fill mr-2"></i> Sent!';
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-success');

                    console.log('Report submitted:', { adId, reason, description });

                    setTimeout(() => {
                        window.closeReportModal();
                        setTimeout(() => {
                            form.reset();
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bi bi-send-fill mr-2"></i> Submit Report';
                            submitBtn.classList.remove('btn-success');
                            submitBtn.classList.add('btn-primary');
                        }, 300);
                    }, 1500);
                }
            });
        }
    });
</script>
