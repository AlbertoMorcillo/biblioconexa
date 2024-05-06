@extends('layouts.general-logged')

@section('title', $book['title'])

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $book['cover_url'] }}" class="img-fluid" alt="Portada del libro: {{ $book['title'] }}">
        </div>
        <div class="col-md-8">
            <h1>{{ $book['title'] }}</h1>
            <p><strong>Autor/a:</strong> {{ $book['authors'] }}</p>
            <p><strong>Puntuación:</strong> {{ $book['rating'] }}</p>
            <p><strong>Sinopsis:</strong> {{ $book['description'] }}</p>
            <!-- Ejemplo de opciones adicionales para usuarios logueados -->
            <button class="btn btn-primary">Editar</button>
            <button class="btn btn-danger">Eliminar</button>
        </div>
    </div>
</div>
@endsection
