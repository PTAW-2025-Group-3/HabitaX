function initModals() {
    // Modal elements
    const suspendUserModal = document.getElementById('suspendUserModal');
    const suspendUserModalOverlay = document.getElementById('suspendUserModalOverlay');
    const closeSuspendModal = document.getElementById('closeSuspendModal');
    const cancelSuspendBtn = document.getElementById('cancelSuspendBtn');
    const confirmSuspendBtn = document.getElementById('confirmSuspendBtn');
    const suspendUserName = document.getElementById('suspendUserName');
    const suspendModalTitle = document.getElementById('suspendModalTitle');
    const suspendActionText = document.getElementById('suspendActionText');
    const suspendDescription = document.getElementById('suspendDescription');
    const reactivateDescription = document.getElementById('reactivateDescription');

    const permissionsModal = document.getElementById('permissionsModal');
    const permissionsModalOverlay = document.getElementById('permissionsModalOverlay');
    const closePermissionsModalBtn = document.getElementById('closePermissionsModal');
    const cancelPermissionsBtn = document.getElementById('cancelPermissionsBtn');
    const savePermissionsBtn = document.getElementById('savePermissionsBtn');
    const permissionsUserName = document.getElementById('permissionsUserName');

    // State variables
    let currentUserId = null;
    let isSuspended = false;
    let permissionsUserId = null;
    let currentUserRole = null;

    function setupSuspensionButtons() {
        const suspendBtns = document.querySelectorAll('.suspend-user-btn');

        suspendBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                currentUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                isSuspended = this.dataset.isSuspended === 'true';

                suspendUserName.textContent = userName;

                if (isSuspended) {
                    // Configuration for reactivation
                    suspendModalTitle.textContent = 'Reativar Utilizador';
                    suspendActionText.textContent = 'reativar';
                    suspendDescription.classList.add('hidden');
                    reactivateDescription.classList.remove('hidden');
                    confirmSuspendBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
                    confirmSuspendBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                    if (confirmSuspendBtn.querySelector('#suspendBtnText')) {
                        confirmSuspendBtn.querySelector('#suspendBtnText').textContent = 'Reativar';
                    }
                } else {
                    // Configuration for suspension
                    suspendModalTitle.textContent = 'Suspender Utilizador';
                    suspendActionText.textContent = 'suspender';
                    suspendDescription.classList.remove('hidden');
                    reactivateDescription.classList.add('hidden');
                    confirmSuspendBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    confirmSuspendBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                    if (confirmSuspendBtn.querySelector('#suspendBtnText')) {
                        confirmSuspendBtn.querySelector('#suspendBtnText').textContent = 'Suspender';
                    }
                }

                suspendUserModal.classList.remove('hidden');
            });
        });
    }

    function setupPermissionsButtons() {
        const permissionsBtns = document.querySelectorAll('.permissions-btn');

        permissionsBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                permissionsUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                const userRole = this.dataset.userRole || 'user';

                permissionsUserName.textContent = userName;
                currentUserRole = userRole;

                // Set the correct radio button based on user's role
                const userRoleInputs = document.querySelectorAll('input[name="userRole"]');
                userRoleInputs.forEach(input => {
                    if (input.value === userRole) {
                        input.checked = true;
                    }
                });

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

    // Add modal event listeners
    if (suspendUserModalOverlay) {
        suspendUserModalOverlay.addEventListener('click', closeSuspensionModal);
    }
    if (closeSuspendModal) {
        closeSuspendModal.addEventListener('click', closeSuspensionModal);
    }
    if (cancelSuspendBtn) {
        cancelSuspendBtn.addEventListener('click', closeSuspensionModal);
    }

    if (permissionsModalOverlay) {
        permissionsModalOverlay.addEventListener('click', closePermissionsModal);
    }
    if (closePermissionsModalBtn) {
        closePermissionsModalBtn.addEventListener('click', closePermissionsModal);
    }
    if (cancelPermissionsBtn) {
        cancelPermissionsBtn.addEventListener('click', closePermissionsModal);
    }

    // Handle confirm suspension button
    if (confirmSuspendBtn) {
        confirmSuspendBtn.addEventListener('click', function() {
            if (!currentUserId) return;

            // Show loading state
            const suspendBtnText = confirmSuspendBtn.querySelector('#suspendBtnText');
            const originalBtnText = suspendBtnText ? suspendBtnText.textContent : confirmSuspendBtn.textContent;

            if (suspendBtnText) {
                suspendBtnText.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-1"></i>' +
                    (isSuspended ? 'Reativando...' : 'Suspendendo...');
            } else {
                confirmSuspendBtn.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-1"></i>' +
                    (isSuspended ? 'Reativando...' : 'Suspendendo...');
            }

            confirmSuspendBtn.disabled = true;

            // Send AJAX request
            fetch(`/admin/users/${currentUserId}/toggle-suspension`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI
                        const userRow = document.querySelector(`.user-row[data-id="${currentUserId}"]`);
                        if (userRow) {
                            const statusCell = userRow.querySelector('td:nth-child(5)');
                            const suspendBtn = userRow.querySelector('.suspend-user-btn');

                            userRow.dataset.suspended = data.is_suspended ? 'true' : 'false';

                            if (suspendBtn) {
                                suspendBtn.textContent = data.is_suspended ? 'Reativar' : 'Suspender';
                                suspendBtn.dataset.isSuspended = data.is_suspended ? 'true' : 'false';
                            }

                            if (statusCell) {
                                if (data.is_suspended) {
                                    statusCell.innerHTML = '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">Suspenso</span>';
                                } else {
                                    // Default to active
                                    statusCell.innerHTML = '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">Ativo</span>';
                                }
                            }
                        }

                        closeSuspensionModal();
                        showToast(data.message, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Ocorreu um erro ao processar sua solicitação.', 'error');
                })
                .finally(() => {
                    // Reset button state
                    if (suspendBtnText) {
                        suspendBtnText.textContent = originalBtnText;
                    } else {
                        confirmSuspendBtn.textContent = originalBtnText;
                    }
                    confirmSuspendBtn.disabled = false;
                });
        });
    }

    // Handle permissions save
    if (savePermissionsBtn) {
        savePermissionsBtn.addEventListener('click', function() {
            if (!permissionsUserId) return;

            const selectedRole = document.querySelector('input[name="userRole"]:checked');
            const roleValue = selectedRole ? selectedRole.value : 'user';

            // If no change in role, just close the modal
            if (roleValue === currentUserRole) {
                closePermissionsModal();
                return;
            }

            // Show loading state
            const originalBtnText = savePermissionsBtn.textContent;
            savePermissionsBtn.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-1"></i>A guardar...';
            savePermissionsBtn.disabled = true;

            // Send AJAX request to update role
            fetch(`/admin/users/${permissionsUserId}/update-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `role=${roleValue}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI - find the permissions button for this user and update its data attribute
                        const permissionsBtn = document.querySelector(`.permissions-btn[data-user-id="${permissionsUserId}"]`);
                        if (permissionsBtn) {
                            permissionsBtn.dataset.userRole = roleValue;
                        }
                        showToast('Permissões do utilizador atualizadas com sucesso', 'success');
                        closePermissionsModal();
                    } else {
                        showToast(data.message || 'Erro ao atualizar permissões', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Ocorreu um erro ao atualizar as permissões.', 'error');
                })
                .finally(() => {
                    // Reset button state
                    savePermissionsBtn.textContent = originalBtnText;
                    savePermissionsBtn.disabled = false;
                });
        });
    }

    // Helper function to show toast notifications
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 p-4 rounded shadow-lg z-50 transition-all duration-300 transform translate-y-0';

        // Style based on type
        if (type === 'success') {
            toast.classList.add('bg-green-100', 'border-l-4', 'border-green-500', 'text-green-700');
        } else if (type === 'error') {
            toast.classList.add('bg-red-100', 'border-l-4', 'border-red-500', 'text-red-700');
        } else {
            toast.classList.add('bg-blue-100', 'border-l-4', 'border-blue-500', 'text-blue-700');
        }

        const icon = type === 'success' ? 'bi-check-circle' :
            type === 'error' ? 'bi-exclamation-triangle' : 'bi-info-circle';

        toast.innerHTML = `
            <div class="flex items-center">
                <i class="bi ${icon} mr-2"></i>
                <p>${message}</p>
            </div>
        `;

        document.body.appendChild(toast);

        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-y-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Export for use in other modules
    window.setupSuspensionButtons = setupSuspensionButtons;
    window.setupPermissionsButtons = setupPermissionsButtons;

    // Initialize buttons
    setupSuspensionButtons();
    setupPermissionsButtons();
}

// Initialize modals when DOM is ready
document.addEventListener('DOMContentLoaded', initModals);
