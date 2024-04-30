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
                @foreach($estanteria->estanteriasLibros as $estanteriasLibros) {{-- Cambio aquí --}}
                    <li>
                        {{ $estanteriasLibros->libro->titulo }} {{-- Accediendo a través de la relación --}}
                        - Puntuación: {{ $estanteriasLibros->libro->pivot->puntuacion ?? 'No calificado' }}
                        - Estado: {{ $estanteriasLibros->estado }}
                        <form action="{{ route('estanterias.libros.cambiarEstado', ['estanteria' => $estanteria->id, 'libro' => $estanteriasLibros->libro->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <!-- Aquí pondrías tu input o select para cambiar el estado -->
                            <button type="submit" class="btn button">Cambiar estado</button>
                        </form>
                        <form action="{{ route('estanterias.libros.eliminar', ['estanteria' => $estanteria->id, 'libro' => $estanteriasLibros->libro->id]) }}" method="POST">
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
