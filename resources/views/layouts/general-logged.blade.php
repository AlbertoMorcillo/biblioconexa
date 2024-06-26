<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script defer src="{{ asset('js/searchBooks.js') }}"></script>
  <script defer src="{{ asset('js/circuloDeCarga.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('build/assets/style.css') }}">
  @yield('extra-css') <!-- Para CSS adicional específico de algunas páginas -->
  @yield('extra-js') <!-- Para JS adicional específico de algunas páginas -->
  <title>@yield('title')</title>
</head>
<body>

  <div id="loading-overlay" class="loading-overlay" style="display: none;">
    <div class="loader"></div>
</div>

@include('partials.header-logged') <!-- Incluyo el header desde otro archivo Blade -->

<main class="content">
  @yield('content') <!-- El contenido específico de cada página -->
</main>
@include('partials.footer-logged') <!-- Incluyo el footer desde otro archivo Blade -->

</body>
</html>
