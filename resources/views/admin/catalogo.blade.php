@extends('layouts.general')

@section('title', 'Catálogo')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
@endsection

@section('content')
<section class="catalog-section">
    <h1 class="section-title">Nuestro catálogo</h1>
    <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
        <div class="search-bar">
            <input type="search" name="q" id="book-search" class="search-input" placeholder="Buscar libro..."
                aria-label="Campo para buscar libros por título, autor o ISBN" autocomplete="off" value="{{ $searchTerm ?? '' }}">
            <select name="type" class="form-select">
                <option value="all" {{ (isset($searchType) && $searchType == 'all') ? 'selected' : '' }}>Todos</option>
                <option value="title" {{ (isset($searchType) && $searchType == 'title') ? 'selected' : '' }}>Título</option>
                <option value="author" {{ (isset($searchType) && $searchType == 'author') ? 'selected' : '' }}>Autor</option>
                <option value="isbn" {{ (isset($searchType) && $searchType == 'isbn') ? 'selected' : '' }}>ISBN</option>
            </select>
            <button type="submit" class="search-button" aria-label="Clic para buscar">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
    <p class="search-instructions">Pulsa Enter o haz clic en la lupa para buscar</p>
</section>
@endsection
