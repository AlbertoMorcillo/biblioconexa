@extends('layouts.general-admin')

@section('title', 'Gestión de Usuarios')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
<script defer src="{{ asset('js/confirmarEliminarUsuario.js') }}"></script>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Gestión de Usuarios</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.usuarios.create') }}" class="btn button mb-3">Crear Usuario</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Administrador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->dni }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td>{{ $user->isAdmin ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn secondary-button">Editar</a>
                        <button type="button" class="btn danger-button" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="{{ $user->id }}">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>

<!-- Modal de confirmación para eliminar usuario -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteUserForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar este usuario? Esta acción no se puede deshacer.</p>
                    <div class="form-group">
                        <label for="admin-password">Contraseña de administrador</label>
                        <input type="password" name="admin_password" id="admin-password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn secondary-button" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn danger-button">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
