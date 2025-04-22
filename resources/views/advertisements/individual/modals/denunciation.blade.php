<div id="reportModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-0 transition-all duration-300 hidden">
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
    function openReportModal() {
        const reportModal = document.getElementById('reportModal');
        reportModal.classList.remove('hidden');
        setTimeout(() => {
            reportModal.querySelector('.modal-content').classList.add('scale-100', 'opacity-100');
            reportModal.classList.add('bg-opacity-50');
        }, 50);
    }

    function closeReportModal() {
        const reportModal = document.getElementById('reportModal');
        reportModal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
        reportModal.classList.remove('bg-opacity-50');
        setTimeout(() => {
            reportModal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const reportModal = document.getElementById('reportModal');
        const closeModal = document.getElementById('closeReportModal');
        const cancelReport = document.getElementById('cancelReport');
        const reportForm = document.getElementById('reportForm');

        closeModal.addEventListener('click', closeReportModal);
        cancelReport.addEventListener('click', closeReportModal);

        reportModal.addEventListener('click', function(e) {
            if (e.target === reportModal) {
                closeReportModal();
            }
        });

        reportForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const adId = this.querySelector('input[name="ad_id"]').value;
            const reason = document.getElementById('reportReason').value;
            const description = document.getElementById('reportDescription').value;

            if (!reason) {
                alert('Por favor, selecione um motivo para a denúncia.');
                return;
            }

            console.log('Denúncia enviada:', { adId, reason, description });

            const submitBtn = document.getElementById('submitReport');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-check-circle-fill mr-2"></i> Enviado!';
            submitBtn.classList.remove('btn-primary');
            submitBtn.classList.add('btn-success');

            setTimeout(() => {
                closeReportModal();
                setTimeout(() => {
                    reportForm.reset();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-send-fill mr-2"></i> Enviar denúncia';
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-primary');
                }, 300);
            }, 1500);
        });
    });
</script>
