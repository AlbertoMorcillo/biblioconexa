@extends('layouts.general')

@section('title', 'Noticias')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
    <section class="seccion-actividades" aria-label="Sección de noticias">
        <h1 class="seccion-titulo">Noticias</h1>
        <div class="filter-container mt-3 mb-5">
            <label for="sort-order" class="filter-label">Ordenar por:</label>
            <select id="sort-order" class="filter-select">
                <option value="most-recent">Más recientes</option>
                <option value="oldest">Más antiguas</option>
                <!-- Añade más opciones de filtro si es necesario -->
            </select>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/miguel-unamuno_97.webp') }}" alt="Imagen de la noticia" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">Manias de escritores</h5>
                            <p class="horario-actividad" aria-label="Horario de la Noticia">10:30</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">08/04/2024</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/evento.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">Los libros más exitosos para los niños</h5>
                            <p class="horario-actividad" aria-label="Horario de la noticia">15:00</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">20/03/2024</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/Practicarum-Cover-and-Spine--644x300.webp') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">¿Libros hechos con piel humana?</h5>
                            <p class="horario-actividad" aria-label="Horario de la noticia">16:00</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">20/03/2024</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/miguel-unamuno_97.webp') }}" alt="Imagen de la noticia" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">Manias de escritores</h5>
                            <p class="horario-actividad" aria-label="Horario de la Noticia">10:30</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">08/04/2024</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/evento.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">Los libros más exitosos para los niños</h5>
                            <p class="horario-actividad" aria-label="Horario de la noticia">15:00</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">20/03/2024</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col">
                <div class="card card-noticias shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la noticia que si aprietas te lleva a la noticia específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/noticias/Practicarum-Cover-and-Spine--644x300.webp') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la noticia">¿Libros hechos con piel humana?</h5>
                            <p class="horario-actividad" aria-label="Horario de la noticia">16:00</p>
                            <p class="sala-actividad" aria-label="Fecha de la noticia">20/03/2024</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        <nav aria-label="Paginación para ver más noticias">
            <ul class="pagination justify-content-center pagination-custom">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <!-- !Añadir que si el usuario esta en esa página que en la clase se ponga active -->
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>

    </section>
@endsection
