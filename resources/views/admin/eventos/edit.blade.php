@extends('layouts.general-admin')

@section('title', 'Editar Evento')

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Editar evento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $evento->titulo) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $evento->fecha->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $evento->hora) }}" required>
        </div>
        <div class="mb-3">
            <label for="sala" class="form-label">Sala</label>
            <input type="text" name="sala" id="sala" class="form-control" value="{{ old('sala', $evento->sala) }}">
        </div>
        <div class="mb-3">
            <label for="UsuarioDNI" class="form-label">DNI del Usuario</label>
            <input type="text" name="UsuarioDNI" id="UsuarioDNI" class="form-control" value="{{ old('UsuarioDNI', $evento->UsuarioDNI) }}" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <button type="submit" class="btn button">Actualizar Evento</button>
    </form>
</div>
@endsection
