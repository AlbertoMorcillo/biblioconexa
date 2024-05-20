@extends('layouts.general')

@section('title', $noticia->titulo)

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
            <p ><strong>Publicado por:</strong> {{ $noticia->user->name ?? 'No disponible' }}</p>
        </div>
    </div>
</div>
@endsection
