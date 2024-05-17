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
                    <a href="{{ route('admin.usuarios') }}" class="link-libros" aria-label="Gestión de usuarios">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de usuarios">Usuarios</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.libros') }}" class="link-libros" aria-label="Gestión de libros">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de libros">Libros</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.categorias') }}" class="link-libros" aria-label="Gestión de categorías">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de categorías">Categorías</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.noticias') }}" class="link-libros" aria-label="Gestión de noticias">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de noticias">Noticias</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.eventos') }}" class="link-libros" aria-label="Gestión de eventos">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de eventos">Eventos</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="{{ route('admin.comentarios') }}" class="link-libros" aria-label="Gestión de comentarios">
                        <div class="card-body">
                            <h5 class="card-title titulo-libro" aria-label="Gestión de comentarios">Comentarios</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
