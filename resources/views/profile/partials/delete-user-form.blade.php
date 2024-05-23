<div class="content">
    <section aria-label="Sección de eliminar la cuenta">
        <h2 class="seccion-titulo">
            {{ __('Eliminar Cuenta') }}
        </h2>
        <p class="mb-4">
            {{ __('Una vez tu cuenta es eliminada, todos la data sera borrada permanentemente.') }}
        </p>
        <!-- Botón para eliminar cuenta -->
        <button type="button" class="btn danger-button" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            {{ __('Eliminar Cuenta') }}
        </button>
    </section>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">{{ __('¿Estas seguro de querer eliminar tu cuenta?') }}</h5>
                    <button type="button" class="btn secondary-button" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p>{{ __('Una vez tu cuenta es eliminada, todos tus datos seran borrados. Por favor, introduzca su contraseña para borrar permanentemente la cuenta.') }}</p>
                        <div class="mb-3">
                            <label for="delete-password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="password" class="form-control" id="delete-password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn secondary-button" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn danger-button ">{{ __('Eliminar cuenta') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
