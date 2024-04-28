@extends('layouts.general-logged')

@section('title', 'Tarjeta personal')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')
    <!-- JavaScript adicional si es necesario -->
@endsection

@section('content')
    <section aria-label="Sección informativa sobre la tarjeta personal">
        <h1 class="seccion-titulo">Tarjeta personal</h1>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <h2 class="section-subtitle">Beneficios por tener tarjeta personal</h2>
                    <p class="section-text">
                        No es necesario estar registrado en la web para tener una tarjeta personal.
                        Con ella, podrás disfrutar de varios beneficios como préstamo de libros, más tiempo de préstamo, y acceso a internet.
                        <ul>
                            <li>Préstamo de libros</li>
                            <li>Pedir más tiempo de préstamo</li>
                            <li>Acceso a internet</li>
                        </ul>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2 class="section-subtitle">Solicitar Tarjeta</h2>
                    <p class="section-text">
                        Puedes solicitar presencialmente tu tarjeta personal en la biblioteca o de forma telemática.
                        De forma presencial necesitaremos tu DNI y una foto de carnet.
                    </p>
                    <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#modalSolicitud">Solicitud telemática</button>
                </div>
            </div>
        </div>
        @include('partials.modalTarjetaPersonal')
    </section>
@endsection
