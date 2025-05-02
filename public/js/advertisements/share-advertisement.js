document.addEventListener('DOMContentLoaded', function() {
    // Elementos do modal
    const modal = document.getElementById('shareModal');
    const copyLinkBtn = document.getElementById('copyLinkBtn');
    const shareLinkInput = document.getElementById('shareLink');
    const closeBtn = document.getElementById('closeShareModal');
    const cancelBtn = document.getElementById('cancelShare');
    const shareWhatsApp = document.getElementById('shareWhatsApp');
    const shareFacebook = document.getElementById('shareFacebook');
    const shareTwitter = document.getElementById('shareTwitter');
    const emailInput = document.getElementById('emailInput');
    const emailTags = document.getElementById('emailTags');
    const submitShareBtn = document.getElementById('submitShare');
    const shareEmailForm = document.getElementById('shareEmailForm');
    const recipientEmailsInput = document.getElementById('recipientEmailsInput');

    // Inicialização
    if (modal) {
        modal.removeAttribute('hidden');
    }

    // Lista de emails para compartilhar
    const emailList = [];

    // Funções para controlar o modal
    window.openShareModal = function() {
        if (!modal) return console.error('Share modal not found');

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

    window.closeShareModal = function() {
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

    // Eventos para fechamento do modal
    if (closeBtn) closeBtn.addEventListener('click', window.closeShareModal);
    if (cancelBtn) cancelBtn.addEventListener('click', window.closeShareModal);

    // Fechamento ao clicar fora do modal
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) window.closeShareModal();
        });
    }

    // Função para copiar link para a área de transferência
    if (copyLinkBtn && shareLinkInput) {
        copyLinkBtn.addEventListener('click', function() {
            shareLinkInput.select();
            try {
                // Método moderno de cópia para área de transferência
                navigator.clipboard.writeText(shareLinkInput.value).then(() => {
                    showCopySuccess();
                }).catch(() => {
                    // Fallback para método mais antigo
                    document.execCommand('copy');
                    showCopySuccess();
                });
            } catch (err) {
                document.execCommand('copy');
                showCopySuccess();
            }

            function showCopySuccess() {
                // Feedback visual
                const originalIcon = copyLinkBtn.innerHTML;
                copyLinkBtn.innerHTML = `<i class="bi bi-check"></i>`;
                copyLinkBtn.classList.add('bg-green-100', 'text-green-600');

                setTimeout(() => {
                    copyLinkBtn.innerHTML = originalIcon;
                    copyLinkBtn.classList.remove('bg-green-100', 'text-green-600');
                }, 1500);

                // Animação no campo
                shareLinkInput.classList.add('ring-2', 'ring-green-300');
                setTimeout(() => {
                    shareLinkInput.classList.remove('ring-2', 'ring-green-300');
                }, 1500);
            }
        });
    }

    // Compartilhar via redes sociais
    if (shareWhatsApp && shareLinkInput) {
        shareWhatsApp.addEventListener('click', function() {
            const shareUrl = encodeURIComponent(shareLinkInput.value);
            window.open(`https://wa.me/?text=${shareUrl}`, '_blank');
        });
    }

    if (shareFacebook && shareLinkInput) {
        shareFacebook.addEventListener('click', function() {
            const shareUrl = encodeURIComponent(shareLinkInput.value);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`, '_blank');
        });
    }

    if (shareTwitter && shareLinkInput) {
        shareTwitter.addEventListener('click', function() {
            const shareUrl = encodeURIComponent(shareLinkInput.value);
            window.open(`https://twitter.com/intent/tweet?url=${shareUrl}`, '_blank');
        });
    }

    // Validação de email
    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email.toLowerCase());
    }

    // Adicionar tag de email
    function addEmailTag(email) {
        if (!email || !isValidEmail(email) || emailList.includes(email)) return;

        emailList.push(email);

        const tag = document.createElement('div');
        tag.className = 'email-tag';
        tag.innerHTML = `
            ${email}
            <span class="email-tag-remove" data-email="${email}">
                <i class="bi bi-x"></i>
            </span>
        `;

        emailTags.appendChild(tag);
        updateRecipientEmailsInput();

        // Adicionar evento para remover tag
        tag.querySelector('.email-tag-remove').addEventListener('click', function() {
            const emailToRemove = this.getAttribute('data-email');
            const index = emailList.indexOf(emailToRemove);
            if (index > -1) {
                emailList.splice(index, 1);
                updateRecipientEmailsInput();
            }
            tag.classList.add('animate-fade-out');
            setTimeout(() => tag.remove(), 150);
        });

        // Animar entrada
        tag.classList.add('animate-fade-in');
    }

    // Atualizar o campo oculto com todos os emails
    function updateRecipientEmailsInput() {
        if (recipientEmailsInput) {
            recipientEmailsInput.value = emailList.join(',');
        }
    }

    // Gerir as tags de email
    if (emailInput) {
        // Adicionar email ao pressionar Enter ou vírgula
        emailInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                const email = this.value.trim();
                if (email) {
                    if (!isValidEmail(email)) {
                        this.classList.add('border-red-300', 'ring-1', 'ring-red-300');
                        setTimeout(() => {
                            this.classList.remove('border-red-300', 'ring-1', 'ring-red-300');
                        }, 1000);
                        return;
                    }
                    addEmailTag(email);
                    this.value = '';
                }
            }
        });

        // Verificar email ao sair do campo
        emailInput.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && isValidEmail(email)) {
                addEmailTag(email);
                this.value = '';
            }
        });

        // Comportamento do placeholder
        emailInput.addEventListener('focus', function() {
            if (emailList.length > 0) {
                this.setAttribute('placeholder', '');
            }
        });

        emailInput.addEventListener('blur', function() {
            if (this.value === '') {
                this.setAttribute('placeholder', 'Digite um email e pressione Enter');
            }
        });
    }

    // Envio do formulário de email
    if (shareEmailForm) {
        shareEmailForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (emailList.length === 0) {
                alert('Adicione pelo menos um endereço de email para enviar.');
                return;
            }

            const inputEmail = document.getElementById('inputEmail');
            if (!inputEmail.value.trim()) {
                alert('Por favor, preencha o seu endereço de email.');
                return;
            }

            // Atualizar a lista de emails no campo oculto
            updateRecipientEmailsInput();

            // Desabilitar o botão e mostrar indicador de carregamento
            if (submitShareBtn) {
                submitShareBtn.disabled = true;
                submitShareBtn.innerHTML = `
                    <i class="bi bi-hourglass-split mr-2"></i>
                    Enviando...
                `;
            }

            // Enviar o formulário via AJAX com FormData
            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro no envio');
                    }
                    return response.json();
                })
                .then(data => {
                    // Feedback de sucesso
                    if (submitShareBtn) {
                        submitShareBtn.innerHTML = `
                        <i class="bi bi-check-circle-fill mr-2"></i>
                        Enviado!
                    `;
                        submitShareBtn.classList.remove('btn-primary');
                        submitShareBtn.classList.add('btn-success');
                    }

                    // Limpar campos
                    emailList.length = 0;
                    emailTags.innerHTML = '';
                    shareEmailForm.reset();
                    updateRecipientEmailsInput();

                    // Restaurar botão após alguns segundos
                    setTimeout(() => {
                        if (submitShareBtn) {
                            submitShareBtn.disabled = false;
                            submitShareBtn.innerHTML = `
                            <i class="bi bi-send-fill mr-1"></i>
                            Enviar
                        `;
                            submitShareBtn.classList.remove('btn-success');
                            submitShareBtn.classList.add('btn-primary');
                        }

                        // Fechar modal
                        window.closeShareModal();
                    }, 2000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocorreu um erro ao enviar o email. Por favor, tente novamente.');

                    if (submitShareBtn) {
                        submitShareBtn.disabled = false;
                        submitShareBtn.innerHTML = `
                        <i class="bi bi-send-fill mr-1"></i>
                        Enviar
                    `;
                    }
                });
        });
    }
});
