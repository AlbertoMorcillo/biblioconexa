@extends('layouts.general')

@section('title', 'Registro')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
<script src="{{ asset('js/validation.js') }}" defer></script>
@endsection

@section('content')
    <h1 class="my-3 mt-3">Registrarse</h1>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- DNI -->
            <div class="mb-3">
                <label for="dni" class="form-label">{{ __('DNI') }}</label>
                <input id="dni" type="text" placeholder="12345678E" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autofocus>
                <div class="invalid-feedback js-error-dni" style="display:none;"></div>
                @error('dni')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                <div class="invalid-feedback js-error-name" style="display:none;"></div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                <input id="email" type="email" placeholder="juan@ejemplo.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <div class="invalid-feedback js-error-email" style="display:none;"></div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <div class="invalid-feedback js-error-password" style="display:none;"></div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirmar contraseña') }}</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <div class="invalid-feedback js-error-password-confirmation" style="display:none;"></div>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn button">
                    {{ __('Registrar') }}
                </button>
            </div>
        </form>
    </div>
@endsection
