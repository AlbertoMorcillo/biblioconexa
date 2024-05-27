@extends('layouts.general')

@section('title', 'Index')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
<script defer src="{{ asset('js/redireccionarANoticias.js') }}"></script>
@endsection

@section('content')

<div class="banner">
    <div class="banner-text">
        <h1 class="logo" aria-label="Nombre de la Biblioteca">BibloConexa</h1>
    </div>
    <div class="banner-image">
        <img src="{{ asset('images/corpo/Tsundoku-cuando-en-las-estanterias-se-acumulan-docenas-de-libros-sin-leer.jpg') }}" alt="Imagen principal al lado del logo">
    </div>
</div>

<!-- Sección de actividades -->
<section class="seccion-actividades" aria-label="Sección de actividades">
    <h1 class="seccion-titulo" tabindex="0">Actividades y eventos</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0 mt-4">
        @foreach ($eventos as $evento)
            <div class="col mb-4 mt-4">
                <div class="card shadow-sm bg-blue h-100">
                    <a href="{{ route('eventos.show', $evento->id) }}" class="link-libros" aria-label="Información del evento que si aprietas te lleva al evento específico.">
                        <img class="card-img-top-eventos" src="{{ $evento->imagen ? asset('storage/' . $evento->imagen) : asset('images/admin/eventos.jpg') }}" alt="Imagen del evento" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="titulo-actividad" aria-label="Titulo del evento">{{ Str::limit($evento->titulo, 20) }}</h5>
                            <p class="card-text">{{ Str::limit($evento->descripcion, 50) }}</p>
                            <p class="card-text mb-1"><small class="text-muted">{{ $evento->fecha->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="botonDirigir">
        <button type="button" class="btn button" id="verActividadesBoton" aria-label="Botón que te dirige a ver más actividades">Ver más actividades</button>
    </div>
</section>
<!-- Final de sección de actividades -->

<!-- Sección de noticias -->
<section class="seccion-actividades" aria-label="Sección de noticias">
    <h1 class="seccion-titulo" tabindex="0">Noticias</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0 mt-4">
        @foreach ($noticias as $noticia)
            <div class="col mb-4 mt-4">
                <div class="card shadow-sm bg-blue h-100">
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específica.">
                        <img class="card-img-top-noticias" src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" alt="Imagen de la noticia" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">{{ Str::limit($noticia->titulo, 20) }}</h5>
                            <p class="card-text">{{ Str::limit($noticia->descripcion, 50) }}</p>
                            <p class="card-text mb-1"><small class="text-muted">{{ $noticia->fecha->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="botonDirigir">
        <button type="button" class="btn button" id="verNoticiasBoton" aria-label="Botón que te dirige a ver más noticias">Ver más noticias</button>
    </div>
</section>
<!-- Final de sección de noticias -->
@endsection
