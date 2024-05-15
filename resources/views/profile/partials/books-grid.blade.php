@if($books->isEmpty())
    <p>No hay libros en esta categoría.</p>
@else
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Puntuación Media</th>
                    <th>Tu puntuación</th>
                    <th>Estanteria</th>
                    <th>Review</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>
                            <img src="{{ $book->portada }}" alt="Portada de {{ $book->titulo }}" class="cover-img">
                        </td>
                        <td>{{ $book->titulo }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->avg_rating }}</td>
                        <td>{{ $book->user_rating }}</td>
                        <td>{{ $book->estado }}</td>
                        <td>{{ $book->review }}</td>
                        <td>{{ $book->date_added }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
