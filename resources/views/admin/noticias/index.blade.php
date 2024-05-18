@extends('layouts.general-admin')

@section('title', 'Gestión de Noticias')

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo text-center">Noticias</h1>
    <a href="{{ route('admin.noticias.create') }}" class="btn btn-primary mb-4">Crear Nueva Noticia</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($noticias as $noticia)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" class="card-img-top" alt="{{ $noticia->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($noticia->descripcion, 100) }}</p>
                        <p class="card-text"><small class="text-muted">{{ $noticia->fecha->format('d/m/Y') }}</small></p>
                        <a href="{{ route('admin.noticias.edit', $noticia->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta noticia?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
