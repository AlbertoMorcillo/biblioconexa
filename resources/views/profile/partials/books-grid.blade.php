@if($books->isEmpty())
    <p>No hay libros en esta categoría.</p>
@else
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th class="sortable" data-sort="titulo">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'titulo', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Título
                            @if($sortBy === 'titulo')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th class="sortable" data-sort="author">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'author', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Autor
                            @if($sortBy === 'author')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th class="sortable" data-sort="avg_rating">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'avg_rating', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Puntuación Media
                            @if($sortBy === 'avg_rating')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th class="sortable" data-sort="user_rating">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'user_rating', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Tu puntuación
                            @if($sortBy === 'user_rating')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th>Estantería</th>
                    <th class="sortable" data-sort="review">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'review', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Review
                            @if($sortBy === 'review')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th class="sortable" data-sort="date_added">
                        <a href="{{ route('estanteriasLibros.index', ['sortBy' => 'date_added', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Fecha
                            @if($sortBy === 'date_added')
                                <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
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

        @if ($books->lastPage() > 1)
            <nav aria-label="Página de navegación">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->url(1) }}">Primera</a>
                    </li>
                    <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @foreach ($books->getUrlRange(max($books->currentPage() - 2, 1), min($books->currentPage() + 2, $books->lastPage())) as $i => $url)
                        <li class="page-item {{ $books->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $i }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $books->currentPage() == $books->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $books->currentPage() == $books->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->url($books->lastPage()) }}">Última</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
@endif
