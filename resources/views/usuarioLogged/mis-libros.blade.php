@extends('layouts.general-logged')

@section('title', 'Mis libros')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
    <!-- Aquí puedes agregar JS adicional específico de esta página si es necesario -->
@endsection

@section('content')
    <div class="container">
        <h1 class="seccion-titulo">Mis libros</h1>

        @foreach($estanterias as $estanteria)
            <div class="estanteria">
                <h2>{{ $estanteria->estado }}</h2>
                <ul>
                    @foreach($estanteria->libros as $libro)
                        <li>
                            {{ $libro->titulo }}
                            - Puntuación: {{ $libro->pivot->puntuacion ?? 'No calificado' }}
                            - Estado: {{ $libro->pivot->estado }}
                            <form action="{{ route('estanterias.libros.cambiarEstado', ['estanteria' => $estanteria->id, 'libro' => $libro->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                {{-- Añade aquí el select o input para el cambio de estado --}}
                                <button type="submit" class="btn button">Cambiar estado</button>
                            </form>
                            <form action="{{ route('estanterias.libros.eliminar', ['estanteria' => $estanteria->id, 'libro' => $libro->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn danger-button">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
