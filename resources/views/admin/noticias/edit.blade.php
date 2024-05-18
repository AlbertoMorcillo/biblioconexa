@extends('layouts.general-admin')

@section('title', 'Editar Noticia')

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Editar Noticia</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $noticia->titulo }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required>{{ $noticia->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $noticia->fecha }}" required>
        </div>
        <div class="mb-3">
            <label for="UsuarioDNI" class="form-label">DNI del Usuario</label>
            <input type="text" name="UsuarioDNI" id="UsuarioDNI" class="form-control" value="{{ $noticia->UsuarioDNI }}" required>
        </div>
        <div class="mb-3">
            <label for="publicado" class="form-label">Publicado</label>
            <input type="checkbox" name="publicado" id="publicado" {{ $noticia->publicado ? 'checked' : '' }}>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            @if ($noticia->imagen)
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="img-fluid mt-3">
            @endif
        </div>
        <button type="submit" class="btn button">Actualizar Noticia</button>
    </form>
</div>
@endsection
