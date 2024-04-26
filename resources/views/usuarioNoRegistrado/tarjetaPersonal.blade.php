@extends('layouts.general')

@section('title', 'Tarjeta personal')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection


@section('content')
    <section aria-label="Sección informativa sobre la tarjeta personal">
        <h1 class="seccion-titulo">Tarjeta personal</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="section-subtitle">Beneficios por tener tarjeta personal</h2>
                    <p class="section-text">
                        No es necesario estar registrado a la web para tener una tarjeta personal.
                        Gracias a la tarjeta personal podrás disfrutar de los siguientes beneficios:
                    <ul>
                        <li>Préstamo de libros</li>
                        <li>Pedir más tiempo de prestamo</li>
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
                    <button type="button" class="btn button" data-bs-toggle="modal"
                        data-bs-target="#modalSolicitud">Solicitud telemática</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSolicitudLabel">Solicitud para hacer tarjeta personal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label class="form-label">Género</label>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genero" id="hombre"
                                                value="hombre">
                                            <label class="form-check-label" for="hombre">Hombre</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genero" id="mujer"
                                                value="mujer">
                                            <label class="form-check-label" for="mujer">Mujer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genero" id="noBinario"
                                                value="noBinario">
                                            <label class="form-check-label" for="noBinario">No binario</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genero" id="privado"
                                                value="privado">
                                            <label class="form-check-label" for="privado">Privado</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimiento">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                                <div class="col-md-5">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="dni">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="primerApellido" class="form-label">Primer apellido</label>
                                    <input type="text" class="form-control" id="primerApellido">
                                </div>
                                <div class="col-md-6">
                                    <label for="segundoApellido" class="form-label">Segundo apellido</label>
                                    <input type="text" class="form-control" id="segundoApellido">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono">
                                </div>
                            </div>
                            <!-- Agregar más campos según sea necesario -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn secondary-button" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn button">Enviar</button>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
