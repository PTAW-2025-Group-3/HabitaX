function initModals() {
    // Elementos do modal de estado
    const suspendUserModal = document.getElementById('suspendUserModal');
    const suspendUserModalOverlay = document.getElementById('suspendUserModalOverlay');
    const closeSuspendModal = document.getElementById('closeSuspendModal');
    const cancelSuspendBtn = document.getElementById('cancelSuspendBtn');
    const confirmSuspendBtn = document.getElementById('confirmSuspendBtn');
    const suspendUserName = document.getElementById('suspendUserName');
    const suspendModalTitle = document.getElementById('suspendModalTitle');

    const permissionsModal = document.getElementById('permissionsModal');
    const permissionsModalOverlay = document.getElementById('permissionsModalOverlay');
    const closePermissionsModalBtn = document.getElementById('closePermissionsModal');
    const cancelPermissionsBtn = document.getElementById('cancelPermissionsBtn');
    const savePermissionsBtn = document.getElementById('savePermissionsBtn');
    const permissionsUserName = document.getElementById('permissionsUserName');

    // Estado atual
    let currentUserId = null;
    let permissionsUserId = null;
    let currentUserRole = null;

    function setupSuspensionButtons() {
        const suspendBtns = document.querySelectorAll('.state-user-btn');

        suspendBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                currentUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                const currentState = this.dataset.userState;

                if (!suspendUserName) return;

                suspendUserName.textContent = userName;

                // Ajustar o conteúdo do botão
                const suspendBtnText = confirmSuspendBtn.querySelector('#suspendBtnText');
                const stateSelect = document.getElementById('stateSelect');
                stateSelect.value = currentState;

                suspendModalTitle.textContent = 'Gerenciar Estado do Utilizador';
                if (suspendBtnText) {
                    suspendBtnText.textContent = 'Atualizar Estado';
                } else {
                    confirmSuspendBtn.innerHTML = `<span id="suspendBtnText">Atualizar Estado</span>`;
                }

                // Abrir o modal
                suspendUserModal.classList.remove('hidden');
            });
        });
    }

    if (confirmSuspendBtn) {
        confirmSuspendBtn.addEventListener('click', function () {
            if (!currentUserId) return;

            const stateSelect = document.getElementById('stateSelect');
            const newState = stateSelect.value;

            const suspendBtnText = confirmSuspendBtn.querySelector('#suspendBtnText');
            const originalText = suspendBtnText ? suspendBtnText.textContent : confirmSuspendBtn.textContent;

            if (suspendBtnText) {
                suspendBtnText.innerHTML = `<i class="bi bi-hourglass-split animate-spin mr-1"></i>A atualizar...`;
            } else {
                confirmSuspendBtn.innerHTML = `<i class="bi bi-hourglass-split animate-spin mr-1"></i>A atualizar...`;
            }

            confirmSuspendBtn.disabled = true;

            fetch(`/admin/users/${currentUserId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ state: newState })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const userRow = document.querySelector(`.user-row[data-id="${currentUserId}"]`);
                        if (userRow) {
                            const statusCell = userRow.querySelector('td:nth-child(5)');
                            const suspendBtn = userRow.querySelector('.state-user-btn');

                            userRow.dataset.userState = data.status;
                            if (suspendBtn) {
                                suspendBtn.dataset.userState = data.status;
                            }

                            if (statusCell) {
                                const badgeMap = {
                                    suspended: 'Suspenso|bg-red-100 text-red-600',
                                    active: 'Ativo|bg-green-100 text-green-700',
                                    banned: 'Banido|bg-red-100 text-red-600',
                                    archived: 'Arquivado|bg-gray-100 text-gray-600',
                                };
                                const [label, style] = badgeMap[data.state].split('|');
                                statusCell.innerHTML = `<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold ${style}">${label}</span>`;
                            }
                        }

                        closeSuspensionModal();
                        showToast(data.message, 'success');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast('Erro ao atualizar estado do utilizador.', 'error');
                })
                .finally(() => {
                    if (suspendBtnText) {
                        suspendBtnText.textContent = originalText;
                    } else {
                        confirmSuspendBtn.textContent = originalText;
                    }
                    confirmSuspendBtn.disabled = false;
                });
        });
    }

    function setupPermissionsButtons() {
        const permissionsBtns = document.querySelectorAll('.permissions-btn');

        permissionsBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                permissionsUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                const userRole = this.dataset.userRole || 'user';

                permissionsUserName.textContent = userName;
                currentUserRole = userRole;

                const inputs = document.querySelectorAll('input[name="userRole"]');
                inputs.forEach(input => input.checked = input.value === userRole);

                permissionsModal.classList.remove('hidden');
            });
        });
    }

    function closeSuspensionModal() {
        suspendUserModal.classList.add('hidden');
        currentUserId = null;
    }

    function closePermissionsModal() {
        permissionsModal.classList.add('hidden');
        permissionsUserId = null;
        currentUserRole = null;
    }

    // Eventos de fecho
    suspendUserModalOverlay?.addEventListener('click', closeSuspensionModal);
    closeSuspendModal?.addEventListener('click', closeSuspensionModal);
    cancelSuspendBtn?.addEventListener('click', closeSuspensionModal);

    permissionsModalOverlay?.addEventListener('click', closePermissionsModal);
    closePermissionsModalBtn?.addEventListener('click', closePermissionsModal);
    cancelPermissionsBtn?.addEventListener('click', closePermissionsModal);

    // Guardar permissões
    if (savePermissionsBtn) {
        savePermissionsBtn.addEventListener('click', function () {
            if (!permissionsUserId) return;

            const selected = document.querySelector('input[name="userRole"]:checked');
            const newRole = selected?.value || 'user';

            if (newRole === currentUserRole) {
                closePermissionsModal();
                return;
            }

            const originalText = savePermissionsBtn.textContent;
            savePermissionsBtn.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-1"></i>A guardar...';
            savePermissionsBtn.disabled = true;

            fetch(`/admin/users/${permissionsUserId}/update-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `role=${newRole}`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const btn = document.querySelector(`.permissions-btn[data-user-id="${permissionsUserId}"]`);
                        if (btn) btn.dataset.userRole = newRole;
                        showToast('Permissões atualizadas com sucesso.', 'success');
                        closePermissionsModal();
                    } else {
                        showToast(data.message || 'Erro ao atualizar permissões.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast('Erro ao atualizar permissões.', 'error');
                })
                .finally(() => {
                    savePermissionsBtn.textContent = originalText;
                    savePermissionsBtn.disabled = false;
                });
        });
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 p-4 rounded shadow-lg z-50 transition-all duration-300 transform translate-y-0';

        const typeClasses = {
            success: 'bg-green-100 border-l-4 border-green-500 text-green-700',
            error: 'bg-red-100 border-l-4 border-red-500 text-red-700',
            info: 'bg-blue-100 border-l-4 border-blue-500 text-blue-700',
        };

        const icons = {
            success: 'bi-check-circle',
            error: 'bi-exclamation-triangle',
            info: 'bi-info-circle',
        };

        toast.classList.add(...typeClasses[type || 'info'].split(' '));
        toast.innerHTML = `<div class="flex items-center"><i class="bi ${icons[type]} mr-2"></i><p>${message}</p></div>`;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('translate-y-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Exportações globais
    window.setupSuspensionButtons = setupSuspensionButtons;
    window.setupPermissionsButtons = setupPermissionsButtons;

    // Inicialização
    setupSuspensionButtons();
    setupPermissionsButtons();
}

document.addEventListener('DOMContentLoaded', initModals);
