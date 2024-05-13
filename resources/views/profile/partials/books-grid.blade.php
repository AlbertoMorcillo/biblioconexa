@if($books->isEmpty())
    <p>No hay libros en esta categoría.</p>
@else
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ $book->libro->portada ?? asset('images/libros/default_cover.jpg') }}" class="card-img-top" alt="Portada de {{ $book->libro->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->libro->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($book->libro->sinopsis, 100) }}</p>
                        <a href="{{ route('libros.show', $book->libro->external_id) }}" class="btn btn-primary">Más detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
