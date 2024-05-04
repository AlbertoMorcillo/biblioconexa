@extends('layouts.general')

@section('title', 'Catálogo')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
    <section class="catalog-section">
        <h1 class="section-title">Nuestro catálogo</h1>
        <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
            <div class="search-bar">
                <input type="search" name="q" id="book-search" class="search-input" placeholder="Buscar libro..."
                    aria-label="Campo para buscar libros por título, autor o ISBN" autocomplete="off">
                <button type="submit" class="search-button" aria-label="Clic para buscar">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <p class="search-instructions">Pulsa Enter o haz clic en la lupa para buscar</p>
    </section>

    <section aria-label="Sección de novedades sobre libros" class="mt-3">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
            <div class="col">
                <div class="card shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información del libro que si aprietas te lleva al libro específico.">
                        <img class="card-img-top" src="{{ asset('images/libros/sapiens.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Título del libro">Sapiens: De animales a dioses</h5>
                            <p class="card-text nombre-autor" aria-label="Nombre del autor">Yuval Noah Harari</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col">
                <div class="card shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información del libro que si aprietas te lleva al libro específico.">
                        <img class="card-img-top" src="{{ asset('images/libros/murakami.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Título del libro">La ciudad y sus muros inciertos</h5>
                            <p class="card-text nombre-autor" aria-label="Nombre del autor">Haruki Murakami</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col">
                <div class="card shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información del libro que si aprietas te lleva al libro específico.">
                        <img class="card-img-top" src="{{ asset('images/libros/yumi.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Título del libro">Yumi y el pintor de pesadillas</h5>
                            <p class="card-text nombre-autor" aria-label="Nombre del autor">Brandon Sanderson</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
