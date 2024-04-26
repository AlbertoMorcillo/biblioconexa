@extends('layouts.general')

@section('title', 'Catálogo')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
<form>
    <h1 class="my-3 mt-3">Recuperar contraseña</h1>
    <p>Se enviará un link por correo electrónico para establecer una nueva contraseña.</p>

    <div class="form-floating my-3">
      <input type="email" class="form-control rounded-pill" id="email" placeholder="name@example.com">
      <label for="floatingInput">Correo electrónico</label>
      <div id="email-error" class="error-text" style="display:none;"></div>
    </div>

    <button class="btn button w-100 py-2 my-3" type="submit">Recuperar</button>
    </div>
      <a href="/login" class="mb-3 d-block text-center">¿Ya recuerda la contraseña? Inicia sesión</a>
    <p class="mt-5 mb-3 text-body-secondary">© BiblioConexa 2024</p>
  </form>
@endsection