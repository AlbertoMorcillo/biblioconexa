@extends('layouts.general-logged')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="seccion-titulo">Resultados de la búsqueda</h1>
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
        
        @if (!empty($books))
            <div class="row mt-4">
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <a href="https://openlibrary.org{{ $book['key'] }}" class="link-libros"
                                aria-label="Información del libro">
                                @if (array_key_exists($book['isbn'][0] ?? '', $covers))
                                    <img class="card-img-top"
                                        src="data:image/jpeg;base64,{{ $covers[$book['isbn'][0]] }}"
                                        alt="Portada del libro: {{ $book['title'] }}">
                                @else
                                    <div class="card-img-top bg-light d-flex justify-content-center align-items-center"
                                        style="height: 225px;">
                                        <span class="text-secondary">Imagen no disponible</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title titulo-libro">{{ $book['title'] }}</h5>
                                    <p class="card-text nombre-autor">{{ implode(', ', $book['author_name'] ?? ['Autor Desconocido']) }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Paginación -->
        @else
            <div class="alert alert-warning" role="alert">
                No se encontraron libros para la búsqueda realizada. Intenta con otros términos.
            </div>
        @endif
    </div>
@endsection
