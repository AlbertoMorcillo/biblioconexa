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
});
