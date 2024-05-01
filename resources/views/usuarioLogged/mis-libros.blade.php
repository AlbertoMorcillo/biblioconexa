@extends('layouts.general-logged')

@section('title', 'Mis libros')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
    <!-- Aquí puedes agregar JS adicional específico de esta página si es necesario -->
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo">Mis Libros</h1>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#leidos" data-toggle="tab">Leídos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#leyendo" data-toggle="tab">Leyendo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#quieroleer" data-toggle="tab">Quiero Leer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#abandonado" data-toggle="tab">Abandonados</a>
                </li>
            </ul>

            <div class="tab-content p-3">
                <div class="tab-pane active" id="leidos">
                    @include('profile.partials.books-grid', ['books' => $libros['leidos']])
                </div>
                
                <div class="tab-pane" id="leyendo">
                    @include('profile.partials.books-grid', ['books' => $libros['leyendo']])
                </div>
                
                <div class="tab-pane" id="quieroleer">
                    @include('profile.partials.books-grid', ['books' => $libros['quieroleer']])
                </div>
                
                <div class="tab-pane" id="abandonado">
                    @include('profile.partials.books-grid', ['books' => $libros['abandonado']])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

