@extends('layouts.general')

@section('title', $evento->titulo)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $imagenPath }}" class="img-fluid" alt="Imagen del evento: {{ $evento->titulo }}">
        </div>
        <div class="col-md-8">
            <h1 class="break-word">{{ $evento->titulo }}</h1>
            <p class="break-word"><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y H:i') }}</p>
            <p class="break-word"><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Publicado por:</strong> {{ $evento->user->name ?? 'No disponible' }}</p>
        </div>
    </div>
</div>
@endsection
