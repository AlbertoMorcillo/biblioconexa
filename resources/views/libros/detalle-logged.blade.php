@extends('layouts.general-logged')

@section('title', $book['title'])

@section('extra-js')
    <script defer src="{{ asset('js/eliminarComentarioConfirm.js') }}"></script>
    <script defer src="{{ asset('js/star-rating.js') }}"></script> <!-- Asegúrate de incluir el JS para manejar las estrellas -->
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book['cover_url'] }}" class="img-fluid" alt="Portada del libro: {{ $book['title'] }}">
                <button type="button" class="btn button mt-4" data-bs-toggle="modal" data-bs-target="#estadoLibroModal">
                    Actualizar estado del libro
                </button>
                <!-- Sistema de puntuación -->
                <div class="rating-area mt-4">
                    <form action="{{ route('puntuaciones.store', $book['external_id']) }}" method="POST">
                        @csrf
                        <div class="star-rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <input id="star{{ $i }}" name="puntuacion" type="radio"
                                    value="{{ $i }}" class="radio-btn hide" />
                                <label for="star{{ $i }}" class="star">☆</label>
                            @endfor
                        </div>
                        <div class="submit-button-container">
                            <button type="submit" class="btn button submit-rating-button mt-2">Enviar Puntuación</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <h1>{{ $book['title'] }}</h1>
                <p><strong>Autor/a:</strong> {{ $book['authors'] }}</p>
                <p><strong>Estado:</strong> {{ $book['estadoDelLibro'] }}</p>
                <p><strong>Puntuación media:</strong> {{ $book['rating'] }}</p>
                <p><strong>Tu puntuación:</strong> {{ $book['userPuntuacion'] }}</p>
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
                            <span class="puntuacion">Puntuación: {{ $comentario->puntuacion->puntuacion ?? 'No disponible' }}</span>
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
                    <button type="button" id="confirmDeleteButton" class="btn danger-button"
                        onclick="deleteComment()">Eliminar</button>
                    <button type="button" class="btn secondary-button" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal estanterias -->
<div class="modal fade" id="estadoLibroModal" tabindex="-1" aria-labelledby="estadoLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="estadoLibroModalLabel">Actualizar Estado del Libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('estanteriasLibros.update', ['estanteriasLibro' => $book['external_id']]) }}" method="post">                @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="estado" class="form-label">Elige un estado:</label>
              <select class="form-select" name="estado" required>
                <option value="leyendo">Leyendo</option>
                <option value="leidos">Leídos</option>
                <option value="quieroLeer">Quiero leer</option>
                <option value="abandonado">Abandonado</option>
              </select>
            </div>
            <button type="submit" class="btn button">Actualizar Estado</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
