@extends('layouts.general-admin')

@section('title', 'Gestión de Eventos')

@section('extra-js')
<script defer src="{{ asset('js/eliminarEvento.js') }}"></script>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Eventos</h1>
    <a href="{{ route('admin.eventos.create') }}" class="btn button mb-4">Crear nuevo evento</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0 mt-4">
        @foreach ($eventos as $evento)
            <div class="col mb-4 mt-4">
                <div class="card shadow-sm bg-blue h-100">
                    <a href="{{ route('admin.eventos.show', $evento->id) }}" class="link-libros" aria-label="Información del evento que si aprietas te lleva al evento específico.">
                        @if($evento->imagen)
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="{{ $evento->titulo }}" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="titulo-actividad" aria-label="Titulo del evento">{{ Str::limit($evento->titulo,20) }}</h5>
                            <p class="card-text">{{ Str::limit($evento->descripcion, 50) }}</p>
                            <p class="card-text mb-1"><small class="text-muted">{{ $evento->fecha->format('d/m/Y') }} {{ $evento->hora }}</small></p>
                        </div>
                    </a>
                    <div class="card-footer d-flex flex-column align-items-center bg-blue">
                        <a href="{{ route('admin.eventos.edit', $evento->id) }}" class="btn secondary-button mb-2">Editar</a>
                        <button type="button" class="btn danger-button mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $evento->id }}">Eliminar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($eventos->lastPage() > 1)
        <nav aria-label="Página de navegación">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $eventos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $eventos->url(1) }}">Primera</a>
                </li>
                <li class="page-item {{ $eventos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $eventos->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @foreach ($eventos->getUrlRange(max($eventos->currentPage() - 2, 1), min($eventos->currentPage() + 2, $eventos->lastPage())) as $i => $url)
                    <li class="page-item {{ $eventos->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $i }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $eventos->currentPage() == $eventos->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $eventos->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $eventos->currentPage() == $eventos->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $eventos->url($eventos->lastPage()) }}">Última</a>
                </li>
            </ul>
        </nav>
    @endif
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este evento?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn secondary-button" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn danger-button" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection
