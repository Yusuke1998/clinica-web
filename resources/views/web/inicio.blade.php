@extends('layouts.website')
@section('content')
<section id="intro" class="intro">
    <div class="intro-content">
        <carrusel-component></carrusel-component>
    </div>      
</section>
<section id="servicios" class="home-section nopadding paddingtop-60">
    <peqservicios-component></peqservicios-component>
</section>
<section id="noticias-eventos" class="home-section nopadding paddingtop-60">
    <div class="container">
        <div class="row">
            <peqnoticias-component></peqnoticias-component>
            <peqeventos-component></peqeventos-component>
        </div>
    </div>
</section>
@stop