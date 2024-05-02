document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('book-search');

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query) {
                fetch(`/api/search-books?query=${encodeURIComponent(query)}`, {
                    method: 'GET' // Aunque GET es el método predeterminado, lo pongo aquí para claridad.
                })
                .then(response => response.json())
                .then(data => {
                    displayResults(data); // Función para manejar la visualización de los datos
                })
                .catch(error => console.error('Error fetching data:', error));
            }
        }
    });

    function displayResults(data) {
        const resultsContainer = document.getElementById('search-results-container');
        resultsContainer.innerHTML = ''; // Limpiar resultados anteriores

        data.items.forEach(book => {
            const div = document.createElement('div');
            div.className = 'book-result';
            div.innerHTML = `<h4>${book.volumeInfo.title}</h4><p>${book.volumeInfo.authors.join(', ')}</p>`;
            resultsContainer.appendChild(div);
        });
    }
});
