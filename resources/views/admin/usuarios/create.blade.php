@extends('layouts.general-admin')

@section('title', 'Crear Usuario')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Crear Usuario</h1>
    <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}">
        </div>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="surname">Apellido</label>
            <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname') }}">
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
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
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
        </div>
        <div class="form-group">
            <label for="isAdmin">¿Es Administrador?</label>
            <select class="form-control" id="isAdmin" name="isAdmin">
                <option value="0" {{ old('isAdmin') == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('isAdmin') == 1 ? 'selected' : '' }}>Sí</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
