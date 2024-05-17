document.addEventListener('DOMContentLoaded', function () {
    // Crear el overlay de carga y añadirlo al body
    const loaderOverlay = document.createElement('div');
    loaderOverlay.className = 'loading-overlay';
    loaderOverlay.innerHTML = '<div class="loader"></div>';
    document.body.appendChild(loaderOverlay);

    // Función para ocultar el loader
    function hideLoader() {
        loaderOverlay.style.display = 'none';
        document.body.classList.remove('loading');
    }

    // Función para mostrar el loader
    function showLoader() {
        loaderOverlay.style.display = 'flex';
        document.body.classList.add('loading');
    }

    // Ocultar el loader al cargar la página
    window.addEventListener('load', hideLoader);

    // Mostrar el loader al navegar a otra página
    window.addEventListener('beforeunload', showLoader);

    // Ocultar el loader cuando la página se muestra de nuevo (por ejemplo, al usar el botón de atrás)
    window.addEventListener('pageshow', function (event) {
        hideLoader();
    });

    // También asegurarse de ocultar el loader si el usuario navega con el historial
    window.addEventListener('popstate', hideLoader);
    window.addEventListener('hashchange', hideLoader);
});
