<div class="content">
    <section aria-label="Sección de actualizar contraseña">
        <h2 class="seccion-titulo">
            {{ __('Actualizar Contraseña') }}
        </h2>
        <p class="mb-4">
            {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>

        <!-- Formulario para actualizar contraseña -->
        <form method="post" action="{{ route('password.update') }}" class="mt-4">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
                <input type="password" class="form-control rounded-pill" id="current_password" name="current_password" required autocomplete="current-password">
                <!-- Mensaje de error para contraseña actual -->
                @error('current_password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Nueva Contraseña') }}</label>
                <input type="password" class="form-control rounded-pill" id="password" name="password" required autocomplete="new-password">
                <!-- Mensaje de error para nueva contraseña -->
                @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                <input type="password" class="form-control rounded-pill" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                <!-- Mensaje de error para confirmar contraseña -->
                @error('password_confirmation')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn button">{{ __('Guardar') }}</button>
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success" role="alert">
                        {{ __('Guardado.') }}
                    </div>
                @endif
            </div>
        </form>
    </section>
</div>