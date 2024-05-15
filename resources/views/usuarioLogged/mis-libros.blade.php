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
                    <a class="nav-link active" href="#leidos" data-toggle="tab" aria-label="Si aprietas veras los libros leídos">Leídos</a>
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
                <div class="tab-pane active" id="leidos">
                    @include('profile.partials.books-grid', ['books' => $libros['Leído'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="leyendo">
                    @include('profile.partials.books-grid', ['books' => $libros['Leyendo actualmente'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="quieroleer">
                    @include('profile.partials.books-grid', ['books' => $libros['Quiero leerlo'] ?? collect()])
                </div>
                
                <div class="tab-pane" id="abandonado">
                    @include('profile.partials.books-grid', ['books' => $libros['Abandonado'] ?? collect()])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
