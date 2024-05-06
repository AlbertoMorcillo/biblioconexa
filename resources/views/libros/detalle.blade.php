@extends('layouts.general-logged')

@section('title', $book['title'])

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Columna de la imagen del libro -->
        <div class="col-md-4">
            <img src="{{ $book['cover_url'] }}" class="img-fluid" alt="Portada del libro: {{ $book['title'] }}">
        </div>
        <!-- Columna de los detalles del libro -->
        <div class="col-md-8">
            <h1>{{ $book['title'] }}</h1>
            <p><strong>Autor/a:</strong> {{ implode(', ', $book['authors']) }}</p>
            <p><strong>Puntuación:</strong> {{ $book['rating'] ?? 'No disponible' }}</p>
            <p><strong>Sinopsis:</strong> {{ $book['description'] }}</p>
        </div>
    </div>
</div>
@endsection
