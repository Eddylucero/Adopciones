@extends('layout.app')

@section('content')
<section id="mascotas-section" class="ftco-section bg-light py-5">
    <div class="container">
        <section class="ftco-section bg-white py-5 rounded-3 shadow-sm">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10 text-center heading-section ftco-animate">
                        <h1 class="mb-3 fw-bold text-primary">Mascotas en Busca de Hogar</h1>
                        <p class="lead text-muted">Conoce a estos increíbles compañeros que esperan una familia llena de amor y cuidado</p>
                        <div class="separator mx-auto bg-warning"></div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse ($mascotas as $mascota)
                    <div class="col-lg-4 col-md-6 ftco-animate">
                        <div class="card border-0 shadow-hover h-100" style="transition: all 0.3s ease;">
                            <img src="{{ asset($mascota->foto) }}" 
                                 class="card-img-top" 
                                 style="height: 280px; object-fit: cover;" 
                                 alt="{{ $mascota->nombre }}">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $mascota->nombre }}</h5>
                                <p class="text-primary mb-2 fw-semibold">
                                    <i class="fas fa-paw me-2"></i>{{ $mascota->especie }} • {{ $mascota->raza ?? 'Mixto' }}
                                </p>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($mascota->descripcion, 90, '...') }}
                                </p>
                                
                                <div class="mt-auto pt-3">
                                    @if ($mascota->estado === 'Disponible')
                                        <a href="{{ route('adopvisi', $mascota->id) }}" 
                                           class="btn btn-outline-success rounded-pill w-100 py-2">
                                            <i class="fa fa-paw me-2"></i> Adoptar
                                        </a>
                                    @else
                                        <span class="badge bg-secondary rounded-pill w-100 py-2 text-center">
                                            Adoptado
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No hay mascotas disponibles</h4>
                            <p class="text-muted">Pronto tendremos nuevos amigos esperando por un hogar</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</section>

<section class="cta-section py-5 bg-gradient-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">¡Gracias por Cambiar Vidas!</h2>
                <p class="mb-4 opacity-90">Cada adopción marca la diferencia. Ayuda a estos compañeros de vida a encontrar su hogar para siempre.</p>
                <a href="{{ route('personas.nuevovisi') }}" 
                   class="btn btn-light btn-lg px-5 py-3 fw-bold text-primary rounded-pill">
                    <i class="fa fa-heart me-2"></i> Ver Mis Mascotas
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    
    .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
    }
    
    .separator {
        width: 80px;
        height: 4px;
        border-radius: 2px;
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .btn {
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .text-primary {
        color: #667eea !important;
    }
    
    .fw-semibold {
        font-weight: 600;
    }
    
    .lead {
        font-size: 1.2rem;
    }
</style>
@endsection