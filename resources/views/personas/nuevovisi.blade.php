@extends('layout.app')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="container py-5">

    <div class="text-center mb-5">
      <h1 class="fw-bold text-primary mb-3">Tus Compañeros de Vida</h1>
      <p class="text-muted fs-5">Las mascotas que han encontrado un hogar lleno de amor contigo</p>
    </div>

    @if($persona)
      <div class="alert alert-primary text-center rounded-3 border-0 shadow-sm">
        <h5 class="fw-bold mb-2">¡Hola, {{ $persona->nombre }} {{ $persona->apellido ?? '' }}!</h5>
        <p class="mb-0 text-dark">Correo: {{ $persona->correo }}</p>
      </div>
    @endif

    <div class="row g-4">
      @forelse($mascotas as $mascota)
        <div class="col-lg-4 col-md-6">
          <div class="card border-0 shadow-hover h-100 rounded-3" style="transition: all 0.3s ease;">
            <img src="{{ asset($mascota->foto) }}" class="card-img-top rounded-top" style="height: 280px; object-fit: cover;" alt="{{ $mascota->nombre }}">
            <div class="card-body d-flex flex-column text-center">
              <h4 class="card-title fw-bold text-dark mb-2">{{ $mascota->nombre }}</h4>
              <p class="text-primary fw-semibold mb-2">
                <i class="fas fa-paw me-2"></i>{{ $mascota->especie }} • {{ $mascota->raza ?? 'Mixto' }}
              </p>
              <p class="card-text text-muted flex-grow-1">
                {{ Str::limit($mascota->descripcion, 100, '...') }}
              </p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <div class="empty-state">
            <i class="fas fa-heart fa-3x text-muted mb-4"></i>
            <h4 class="text-muted mb-3">Aún no tienes mascotas adoptadas</h4>
            <p class="text-muted mb-4">Descubre a tu próximo compañero de vida</p>
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3">
              <i class="fas fa-paw me-2"></i>Ver Mascotas Disponibles
            </a>
          </div>
        </div>
      @endforelse
    </div>

  </div>
</section>

<style>
.min-vh-100 {
  min-height: 100vh;
}

.shadow-hover:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
}

.bg-light {
  background-color: #f8f9fa !important;
}

.text-primary {
  color: #667eea !important;
}

.fw-semibold {
  font-weight: 600;
}

.empty-state {
  padding: 3rem 1rem;
}

.btn {
  border-radius: 50px;
  transition: all 0.3s ease;
  font-weight: 600;
}

.card {
  border-radius: 15px;
}
</style>

@endsection