document.addEventListener("DOMContentLoaded", function() {
    $('.nav-tabs a').click(function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado de los enlaces.
        
        let tabId = $(this).attr('href');
        
        $('.nav-link').removeClass('active'); // Remueve la clase 'active' de todas las pestañas.
        $(this).addClass('active'); // Añade la clase 'active' a la pestaña seleccionada.

        $('.tab-pane').removeClass('active show'); // Oculta todos los paneles.
        $(tabId).addClass('active show'); // Muestra el panel correspondiente a la pestaña seleccionada.
    });

    // Activar la pestaña basada en el hash en la URL al cargar la página
    if(window.location.hash) {
        $('.nav-tabs a[href="' + window.location.hash + '"]').trigger('click');
    }

    // Funcionalidad para ordenar columnas
    const getUrlParams = (url) => {
        let params = {};
        if (url) {
            (new URL(url)).searchParams.forEach((value, key) => { params[key] = value });
        }
        return params;
    }

    const updateSortIcons = () => {
        const ths = document.querySelectorAll('th.sortable');
        ths.forEach(th => {
            th.classList.remove('asc', 'desc');
            if (th.dataset.url) {
                const urlParams = getUrlParams(th.dataset.url);
                const sort = urlParams.sortBy;
                const order = urlParams.sortOrder;
                if (sort && order) {
                    const sortField = th.dataset.sort;
                    if (sortField === sort) {
                        th.classList.add(order === 'asc' ? 'asc' : 'desc');
                    }
                }
            }
        });
    }

    const ths = document.querySelectorAll('th.sortable');
    ths.forEach(th => {
        th.addEventListener('click', function() {
            if (th.dataset.url) {
                const urlParams = getUrlParams(th.dataset.url);
                const currentSort = urlParams.sortBy;
                const currentOrder = urlParams.sortOrder;
                const newOrder = currentSort === th.dataset.sort && currentOrder === 'asc' ? 'desc' : 'asc';
                const newUrl = `${window.location.pathname}?sortBy=${th.dataset.sort}&sortOrder=${newOrder}`;
                window.location.href = newUrl;
            }
        });
    });

    updateSortIcons();
});
