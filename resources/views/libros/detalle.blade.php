@extends('layouts.general')

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

            <!-- Comentarios -->
            <h3>Comentarios</h3>
            @forelse ($book['comentarios'] as $comentario)
                <p>{{ $comentario->texto }}</p>
                <p>Por: {{ $comentario->usuario->name }}</p>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

