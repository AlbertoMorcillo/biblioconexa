document.addEventListener('DOMContentLoaded', function () {
    // Crear el overlay de carga y añadirlo al body
    const loaderOverlay = document.createElement('div');
    loaderOverlay.className = 'loading-overlay';
    loaderOverlay.innerHTML = '<div class="loader"></div>';
    document.body.appendChild(loaderOverlay);

    // Ocultar el loader al cargar la página
    window.addEventListener('load', function () {
        loaderOverlay.style.display = 'none';
        document.body.classList.remove('loading');
    });

    // Mostrar el loader al navegar a otra página
    window.addEventListener('beforeunload', function () {
        loaderOverlay.style.display = 'flex';
        document.body.classList.add('loading');
    });
});
