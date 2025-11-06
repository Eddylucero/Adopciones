@extends('layout.app')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #fff8f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-7 p-4 py-5 ftco-animate">
        <div class="bg-light p-5 rounded shadow" style="background-color: rgba(255,255,255,0.95); border-radius: 20px;">
          <h2 class="mb-4 text-center text-dark">
            <i class="fa-solid fa-paw text-warning me-2"></i> Solicitud de Adopción
          </h2>

          <p class="text-center text-muted mb-4">
            Estás solicitando la adopción de <b class="text-success">{{ $mascota->nombre }}</b>.
          </p>

          <form action="{{ route('adopciones.store') }}" id="FormAdopVisi" method="POST">
            @csrf
            <input type="hidden" name="origen" value="visitante">
            <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre completo:</b></label>
                  <input type="text" 
                         name="nombre" 
                         class="form-control rounded" 
                         placeholder="Tu nombre y apellido"
                         value="{{ $usuario ? $usuario->name : '' }}"
                         {{ $usuario ? 'readonly' : '' }}>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Correo electrónico:</b></label>
                  <input type="email" 
                         name="correo" 
                         class="form-control rounded" 
                         placeholder="usuario@correo.com"
                         value="{{ $usuario ? $usuario->email : '' }}"
                         {{ $usuario ? 'readonly' : '' }}>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Teléfono:</b></label>
                  <input type="text" name="telefono" class="form-control rounded" placeholder="Tu número de teléfono">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Motivo de adopción:</b></label>
                  <textarea name="motivo" class="form-control rounded" rows="4" placeholder="¿Por qué deseas adoptar esta mascota?"></textarea>
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-danger me-3 rounded-pill px-4">
                  <i class="fa fa-arrow-left"></i> Volver
                </a>
                <button type="submit" class="btn btn-outline-success rounded-pill px-4">
                  <i class="fa fa-paper-plane"></i> Enviar Solicitud
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function () {
  $("#FormAdopVisi").validate({
    rules: {
      nombre: { required: true, minlength: 3 },
      correo: { required: true, email: true },
      telefono: { required: true, digits: true, minlength: 7, maxlength: 15 },
      motivo: { required: true, minlength: 10 }
    },
    messages: {
      nombre: { required: "Ingrese su nombre completo", minlength: "Debe tener al menos 3 caracteres" },
      correo: { required: "Ingrese su correo", email: "Ingrese un correo válido" },
      telefono: { required: "Ingrese su teléfono", digits: "Solo números", minlength: "Mínimo 7 dígitos" },
      motivo: { required: "Explique por qué desea adoptar", minlength: "Debe tener al menos 10 caracteres" }
    }
  });
});
</script>

@endsection
