@extends('layouts.general-logged')

@section('title', 'Mis libros')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
    <!-- Aquí puedes agregar JS adicional específico de esta página si es necesario -->
    <script src="{{ asset('js/estanterias.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo">Mis Libros</h1>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#todos" data-toggle="tab" aria-label="Si aprietas veras todos los libros">Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#leidos" data-toggle="tab" aria-label="Si aprietas veras los libros leídos">Leídos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#leyendo" data-toggle="tab" aria-label="Si aprietas veras los libros que estas leyendo">Leyendo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#quieroleer" data-toggle="tab" aria-label="Si aprietas veras los libros que quieres leer">Quiero Leer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#abandonado" data-toggle="tab" aria-label="Si aprietas veras los libros que abandonaste">Abandonados</a>
                </li>
            </ul>

            <div class="tab-content p-3" aria-label="Sección de tus estanterias">
                <div class="tab-pane active" id="todos">
                    @include('profile.partials.books-grid', ['books' => $librosAgrupados['Todos'] ?? collect()])
                </div>
                <div class="tab-pane" id="leidos">
                    @include('profile.partials.books-grid', ['books' => $librosAgrupados['Leído'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="leyendo">
                    @include('profile.partials.books-grid', ['books' => $librosAgrupados['Leyendo actualmente'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="quieroleer">
                    @include('profile.partials.books-grid', ['books' => $librosAgrupados['Quiero leerlo'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="abandonado">
                    @include('profile.partials.books-grid', ['books' => $librosAgrupados['Abandonado'] ?? collect()])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
