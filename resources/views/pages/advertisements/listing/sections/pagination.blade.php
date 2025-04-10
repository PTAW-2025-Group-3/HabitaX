<nav class="inline-flex rounded-md shadow-sm bg-white/80 backdrop-blur p-1.5 ">
    <a href="#" class="pagination chevron">
        <i class="bi bi-chevron-left"></i>
    </a>
    {{--  pagination - classe de estilo no css, page - classe para manipulação no javaScript  --}}
    <a href="" class="page page-selected">1</a>
    <a href="#" class="pagination page">2</a>
    <a href="#" class="pagination page">3</a>
    <a href="#" class="pagination page">4</a>
    <a href="#" class="pagination page">5</a>
    <a href="#" class="pagination chevron">
        <i class="bi bi-chevron-right"></i>
    </a>
</nav>


<script>
    {{--Código para a animação da mudança de página--}}
    const pages = document.querySelectorAll('.page');

    pages.forEach(page => {
        page.addEventListener('click', (e) => {
            e.preventDefault();

            const pageSelected = document.querySelector('.page-selected'); // Select the currently selected page
            if (pageSelected) {
                pageSelected.classList.remove('page-selected');
                pageSelected.classList.add('pagination');
            }

            page.classList.remove('pagination');
            page.classList.add('page-selected');
        });
    });

    // Lógica da mudança de página pelos Chevrons
    const chevrons = document.querySelectorAll('.chevron');
    chevrons.forEach(chevron => {
        chevron.addEventListener('click', (e) => {
            e.preventDefault();

            const pageSelected = document.querySelector('.page-selected'); // Seleciona a página atual
            if (pageSelected) {
                const currentPageIndex = Array.from(pages).indexOf(pageSelected);
                let newPageIndex;

                // Verifica se é o chevron da esquerda ou da direita
                if (chevron.querySelector('.bi-chevron-left')) {
                    newPageIndex = currentPageIndex > 0 ? currentPageIndex - 1 : 0; // Vai para a página anterior
                } else if (chevron.querySelector('.bi-chevron-right')) {
                    newPageIndex = currentPageIndex < pages.length - 1 ? currentPageIndex + 1 : pages.length - 1; // Vai para a próxima página
                }

                // Atualiza as classes das páginas
                pageSelected.classList.remove('page-selected');
                pageSelected.classList.add('pagination');
                pages[newPageIndex].classList.remove('pagination');
                pages[newPageIndex].classList.add('page-selected');
            }
        });
    });
</script>
