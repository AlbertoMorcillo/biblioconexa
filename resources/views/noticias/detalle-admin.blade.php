@extends('layouts.general-admin')

@section('title', $noticia->titulo)
@section('extra-js')
<script defer src="{{ asset('js/eliminarNoticia.js') }}"></script>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $imagenPath }}" class="img-fluid" alt="Imagen de la noticia: {{ $noticia->titulo }}">
        </div>
        <div class="col-md-8">
            <h1 class="break-word">{{ $noticia->titulo }}</h1>
            <p class="break-word"><strong>Fecha:</strong> {{ $noticia->fecha->format('d/m/Y H:i') }}</p>
            <p class="break-word"><strong>Descripción:</strong> {{ $noticia->descripcion }}</p>
            <p><strong>Publicado por:</strong> {{ $noticia->user->name ?? 'No disponible' }}</p>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.noticias.edit', $noticia->id) }}" class="btn secondary-button mb-2">Editar</a>
        <!-- Botón que activa el modal -->
        <button type="button" class="btn danger-button mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $noticia->id }}">Eliminar</button>
    </div>
</div>


<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta noticia?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection
