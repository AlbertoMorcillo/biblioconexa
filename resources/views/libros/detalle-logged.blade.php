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
                <!-- Botones de interacción -->

                <!-- Comentarios -->
                <h3>Comentarios</h3>
                @forelse ($book['comentarios'] as $comentario)
                    <div class="comentario">
                        <div class="header">
                            <span class="nombre">{{ $comentario->usuario->name }}</span>
                            <span class="puntuacion">Puntuación: {{ $comentario->puntuacion }}</span>
                            <span class="fecha">{{ $comentario->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="contenido">
                            {{ $comentario->texto }}
                        </div>
                    </div>
                @empty
                    <p>No hay comentarios aún.</p>
                @endforelse
                <form action="{{ route('comentarios.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="external_id" value="{{ $book['external_id'] }}">
                    <div class="form-group">
                        <textarea name="texto" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn button mt-4">Agregar comentario</button>
                </form>
            </div>
        </div>
    </div>
@endsection
