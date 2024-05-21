@extends('layouts.general-admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Editar Usuario</h1>
    <form action="{{ route('admin.usuarios.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $user->dni) }}">
        </div>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
            <label for="surname">Apellido</label>
            <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $user->surname) }}">
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>
        <div class="form-group">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
        </div>
        <div class="form-group">
            <label for="isAdmin">¿Es Administrador?</label>
            <select class="form-control" id="isAdmin" name="isAdmin">
                <option value="0" {{ old('isAdmin', $user->isAdmin) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('isAdmin', $user->isAdmin) == 1 ? 'selected' : '' }}>Sí</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
