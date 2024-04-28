@extends('layouts.general-logged')

@section('title', 'Actividades')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
    <section class="seccion-actividades" aria-label="Sección de noticias">
        <h1 class="seccion-titulo">Actividades</h1>
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
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/lectura-conjunta-principito.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Lectura conjunta de El Principito!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">10:30</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Cervantes</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/recomendaciones-iniciarte-literatura-japonesa.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Introducción a la literatura japonesa!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">15:00</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Platón</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col">
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/aprende-escribir-libro.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Aprende a escribir un libro!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">16:00</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Virgilio</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-0">
            <div class="col">
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/lectura-conjunta-principito.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Lectura conjunta de El Principito!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">10:30</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Cervantes</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/recomendaciones-iniciarte-literatura-japonesa.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Introducción a la literatura japonesa!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">15:00</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Platón</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col">
                <div class="card card-actividad shadow-sm">
                    <a href="#" class="link-libros" aria-label="Información de la actividad que si aprietas te lleva a la actividad específico.">
                        <img class="card-actividad-img-top" src="{{ asset('images/actividades/aprende-escribir-libro.jpg') }}" alt="Imagen de la actividad" />
                        <div class="card-actividad-body">
                            <h5 class="titulo-actividad" aria-label="Titulo de la actividad">¡Aprende a escribir un libro!</h5>
                            <p class="horario-actividad" aria-label="Horario de la actividad">16:00</p>
                            <p class="sala-actividad" aria-label="Sala de la actividad">Sala Virgilio</p>
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
