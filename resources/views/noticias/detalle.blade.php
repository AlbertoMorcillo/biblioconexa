@extends('layouts.general')

@section('title', $noticia->titulo)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img class="card-actividad-img-top" src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" alt="Imagen de la noticia" />
        </div>
        <div class="col-md-8">
            <h1>{{ $noticia->titulo }}</h1>
            <p><strong>Fecha:</strong> {{ $noticia->fecha->format('d/m/Y H:i') }}</p>
            <p><strong>Descripción:</strong> {{ $noticia->descripcion }}</p>
            <p><strong>Publicado por:</strong> {{ $noticia->user->name ?? 'No disponible' }}</p>
        </div>
    </div>
</div>
@endsection
