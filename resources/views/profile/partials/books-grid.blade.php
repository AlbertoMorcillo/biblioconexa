@if($books->isEmpty())
    <p>No hay libros en esta categoría.</p>
@else
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $book->portada }}" class="card-img-top" alt="{{ $book->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($book->sinopsis, 100) }}</p>
                        <a href="#" class="btn btn-primary">Más detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
