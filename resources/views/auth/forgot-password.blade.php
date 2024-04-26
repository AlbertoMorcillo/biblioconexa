@extends('layouts.general')

@section('title', 'Recuperar contraseña')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
<!-- Si necesitas JS específico -->
@endsection

@section('content')
<h1 class="my-3 mt-3">Recuperar contraseña</h1>
<p>Se enviará un link por correo electrónico para establecer una nueva contraseña.</p>

<!-- Mostrar el estado de la sesión -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}" novalidate>
    @csrf

    <!-- Email Address -->
    <div class="form-group my-3">
        <label class="form-label" for="email">Correo electrónico</label>
        <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" :value="old('email')" required autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div id="email-error" class="error-text" style="display:none;"></div>
    </div>

    <button class="btn button w-100 py-2 my-3" type="submit">{{ __('Email Password Reset Link') }}</button>
    
    <a href="{{ route('login') }}" class="mb-3 d-block text-center">¿Ya recuerda la contraseña? Inicia sesión</a>
    <p class="mt-5 mb-3 text-body-secondary">© BiblioConexa 2024</p>
</form>
@endsection
