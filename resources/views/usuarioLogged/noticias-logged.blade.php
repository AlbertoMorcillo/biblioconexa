@extends('layouts.general-logged')

@section('title', 'Noticias')

@section('content')
    <section class="seccion-actividades" aria-label="Sección de noticias">
        <h1 class="seccion-titulo" tabindex="0">Noticias</h1>
        
        <!-- Filtros -->
        <div class="filter-container mb-4">
            <form method="GET" action="{{ route('noticias-logged') }}">
                <div class="form-group">
                    <label for="sort">Ordenar por:</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="most-recent" {{ request('sort') == 'most-recent' ? 'selected' : '' }}>Más recientes</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Más antiguas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="search">Buscar:</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar noticias">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Aplicar filtros</button>
            </form>
        </div>

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
        
        <div class="pagination justify-content-center mt-4">
            {{ $noticias->appends(request()->input())->links() }}
        </div>
    </section>
@endsection
