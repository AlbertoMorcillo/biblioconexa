@extends('layouts.general')

@section('title', $libro->titulo)

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')
    <!-- JavaScript adicional si es necesario -->
    <script src="{{ asset('js/sortNoticia.js') }}"></script>
@endsection

@section('content')
    <div class="search-bar">
        <input type="search" id="book-search" class="search-input" placeholder="Buscar libro..."
            aria-label="Campo para buscar libros por título, autor o ISBN">
        <button type="submit" class="search-button" aria-label="Clic para buscar">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <!-- Aquí va la imagen del libro -->
                <img src="{{ asset('storage/' . $libro->imagen) }}" class="img-fluid" alt="Imagen del libro">
            </div>
            <div class="col-md-7">
                <h1 class="seccion-titulo">{{ $libro->titulo }}</h1>
                <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                <p><strong>Puntuación:</strong> {{ $libro->puntuacion }}</p>
                <div class="mt-3">
                    <h2>Sinopsis:</h2>
                    <p>{{ $libro->sinopsis }}</p>
                </div>
                <h2>Opiniones de los usuarios</h2>
                @foreach ($libro->comentarios as $comentario)
                    <div class="user-opinion">
                        <p><strong>Nombre:</strong> {{ $comentario->usuario->nombre }}</p>
                        <p class="puntuacion"><strong>Puntuación:</strong> {{ $comentario->puntuacion }}</p>
                        <p><strong>Fecha de la opinión:</strong> {{ $comentario->fechaCreacion->format('dd/mm/YYYY') }}</p>
                        <p>{{ $comentario->texto }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
