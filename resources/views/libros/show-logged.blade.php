@extends('layouts.general-logged')

@section('title', $libro->titulo)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $libro->cover_url ?? asset('images/libros/default_cover.webp')}}" class="img-fluid" alt="Portada del libro: {{ $libro->titulo }}">
        </div>
        <div class="col-md-8">
            <h1>{{ $libro->titulo }}</h1>
            <p><strong>Author(s):</strong> {{ $book['authors'] }}</p>
            <p><strong>Rating:</strong> {{ $book['rating'] }}</p>
            <p><strong>Sinopsis:</strong> {{ $libro->sinopsis }}</p>
        </div>
    </div>
</div>
@endsection
