<footer class="container-fluid">
  <div class="row">
    <!-- Contenedor de logo e información de contacto -->
    <div class="col-lg-3 mb-3 contenedor-logo-contacto">
      <a href="{{ route('admin.index') }}" class="text-white text-decoration-none">
        <img src="{{ asset('images/corpo/logo.webp') }}" alt="Logo de nuestra biblioteca BiblioConexa" class="rounded-image">
      </a>
      <div class="informacion-contacto" aria-label="Sección de contacto">
        <p>Dirección: Ejemplo Calle 123</p>
        <p>Email: BiblioConexa@gmail.com</p>
        <p>Teléfono: +34 123 456 789</p>
      </div>
    </div>
    <!-- Contenedor de secciones de enlaces -->
    <div class="col-lg-9 mb-3 secciones-enlaces" aria-label="Sección de enlaces">
      <div class="row">
        <!-- Secciones de enlaces individuales -->
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces de login y registro">
          <h5>Perfil</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('profile.edit') }}" class="nav-link p-0">Mi perfil</a></li>
          </ul>
        </div>
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces de noticias y actividades">
          <h5>Noticias y actividades</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.noticias') }}" class="nav-link p-0">Noticias</a></li>
            <li class="nav-item mb-2"><a href="{{ route('admin.actividades') }}" class="nav-link p-0">Actividades</a></li>
          </ul>
        </div>
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces de información sobre la biblioteca">
          <h5>Sobre la biblioteca</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.sobreNosotros') }}" class="nav-link p-0">Sobre nosotros</a></li>
            <li class="nav-item mb-2"><a href="{{ route('admin.horarioCalendario') }}" class="nav-link p-0">Horario/Calendario</a></li>
          </ul>
        </div>
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces de nuestro catálogo">
          <h5>Catálogo</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.catalogo') }}" class="nav-link p-0">Nuestro catálogo</a></li>
          </ul>
        </div>
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces de nuestros servicios">
          <h5>Servicios</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.tarjetaPersonal') }}" class="nav-link p-0">Tarjeta personal</a></li>
          </ul>
        </div>
        <div class="col-md-3 seccion-enlace" aria-label="Sección de enlaces sobre la gestion de tus libros y prestamos ">
          <h5>Tu gestión</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.misLibros') }}" class="nav-link p-0">Mis libros</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
