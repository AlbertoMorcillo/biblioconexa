@extends('layouts.general-admin')

@section('title', 'Gestión de Usuarios')

@section('extra-css')
<!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Gestión de Usuarios</h1>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>
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
                        <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.usuarios.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
