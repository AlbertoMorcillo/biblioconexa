@extends('layouts.general-admin')

@section('title', 'Gestión de Noticias')

@section('extra-js')
<script defer src="{{ asset('js/eliminarNoticia.js') }}"></script>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Noticias</h1>
    <a href="{{ route('admin.noticias.create') }}" class="btn button mb-4">Crear nueva noticia</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0 mt-4">
        @foreach ($noticias as $noticia)
            <div class="col mb-4 mt-4">
                <div class="card shadow-sm bg-blue h-100">
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específica.">
                        <img class="card-img-top-noticias" src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" alt="Imagen de la noticia" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">{{ Str::limit($noticia->titulo,20) }}</h5>
                            <p class="card-text">{{ Str::limit($noticia->descripcion, 50) }}</p>
                            <p class="card-text mb-1"><small class="text-muted">{{ $noticia->fecha->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </a>
                    <div class="card-footer d-flex flex-column align-items-center bg-blue">
                        <a href="{{ route('admin.noticias.edit', $noticia->id) }}" class="btn secondary-button mb-2">Editar</a>
                        <!-- Botón que activa el modal -->
                        <button type="button" class="btn danger-button mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $noticia->id }}">Eliminar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    

    <!-- Paginación -->
    @if ($noticias->lastPage() > 1)
        <nav aria-label="Página de navegación">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $noticias->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $noticias->url(1) }}">Primera</a>
                </li>
                <li class="page-item {{ $noticias->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $noticias->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @foreach ($noticias->getUrlRange(max($noticias->currentPage() - 2, 1), min($noticias->currentPage() + 2, $noticias->lastPage())) as $i => $url)
                    <li class="page-item {{ $noticias->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $i }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $noticias->currentPage() == $noticias->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $noticias->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $noticias->currentPage() == $noticias->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $noticias->url($noticias->lastPage()) }}">Última</a>
                </li>
            </ul>
        </nav>
    @endif
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
