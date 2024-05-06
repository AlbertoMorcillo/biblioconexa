@extends('layouts.general-logged')

@section('title', 'Resultados de la búsqueda')

@section('content')
    <div class="container mt-4">
        <h1 class="seccion-titulo">Resultados de la búsqueda</h1>
        <section class="catalog-section">
            <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
                <div class="search-bar">
                    <input type="search" name="q" id="book-search" class="form-control search-input"
                        placeholder="Buscar libro..." aria-label="Campo para buscar libros por título, autor o ISBN"
                        autocomplete="off" value="{{ $searchTerm ?? '' }}">
                    <select name="type" class="form-select">
                        <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>Todos</option>
                        <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>Título</option>
                        <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>Autor</option>
                        <option value="isbn" {{ $searchType == 'isbn' ? 'selected' : '' }}>ISBN</option>
                    </select>
                    <button type="submit" class="btn btn-primary search-button" aria-label="Clic para buscar">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
            <p class="search-instructions mb-3">Pulsa Enter o haz clic en la lupa para buscar</p>
        </section>

        @if (!empty($books))
            <div class="row mt-4">
                @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <!-- Enlace que dirige a la página de detalles del libro con su 'key' específica -->
                        <a href="{{ route('libros.show', ['libro' => substr($book['key'], strrpos($book['key'], '/') + 1)]) }}" class="link-libros">
                            <img class="card-img-top" src="{{ $covers[$book['key']] }}"
                                alt="Portada del libro: {{ $book['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title titulo-libro">{{ $book['title'] }}</h5>
                                <p class="card-text nombre-autor">
                                    {{ implode(', ', $book['author_name'] ?? ['Autor Desconocido']) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($books->lastPage() > 1)
                <nav aria-label="Página de navegación">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $books->url(1) }}">Primera</a>
                        </li>
                        <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($books->getUrlRange(max($books->currentPage() - 2, 1), min($books->currentPage() + 2, $books->lastPage())) as $i => $url)
                            <li class="page-item {{ $books->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $i }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ $books->currentPage() == $books->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item {{ $books->currentPage() == $books->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $books->url($books->lastPage()) }}">Última</a>
                        </li>
                    </ul>
                </nav>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                No se encontraron libros para la búsqueda realizada. Intenta con otros términos.
            </div>
        @endif
    </div>
@endsection