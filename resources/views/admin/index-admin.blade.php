@extends('layouts.general-admin')

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
    <!-- Sección de novedades de libros-->
    <section aria-label="Sección de novedades sobre libros">
        <h1 class="seccion-titulo" tabindex="0">Novedades</h1>

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
        <div class="botonDirigir">
            <button type="button" id="verCatalogoBoton" class="btn button" aria-label="Botón que te dirije al catálogo">Ver catálogo</button>
        </div>
    </section>
    <!-- Final de sección de novedades de libros -->
    <!-- Sección de actividades -->
    <section class="seccion-actividades" aria-label="Sección de actividades">
        <h1 class="seccion-titulo" tabindex="0">Actividades y eventos</h1>

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
        <div class="botonDirigir">
            <button type="button" class="btn button" id="verActividadesBoton" aria-label="Botón que te dirije al catálogo">Ver más
                actividades</button>
        </div>
    </section>
    <!-- Final de sección de actividades -->
    <!-- Sección de noticias -->
    <section class="seccion-actividades" aria-label="Sección de noticias">
        <h1 class="seccion-titulo" tabindex="0">Noticias</h1>

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
        <div class="botonDirigir">
            <button type="button" class="btn button" id="verNoticiasBoton" aria-label="Botón que te dirije a ver más noticias">Ver más
                noticias</button>
        </div>
    </section>
    <!-- Final de sección de noticias -->

@endsection