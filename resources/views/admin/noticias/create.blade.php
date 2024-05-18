@extends('layouts.general-admin')

@section('title', 'Crear Noticia')

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Crear Nueva Noticia</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="UsuarioDNI" class="form-label">DNI del Usuario</label>
            <input type="text" name="UsuarioDNI" id="UsuarioDNI" class="form-control" value="{{ $usuarioDNI }}" readonly>
        </div>
        <div class="mb-3">
            <label for="publicado" class="form-label">Publicado</label>
            <input type="checkbox" name="publicado" id="publicado">
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <button type="submit" class="btn button">Crear Noticia</button>
    </form>
</div>
@endsection
