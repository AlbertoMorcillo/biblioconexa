@extends('layouts.general')

@section('title', 'Index')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
        <!-- Aquí irán las actividades -->
    </div>
    <div class="botonDirigir">
        <button type="button" class="btn button" id="verActividadesBoton" aria-label="Botón que te dirije al catálogo">Ver más actividades</button>
    </div>
</section>
<!-- Final de sección de actividades -->
<!-- Sección de noticias -->
<section class="seccion-actividades" aria-label="Sección de noticias">
    <h1 class="seccion-titulo" tabindex="0">Noticias</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
        @foreach ($noticias as $noticia)
            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específica.">
                        <img class="card-actividad-img-top" src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" alt="Imagen de la noticia" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">{{ $noticia->titulo }}</h5>
                            <p class="horario-actividad" aria-label="Horario de la Noticia">{{ $noticia->fecha->format('H:i') }}</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">{{ $noticia->fecha->format('d/m/Y') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="botonDirigir">
        <button type="button" class="btn button" id="verNoticiasBoton" aria-label="Botón que te dirije a ver más noticias">Ver más noticias</button>
    </div>
</section>
<!-- Final de sección de noticias -->
@endsection
