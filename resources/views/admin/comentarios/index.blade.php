@extends('layouts.general-admin')

@section('title', 'Administrar Comentarios')

@section('content')
<div class="container mt-4">
    <h1 class="seccion-titulo">Administrar Comentarios</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.comentarios.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por usuario" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comentarios as $comentario)
                <tr>
                    <td>{{ $comentario->id }}</td>
                    <td>{{ $comentario->usuario->name }}</td>
                    <td>{{ Str::limit($comentario->texto, 50) }}</td>
                    <td>{{ $comentario->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.comentarios.destroy', $comentario->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este comentario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $comentarios->links() }}
</div>
@endsection
