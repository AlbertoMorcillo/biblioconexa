
<div class="content">
    <section aria-label="Sección de cambio de datos del perfil">
        <h2 class="seccion-titulo">
            {{ __('Información de Perfil') }}
        </h2>
        <p class="mb-4">
            {{ __("Actualiza la información de perfil y dirección de correo electrónico de tu cuenta.") }}
        </p>

        <!-- Formulario para actualizar la información del perfil -->
        <form method="post" action="{{ route('profile.update') }}" class="mt-4">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                <input type="email" class="form-control rounded-pill" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="text-sm text-gray-600">
                            {{ __('Tu dirección de correo electrónico no está verificada.') }}
                            <a href="#" onclick="event.preventDefault(); document.getElementById('send-verification').submit();" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haz clic aquí para reenviar el correo de verificación.') }}</a>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2">{{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}</div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn button">{{ __('Guardar') }}</button>
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success" role="alert">
                        {{ __('Guardado.') }}
                    </div>
                @endif
            </div>
        </form>
    </section>
</div>