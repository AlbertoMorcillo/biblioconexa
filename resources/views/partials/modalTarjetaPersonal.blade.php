<!-- Modal -->
<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudLabel">Solicitud para hacer tarjeta personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('tarjetaPersonal.store') }}">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Género</label>
                            <div class="d-flex">
                                @foreach(['Hombre', 'Mujer', 'No binario', 'Privado'] as $genero)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genero" id="{{ strtolower($genero) }}" value="{{ $genero }}" {{ old('genero') == $genero ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ strtolower($genero) }}">{{ $genero }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="primerApellido" class="form-label">Primer apellido</label>
                            <input type="text" class="form-control" id="primerApellido" name="primer_apellido" value="{{ old('primer_apellido') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="segundoApellido" class="form-label">Segundo apellido</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="correo_electronico" value="{{ old('correo_electronico') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn secondary-button" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn button">{{ __('Enviar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
