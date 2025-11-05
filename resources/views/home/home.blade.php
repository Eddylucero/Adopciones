@extends('layout.app')

@section('content')
<section id="mascotas-section" class="ftco-section bg-white py-5">
  <div class="container">
    <section class="ftco-section bg-white py-5">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-8 text-center heading-section ftco-animate">
            <h2 class="mb-4" style="font-weight: 600;">Mascotas Disponibles para Adopción</h2>
            <p style="font-size: 18px; color: #666;">Conoce algunos de los peludos que esperan un hogar lleno de amor ❤️</p>
          </div>
        </div>

        <div class="row">
          @forelse ($mascotas as $mascota)
            <div class="col-md-4 mb-4 ftco-animate">
              <div class="card shadow-sm border-0 rounded-lg h-100" style="transition: transform 0.2s;">
                <img src="{{ asset($mascota->foto) }}" class="card-img-top rounded-top" style="height: 250px; object-fit: cover;" alt="{{ $mascota->nombre }}">
                <div class="card-body text-center">
                  <h5 class="card-title" style="font-weight: 600;">{{ $mascota->nombre }}</h5>
                  <p class="text-muted mb-1">{{ $mascota->especie }} - {{ $mascota->raza ?? 'Sin raza' }}</p>
                  <p class="small" style="color: #777;">{{ Str::limit($mascota->descripcion, 70, '...') }}</p>
                  <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-outline-success btn-sm rounded-pill mt-2" style="transition: all 0.2s;">
                    Ver Detalles
                  </a>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center">
              <p class="text-muted">No hay mascotas disponibles en este momento 🐶🐱</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>
  </div>
</section>
<section class="ftco-section contact-section py-5" style="background-color: #fef8f5;">
  <div class="container text-center">
    <h2 class="mb-4" style="font-weight: 600;">¿Quieres ser parte del cambio?</h2>
    <p class="mb-4" style="font-size: 18px; color: #555;">Puedes adoptar, donar o unirte como voluntario. Cada acción cuenta para salvar más vidas.</p>
    <a href="{{ route('adopciones.index') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3" style="transition: all 0.2s;">
      <i class="fa fa-heart me-2"></i> ¡Adopta Ahora!
    </a>
  </div>
</section>

<style>
  .card:hover {
    transform: scale(1.02);
  }
  .btn:hover {
    transform: scale(1.05);
  }
</style>

@endsection
