@extends('layouts.general-logged')

@section('title', $book['title'])

@section('extra-js')
    <script defer src="{{ asset('js/eliminarComentarioConfirm.js') }}"></script>
@endsection

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
                <p lang="en"><strong>Sinopsis:</strong> {{ $book['description'] }}</p>

                <!-- Mensaje de éxito -->
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Comentarios -->
                <h2>Comentarios</h2>
                @forelse ($book['comentarios'] as $comentario)
                    <div class="comentario">
                        <div class="header">
                            <span class="nombre">{{ $comentario->usuario->name }}</span>
                            <span class="fecha">{{ $comentario->created_at->format('d/m/Y') }}</span>
                            @if (Auth::id() === $comentario->user_id)
                                <!-- Botón que activa el modal -->
                                <button type="button" class="btn danger-button btn-sm extra-small-button"
                                    data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                    data-comentario-id="{{ $comentario->id }}">
                                    Eliminar
                                </button>
                            @endif
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
                        <label for="texto">Escribe tu comentario:</label>
                        <textarea name="texto" class="form-control" aria-label="Espacio para escribir tu comentario" required></textarea>
                    </div>
                    <button type="submit" class="btn button mt-4">Agregar comentario</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este comentario?
                </div>
                <div class="modal-footer">
                    <form id="confirmDeleteForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="comentarioId" id="comentarioIdToDelete">
                    </form>
                    <button type="button" class="btn secondary-button" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn danger-button" id="confirmDeleteButton"
                        onclick="deleteComment()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
