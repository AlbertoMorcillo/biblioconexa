@extends('layouts.general-logged')

@section('title', 'Perfil de Usuario')

@section('extra-css')
    <!-- Estilos adicionales si son necesarios -->
@endsection

@section('content')
    <!-- Actualiza la información del perfil -->
    @include('profile.partials.update-profile-information-form')

    <!-- Actualiza la contraseña -->
    @include('profile.partials.update-password-form')

    <!-- Elimina el usuario -->
    @include('profile.partials.delete-user-form')
@endsection
