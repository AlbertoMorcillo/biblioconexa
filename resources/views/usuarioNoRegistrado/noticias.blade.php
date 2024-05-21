@extends('layouts.general')

@section('title', 'Noticias')

@section('content')
    <section class="seccion-actividades" aria-label="Sección de noticias">
        <h1 class="seccion-titulo" tabindex="0">Noticias</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0 mt-4">
            @foreach ($noticias as $noticia)
                <div class="col mb-4 mt-4">
                    <div class="card shadow-sm bg-blue h-100">
                        <a href="{{ route('noticias.show', $noticia->id) }}" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específica.">
                            <img class="card-img-top-noticias" src="{{ $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg') }}" alt="Imagen de la noticia" width="100%" height="225" />
                            <div class="card-body">
                                <h5 class="titulo-actividad" aria-label="Titulo de la noticia">{{ Str::limit($noticia->titulo,20) }}</h5>
                                <p class="card-text">{{ Str::limit($noticia->descripcion, 50) }}</p>
                                <p class="card-text mb-1"><small class="text-muted">{{ $noticia->fecha->format('d/m/Y H:i') }}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination justify-content-center mt-4">
            {{ $noticias->links() }}
        </div>
    </section>
@endsection
