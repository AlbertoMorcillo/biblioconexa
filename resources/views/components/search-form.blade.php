<section class="catalog-section">
    <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
        <div class="search-bar">
            <input type="search" name="q" id="book-search" class="search-input" placeholder="Buscar libro..."
                aria-label="Campo para buscar libros por título, autor o ISBN" autocomplete="off"
                value="{{ $searchTerm ?? '' }}">
            <select name="type" class="form-select">
                <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>Todos</option>
                <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>Título</option>
                <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>Autor</option>
                <option value="isbn" {{ $searchType == 'isbn' ? 'selected' : '' }}>ISBN</option>
            </select>
            <button type="submit" class="search-button" aria-label="Clic para buscar">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
    <p class="search-instructions mb-3">Pulsa Enter o haz clic en la lupa para buscar</p>
</section>
