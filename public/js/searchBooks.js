document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('book-search');
    const resultsContainer = document.getElementById('search-results-container');

    if (!resultsContainer) {
        console.error('No se encontró el contenedor de resultados.');
        return; // Detiene la ejecución si no existe el contenedor
    }

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevenir la recarga de la página o submit del formulario
            const query = searchInput.value.trim();
            if (query && query !== lastQuery) {
                lastQuery = query; // Guardar la última consulta para evitar duplicados
                fetch(`/api/search-books?query=${encodeURIComponent(query)}`, {
                    method: 'GET'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch: ' + response.statusText);
                    }
                    // Verificar si la respuesta es JSON antes de intentar parsearla
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Invalid content type: Expected JSON, received ' + contentType);
                    }
                    return response.json();
                })
                .then(data => {
                    displayResults(data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    resultsContainer.innerHTML = `<p>Error al cargar los datos: ${error.message}</p>`;
                });
            }
        }
    });

    function displayResults(data) {
        resultsContainer.innerHTML = ''; // Limpiar resultados anteriores
        if (data && data.items && data.items.length > 0) {
            data.items.forEach(book => {
                const div = document.createElement('div');
                div.className = 'book-result';
                div.innerHTML = `<h4>${book.volumeInfo.title}</h4><p>${book.volumeInfo.authors.join(', ')}</p>`;
                resultsContainer.appendChild(div);
            });
        } else {
            resultsContainer.innerHTML = '<p>No se encontraron libros.</p>'; // Mensaje si no hay libros
        }
    }
});
