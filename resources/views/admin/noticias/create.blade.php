@extends('layouts.general-admin')

@section('title', 'Crear Noticia')

@section('extra-js')
<script defer src="{{ asset('js/programarFechaNoticia.js') }}"></script>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Crear nueva noticia</h1>

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
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required>{{ old('descripcion') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de publicación</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
        </div>
        <div id="horaContainer">
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de Publicación</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="UsuarioDNI" class="form-label">DNI del Usuario</label>
            <input type="text" name="UsuarioDNI" id="UsuarioDNI" class="form-control" value="{{ $usuarioDNI }}" readonly>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <button type="submit" class="btn button">Crear Noticia</button>
    </form>
</div>
@endsection
