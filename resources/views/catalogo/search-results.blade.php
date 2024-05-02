@extends('layouts.general-logged')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')

@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo">Resultados de Búsqueda</h1>
    <div class="row">
        @forelse($books as $book)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] ?? 'default-image.jpg' }}" alt="Portada del libro">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book['volumeInfo']['title'] }}</h5>
                        <p class="card-text">{{ $book['volumeInfo']['authors'][0] ?? 'Autor Desconocido' }}</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No se encontraron libros.</p>
        @endforelse
    </div>
</div>
@endsection