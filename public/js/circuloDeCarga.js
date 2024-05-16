document.addEventListener('DOMContentLoaded', function () {
    // Ocultar el loader al cargar la página
    window.addEventListener('load', function () {
        document.getElementById('loader').style.display = 'none';
    });

    // Mostrar el loader al navegar a otra página
    window.addEventListener('beforeunload', function () {
        document.getElementById('loader').style.display = 'block';
    });
});
