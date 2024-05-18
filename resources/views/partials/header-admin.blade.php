<header class="p-3 header">
    <div class="navbar">
        <a href="{{ route('admin.index') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none" aria-label="Te lleva al inicio del panel de administración">
            <img src="{{ asset('images/corpo/logo.webp') }}" alt="Logo de nuestra biblioteca BiblioConexa" class="rounded-image">
        </a>

        <ul class="nav me-auto mb-2 justify-content-center mb-md-0" aria-label="Sección de menú con links de navegación.">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="serviciosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Servicios
                </a>
                <ul class="dropdown-menu" aria-labelledby="serviciosDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.tarjetaPersonal') }}">Tarjeta personal</a></li>
                </ul>
            </li>
            <a href="{{ route('admin.actividades') }}" class="nav-link">Actividades</a>
            <a href="{{ route('admin.noticias.index') }}" class="nav-link">Noticias</a>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="bibliotecaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sobre la biblioteca
                </a>
                <ul class="dropdown-menu" aria-labelledby="bibliotecaDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.sobreNosotros') }}">Sobre nosotros</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.horarioCalendario') }}">Horario/Calendario</a></li>
                </ul>
            </li>
            <a href="{{ route('admin.catalogo') }}" class="nav-link">Catálogo</a>
            <a href="{{ route('admin.mis-libros') }}" class="nav-link">Mis libros</a>
        </ul>

        <form class="form-inline" role="search" action="{{ route('search-books') }}" method="GET">
            <input type="search" name="q" id="book-search" class="form-control form-control-dark rounded-pill" placeholder="Buscar libro..." aria-label="Campo para buscar el libro que quieras." autocomplete="off">
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" id="logout-button" class="btn button" aria-label="Botón para cerrar sesión">
                {{ __('Logout') }}
            </button>
        </form>
        <a href="{{ route('profile.edit') }}">
            <img src="{{ asset('images/perfil/empathy.jpg') }}" alt="Imagen de perfil" class="foto-perfil">
        </a>
    </div>
</header>
