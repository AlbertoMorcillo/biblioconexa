@extends('layouts.general-logged')

@section('title', $noticia->titulo)

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')
    <!-- JavaScript adicional si es necesario -->
    <script src="{{ asset('js/sortNoticia.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-5 content">
        <section class="seccion-actividades" aria-label="Sección de noticias">
            <div class="row">
                <div class="col-md-5">
                    <!-- Aquí va la imagen de la noticia -->
                    <img src="{{ asset('storage/' . $noticia->imagen) }}" class="img-fluid card-img-top"
                        alt="Imagen de la noticia">
                </div>
                <div class="col-md-7">
                    <h1 class="seccion-titulo">{{ $noticia->titulo }}</h1>
                    <div class="noticia-detalle">
                        <p class="horario-actividad"><strong>Fecha de creación:</strong> {{ $noticia->hora }}</p>
                    </div>
                    <div class="noticia-descripcion mt-3">
                        {{ $noticia->descripcion }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
