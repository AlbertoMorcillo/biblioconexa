<header class="p-3 header">
    <div class="navbar">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"
        aria-label="Te lleva al inicio">
        <img src="../assets/images/corpo/logo.webp" alt="Logo de nuestra biblioteca BiblioConexa" class="rounded-image">
      </a>

      <ul class="nav me-auto mb-2 justify-content-center mb-md-0" aria-label="Sección de menú con links de navegación.">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="serviciosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Servicios
            </a>
            <ul class="dropdown-menu" aria-labelledby="serviciosDropdown">
                <li><a class="dropdown-item" href="/prestamos">Préstamos</a></li>
                <li><a class="dropdown-item" href="/tarjetaPersonal">Tarjeta personal</a></li>
            </ul>
        </li>
        <a href="/verActividades" class="nav-link">Actividades</a>
        <a href="/verNoticias" class="nav-link">Noticias</a>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="bibliotecaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sobre la biblioteca
            </a>
            <ul class="dropdown-menu" aria-labelledby="bibliotecaDropdown">
                <li><a class="dropdown-item" href="/sobreNosotros">Sobre nosotros</a></li>
                <li><a class="dropdown-item" href="/horarioCalendario">Horario/Calendario</a></li>
            </ul>
        </li>
        <a href="/verCatalogo" class="nav-link">Catálogo</a>
    </ul>

      <div class="search-and-buttons">
        <form class="form-inline" role="search">
          <input type="search" class="form-control form-control-dark rounded-pill" placeholder="Buscar libro..."
            aria-label="Campo para buscar el libro que quieras.">
        </form>
        <button type="button" id="login-button" class="btn button" aria-label="Botón para ir a loguearse">Login</button>
        <button type="button" id="sign-up-button" class="btn secondary-button" aria-label="Botón para ir a registrarse">Sign-up</button>
      </div>
    </div>
  </header>