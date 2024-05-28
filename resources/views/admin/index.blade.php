@extends('layouts.general-admin')

@section('title', 'Panel de Administración')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
@endsection

@section('content')
<div class="banner">
    <div class="banner-text">
        <h1 class="logo" aria-label="Nombre de la Biblioteca">BibloConexa - Panel de Administración</h1>
    </div>
    <div class="banner-image">
        <img src="{{ asset('images/corpo/Tsundoku-cuando-en-las-estanterias-se-acumulan-docenas-de-libros-sin-leer.jpg') }}" alt="Imagen principal al lado del logo">
    </div>
</div>

<div class="container mt-4">
    <!-- Sección de gestión -->
    <section aria-label="Sección de gestión">
        <h1 class="seccion-titulo text-center" tabindex="0">Gestión</h1>
        <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.usuarios.index') }}" class="link-libros" aria-label="Gestión de usuarios">
                        <img class="card-img-top" src="{{ asset('images/admin/usuarios.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de usuarios">Usuarios</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.noticias.index') }}" class="link-libros" aria-label="Gestión de noticias">
                        <img class="card-img-top" src="{{ asset('images/admin/noticias.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de noticias">Noticias</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.eventos.index') }}" class="link-libros" aria-label="Gestión de Eventos">
                        <img class="card-img-top" src="{{ asset('images/admin/eventos.jpg') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de Eventos">Eventos</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm">
                <a href="{{ route('admin.comentarios.index') }}" class="link-libros" aria-label="Gestión de comentarios">
                    <img class="card-img-top" src="{{ asset('images/admin/comentarios.webp') }}" alt="Imagen de la portada del libro" width="100%" height="225" />
                    <div class="card-body">
                        <h5 class="card-title titulo-libro" aria-label="Gestión de comentarios">Comentarios</h5>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
