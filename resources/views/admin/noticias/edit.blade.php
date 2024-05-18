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

    <form action="{{ route('admin.noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH') <!-- Usar PATCH en lugar de PUT -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $noticia->titulo) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required>{{ old('descripcion', $noticia->descripcion) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $noticia->fecha->format('Y-m-d')) }}" required>
        </div>
        <div id="horaContainer" style="display: {{ old('fecha', $noticia->fecha->format('Y-m-d')) > date('Y-m-d') ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de Publicación</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $noticia->fecha->format('H:i')) }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <button type="submit" class="btn button">Actualizar Noticia</button>
    </form>
</div>
@endsection