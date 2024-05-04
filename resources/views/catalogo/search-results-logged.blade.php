@extends('layouts.general-logged')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo">Resultados de la búsqueda</h1>
    <section class="catalog-section">
        <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
            <div class="search-bar">
                <input type="search" name="q" id="book-search" class="search-input" placeholder="Buscar libro..."
                    aria-label="Campo para buscar libros por título, autor o ISBN" autocomplete="off">
                <button type="submit" class="search-button" aria-label="Clic para buscar">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <p class="search-instructions mb-3">Pulsa Enter o haz clic en la lupa para buscar</p>
    </section>
    @if(isset($books['items']) && count($books['items']) > 0)
        <div class="row mt-4">
            @foreach($books['items'] as $book)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <a href="{{ $book['volumeInfo']['infoLink'] ?? '#' }}" class="link-libros" aria-label="Información del libro">
                            @if(isset($book['volumeInfo']['imageLinks']['thumbnail']))
                                <img class="card-img-top" src="{{ $book['volumeInfo']['imageLinks']['extraLarge'] ?? $book['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Portada del libro: {{ $book['volumeInfo']['title'] }}">
                            @else
                                <div class="card-img-top bg-light d-flex justify-content-center align-items-center" style="height: 225px;">
                                    <span class="text-secondary">Imagen no disponible</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title titulo-libro">{{ $book['volumeInfo']['title'] }}</h5>
                                @if(isset($book['volumeInfo']['authors']))
                                    <p class="card-text nombre-autor">{{ implode(', ', $book['volumeInfo']['authors']) }}</p>
                                @else
                                    <p class="card-text nombre-autor">Autor Desconocido</p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            No se encontraron libros para la búsqueda realizada. Intenta con otros términos.
        </div>
    @endif
</div>
@endsection