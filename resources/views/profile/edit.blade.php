@extends('layouts.general-logged')

@section('title', 'Perfil de Usuario')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('extra-js')
    <!-- JavaScript adicional si es necesario -->
    <script src="{{ asset('js/validation.js') }}" defer></script>
@endsection

@section('content')
    <h1 class="section-title">Perfil de Usuario</h1>
    <!-- Actualiza la información del perfil -->
    @include('profile.partials.update-profile-information-form')

    <!-- Actualiza la contraseña -->
    @include('profile.partials.update-password-form')

    <!-- Elimina el usuario -->
    @include('profile.partials.delete-user-form')
@endsection
