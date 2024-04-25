@extends('layouts.general')

@section('title', 'Index')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
    <h1 class="my-3 mt-3">Registrarse</h1>
    <form>
        <div class="form-floating my-3">
            <input type="text" class="form-control rounded-pill" id="dni" name="dni" placeholder="12345678E">
            <label for="dni">DNI</label>
            <div id="dni-error" class="error-text" style="display:none;"></div>
        </div>

        <div class="form-floating my-3">
            <input type="text" class="form-control rounded-pill" id="nombre" name="nombre" placeholder="Juan">
            <label for="dni">Nombre</label>
            <div id="nombre-error" class="error-text" style="display:none;"></div>
        </div>

        <div class="form-floating my-3">
            <input type="email" class="form-control rounded-pill" id="email" name="email"
                placeholder="name@example.com">
            <label for="email">Correo electrónico</label>
            <div id="email-error" class="error-text" style="display:none;"></div>
        </div>
        <div class="form-floating my-3">
            <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Password">
            <label for="password">Contraseña</label>
            <div id="password-error" class="error-text" style="display:none;"></div>
        </div>

        <div class="form-floating my-3">
            <input type="password" class="form-control rounded-pill" id="passwordRepetida" name="passwordRepetida"
                placeholder="Password repetida">
            <label for="passwordRepetida">Repita la contraseña</label>
            <div id="passwordRepetida-error" class="error-text" style="display:none;">
            </div>

            <button class="btn button w-100 py-2 my-3" type="submit">Registrarse</button>
            <a href="/login" class="mb-3 d-block text-center">¿Ya tienes cuenta? Inicia sesión</a>
            <p class="mt-5 mb-3 text-body-secondary">© BiblioConexa 2024</p>
    </form>
@endsection
