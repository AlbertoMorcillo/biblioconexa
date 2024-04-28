@extends('layouts.general-logged')

@section('title', 'Horario y calendario')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->

@endsection

@section('extra-js')
@endsection

@section('content')
<section aria-label="Sección informativa Sobre nosotros">
    <h1 class="section-title">Horario y calendario</h1>
    <h2 class="section-subtitle">Horario</h2>
    <p class="section-text"> 
        Lunes a Viernes: 9:00 a 18:00 <br>
        Sábados: 10:00 a 14:00 <br>
        Domingos y festivos: Cerrado
    </p>
    <h2 class="section-subtitle">Calendario</h2>
    <p class="section-text"> 
        Enero: Cerrado <br>
        Febrero: 1 a 15 <br>
        Marzo: 1 a 31 <br>
        Abril: 1 a 30 <br>
        Mayo: 1 a 31 <br>
        Junio: 1 a 30 <br>
        Julio: 1 a 31 <br>
        Agosto: Cerrado <br>
        Septiembre: 1 a 30 <br>
        Octubre: 1 a 31 <br>
        Noviembre: 1 a 30 <br>
        Diciembre: 1 a 31
    </p>
</section>
@endsection