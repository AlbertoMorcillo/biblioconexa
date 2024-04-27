document.addEventListener('DOMContentLoaded', function() {
    const sortOrderSelect = document.getElementById('sort-order');
    sortOrderSelect.addEventListener('change', function() {
        // Puedes usar la URL actual y agregar el parámetro de ordenación, o una ruta específica
        window.location.href = `?sort-order=${this.value}`;
    });
});