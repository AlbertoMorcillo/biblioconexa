@extends('layouts.general')

@section('title', 'Login')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
    <!-- Aquí puedes agregar JS adicional específico de esta página si es necesario -->
@endsection

@section('content')

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="my-3 mt-3">Iniciar sesión</h1>

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

          <!-- Email Address -->
          <div class="form-group my-3 mt-3">
            <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
            <input id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="juan@ejemplo.com">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group my-3 mt-3">
            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
            <input id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="********">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Remember Me -->
        <!-- Quitado porque no estás seguro de implementarlo -->

        <button class="btn button w-100 py-2 my-3" type="submit">{{ __('Log in') }}</button>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="mb-3 d-block text-center">¿Has olvidado tu contraseña?</a>
        @endif
        <hr>
        {{-- <p class="mt-2 mb-3 text-center">O inicia sesión con</p>
        <div class="d-flex justify-content-center">
            <button class="btn btn-google" type="button" aria-label="Botón que te hará iniciar sesión con Google">
                <img class="google-logo" src="{{ asset('images/logos/google-logo.png') }}" alt="Logo de Google">
                Iniciar sesión con Google
            </button>
        </div> --}}
        <!-- Omitimos el inicio de sesión con Google a menos que esté implementado -->

        <p class="mt-5 mb-3 text-body-secondary">© BiblioConexa 2024</p>
    </form>


@endsection
