@extends('layouts.general-logged')

@section('title', 'Eventos')

@section('content')
<section class="seccion-actividades" aria-label="Sección de actividades">
    <h1 class="seccion-titulo" tabindex="0">Actividades y eventos</h1>
    <div class="filter-container mb-4">
        <form method="GET" action="{{ route('actividades.logged') }}">
            <div class="form-group">
                <label for="sort">Ordenar por:</label>
                <select name="sort" id="sort" class="form-control">
                    <option value="most-recent" {{ request('sort') == 'most-recent' ? 'selected' : '' }}>Más recientes</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Más antiguas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="search">Buscar:</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Buscar actividades" value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn button mt-4">Aplicar filtros</button>
        </form>
    </div>
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
    <div class="pagination justify-content-center mt-4">
        {{ $eventos->links() }}
    </div>
</section>
@endsection
