@extends('layout.app')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #fff8f5;">
  <div class="container py-5">

    <div class="text-center mb-5">
      <h2 class="text-dark fw-bold">Tus Mascotas Adoptadas</h2>
      <p class="text-muted">Aquí puedes ver las mascotas que has adoptado y ahora forman parte de tu familia.</p>
    </div>

    @if($persona)
      <div class="alert alert-info text-center">
        <strong>Bienvenido, {{ $persona->nombre }} {{ $persona->apellido ?? '' }}</strong><br>
        <small>Correo: {{ $persona->correo }}</small>
      </div>
    @endif

    <div class="row">
      @forelse($mascotas as $mascota)
        <div class="col-md-4 mb-4 ftco-animate">
          <div class="card shadow-sm border-0 rounded-lg h-100 text-center" style="transition: transform 0.2s;">
            <img src="{{ asset($mascota->foto) }}" class="card-img-top rounded-top" style="height: 250px; object-fit: cover;" alt="{{ $mascota->nombre }}">
            <div class="card-body">
              <h5 class="card-title fw-bold">{{ $mascota->nombre }}</h5>
              <p class="text-muted">{{ $mascota->especie }} - {{ $mascota->raza ?? 'Sin raza' }}</p>
              <p><span class="badge bg-success">{{ $mascota->estado }}</span></p>
              <p class="small text-secondary">{{ Str::limit($mascota->descripcion, 80, '...') }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center mt-5">
          <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" width="120" alt="Sin mascotas">
          <h5 class="mt-3 text-muted">Aún no has adoptado ninguna mascota</h5>
          <a href="{{ route('home') }}" class="btn btn-outline-success mt-3 rounded-pill px-4">
            <i class="fa fa-paw"></i> Ver Mascotas Disponibles
          </a>
        </div>
      @endforelse
    </div>

  </div>
</section>

<style>
.card:hover {
  transform: scale(1.03);
}
</style>

@endsection
