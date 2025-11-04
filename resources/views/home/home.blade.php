@extends('layout.app')

@section('content')

<!-- Hero principal -->
<section class="hero-wrap js-fullheight" style="background-image: url('{{ asset('pets/images/bg_2.jpg') }}'); background-size: cover;" data-stellar-background-ratio="0.5">
  <div class="overlay" style="background: rgba(0,0,0,0.5);"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
      <div class="col-md-10 text-center ftco-animate">
        <h1 class="mb-4 text-white fw-bold" style="font-size: 3rem;">¡Adopta amor, cambia una vida!</h1>
        <p class="mb-4 lead text-white" style="font-size: 1.2rem;">
          Cada mascota tiene una historia y un corazón esperando ser parte del tuyo 💕
        </p>
        <a href="{{ route('mascotas.index') }}" class="btn btn-primary btn-lg px-5 py-3 mt-3">
          <i class="fa fa-paw me-2"></i> Ver Mascotas Disponibles
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Sección: Sobre nosotros -->
<section class="ftco-section bg-light py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-4">Sobre Nuestro Refugio</h2>
        <p>Somos una organización dedicada a rescatar, cuidar y dar en adopción a mascotas que buscan un hogar lleno de amor y respeto.</p>
      </div>
    </div>

    <div class="row d-flex">
      <div class="col-md-4 ftco-animate">
        <div class="card shadow border-0 rounded-lg">
          <img src="{{ asset('pets/images/dog1.jpg') }}" class="card-img-top rounded-top" alt="Adopta un perro">
          <div class="card-body text-center">
            <h5 class="card-title">Adopta un amigo</h5>
            <p class="card-text">Cada peludo tiene una historia, ayúdanos a escribirle un nuevo comienzo.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 ftco-animate">
        <div class="card shadow border-0 rounded-lg">
          <img src="{{ asset('pets/images/cat1.jpg') }}" class="card-img-top rounded-top" alt="Cuida un gato">
          <div class="card-body text-center">
            <h5 class="card-title">Cuidado y protección</h5>
            <p class="card-text">Brindamos atención médica y cuidados mientras encuentran un hogar.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 ftco-animate">
        <div class="card shadow border-0 rounded-lg">
          <img src="{{ asset('pets/images/dog2.jpg') }}" class="card-img-top rounded-top" alt="Refugio de animales">
          <div class="card-body text-center">
            <h5 class="card-title">Un hogar temporal</h5>
            <p class="card-text">Nuestro refugio es un espacio seguro donde reciben cariño y esperanza.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección: Beneficios -->
<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url('{{ asset('pets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
  <div class="overlay" style="background: rgba(0,0,0,0.6);"></div>
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center text-white">
        <h2 class="mb-4">Nuestras Huellas</h2>
        <p>Gracias al apoyo de personas como tú, seguimos transformando vidas.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
          <div class="text">
            <strong class="number" data-number="120">0</strong>
            <span>Mascotas Rescatadas</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
          <div class="text">
            <strong class="number" data-number="85">0</strong>
            <span>Adopciones Felices</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
          <div class="text">
            <strong class="number" data-number="20">0</strong>
            <span>Voluntarios Activos</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección: Llamado a la acción -->
<section class="ftco-section contact-section py-5" style="background-color: #fef8f5;">
  <div class="container text-center">
    <h2 class="mb-4">¿Quieres ser parte del cambio?</h2>
    <p class="mb-4">Puedes adoptar, donar o unirte como voluntario. Cada acción cuenta para salvar más vidas.</p>
    <a href="{{ route('mascotas.create') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3">
      <i class="fa fa-heart me-2"></i> ¡Adopta Ahora!
    </a>
  </div>
</section>

@endsection
