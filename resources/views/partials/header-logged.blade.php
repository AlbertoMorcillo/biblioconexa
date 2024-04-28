<header class="p-3 header">
    <div class="navbar">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"
        aria-label="Te lleva al inicio">
        <img src="{{ asset('images/corpo/logo.webp') }}" alt="Logo de nuestra biblioteca BiblioConexa" class="rounded-image">
      </a>

      <ul class="nav me-auto mb-2 justify-content-center mb-md-0" aria-label="Sección de menú con links de navegación.">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="serviciosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Servicios
            </a>
            <ul class="dropdown-menu" aria-labelledby="serviciosDropdown">
                <li><a class="dropdown-item" href="/tarjetaPersonal-logged">Tarjeta personal</a></li>
            </ul>
        </li>
        <a href="/actividades-logged" class="nav-link">Actividades</a>
        <a href="/noticias-logged" class="nav-link">Noticias</a>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="bibliotecaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sobre la biblioteca
            </a>
            <ul class="dropdown-menu" aria-labelledby="bibliotecaDropdown">
                <li><a class="dropdown-item" href="/sobreNosotros-logged">Sobre nosotros</a></li>
                <li><a class="dropdown-item" href="/horarioCalendario-logged">Horario/Calendario</a></li>
            </ul>
        </li>
        <a href="/catalogo-logged" class="nav-link">Catálogo</a>
        <a href="/mis-libros-logged" class="nav-link">Mis libros</a>
        <a href="/mis-prestamos-logged" class="nav-link">Mis préstamos</a>
    </ul>

      <div class="search-and-buttons">
        <form class="form-inline" role="search">
          <input type="search" class="form-control form-control-dark rounded-pill" placeholder="Buscar libro..."
            aria-label="Campo para buscar el libro que quieras.">
        </form>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" id="logout-button" class="btn button" aria-label="Botón para cerrar sesión">
              {{ __('Logout') }}
          </button>
      </form>
        <a href="/profile">
          <img src="/ruta-a-la-imagen-de-perfil" alt="Imagen de perfil" class="foto-perfil">
        </a>
      </div>
    </div>
  </header>