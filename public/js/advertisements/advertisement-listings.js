/**
 * Inicia os slideshows dos anúncios
 * @param {Array} adIds - Array com os IDs dos anúncios
 */
function initAdvertisementSlideshows(adIds) {
    // Destruir todas as instâncias anteriores do Swiper
    destroyAllSwipers();

    adIds.forEach(id => {
        initSingleSlideshow('.swiper-ad-' + id); // esta é para a grid view
        initSingleSlideshow('.swiper-ad-list-' + id); // esta é para a list view
    });
}

/**
 * Destrói todas as instâncias do Swiper para reinicialização
 */
function destroyAllSwipers() {
    document.querySelectorAll('.swiper').forEach(swiperElement => {
        const swiperInstance = swiperElement.swiper;
        if (swiperInstance) {
            swiperInstance.destroy(true, true);
        }
    });
}

/**
 * Inicializa um único slideshow
 * @param {string} selector - Seletor do elemento do slideshow
 */
function initSingleSlideshow(selector) {
    const swiperElement = document.querySelector(selector);
    if (!swiperElement) return;

    const swiper = new Swiper(selector, {
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 300,
        pagination: {
            el: `${selector} .swiper-pagination`,
            clickable: true,
        },
        navigation: {
            nextEl: `${selector} .swiper-button-next`,
            prevEl: `${selector} .swiper-button-prev`,
        },
        on: {
            init: function () {
                // isto é para evitar que o clique nos botões de navegação propague para o swiper
                const buttons = swiperElement.querySelectorAll('.swiper-button-next, .swiper-button-prev');
                buttons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                    });
                });
            }
        }
    });

    return swiper;
}

/**
 * Previne propagação de eventos aos elementos pais
 */
function preventClickPropagation() {
    document.querySelectorAll('.swiper-button-next, .swiper-button-prev, .swiper-pagination').forEach(element => {
        element.addEventListener('click', e => {
            e.stopPropagation();
        });
    });
}

/**
 * Inicializa o módulo de listagem de anúncios
 */
function initAdvertisementListings() {
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof adIds !== 'undefined' && Array.isArray(adIds)) {
            initAdvertisementSlideshows(adIds);
            preventClickPropagation();
            observeViewChanges();
        }
    });
}

/**
 * Observa mudanças na visualização para reinicializar os slideshows
 */
function observeViewChanges() {
    if (typeof Alpine !== 'undefined') {
        document.addEventListener('alpine:initialized', () => {
            const listObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        if (typeof adIds !== 'undefined' && Array.isArray(adIds)) {
                            setTimeout(() => {
                                initAdvertisementSlideshows(adIds);
                                preventClickPropagation();
                            }, 50); // delayzinho para garantir que o DOM esteja pronto
                        }
                    }
                });
            });

            const listContainer = document.querySelector('.property-listings-container');
            if (listContainer) {
                listObserver.observe(listContainer, { childList: true, subtree: true });
            }
        });
    }

    // Isto é para garantir que o slideshow seja reinicializado quando o utilizador clica no botão de toggle
    document.addEventListener('click', (e) => {
        if (e.target.closest('[x-on\\:click*="updateView"]') ||
            e.target.closest('[\\@click*="updateView"]')) {
            setTimeout(() => {
                if (typeof adIds !== 'undefined' && Array.isArray(adIds)) {
                    initAdvertisementSlideshows(adIds);
                    preventClickPropagation();
                }
            }, 100);
        }
    });
}

window.initAdvertisementListings = initAdvertisementListings;
initAdvertisementListings();
