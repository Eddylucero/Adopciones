@extends('layout.app')

@section('content')
<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #fff8f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-7 p-4 py-5 ftco-animate">
        <div class="bg-light p-5 rounded shadow" style="background-color: rgba(255,255,255,0.95); border-radius: 20px;">
          <h2 class="mb-4 text-center text-dark">Solicitud de Adopción</h2>

          <p class="text-center text-muted mb-4">
            Estás solicitando la adopción de <b class="text-success">{{ $mascota->nombre }}</b>.
          </p>

          <form action="{{ route('adopvisi.store', $mascota->id) }}" id="FormAdopVisi" method="POST">
            @csrf

            <div class="row g-3">
              <div class="col-md-6">
                <label><b>Nombre completo:</b></label>
                <input type="text" name="nombre" class="form-control rounded"
                       value="{{ $usuario ? $usuario->name : '' }}"
                       @if($usuario && $usuario->name) readonly @endif>
              </div>

              <div class="col-md-6">
                <label><b>Correo electrónico:</b></label>
                <input type="email" name="correo" class="form-control rounded"
                       value="{{ $usuario ? $usuario->email : '' }}"
                       @if($usuario && $usuario->email) readonly @endif>
              </div>

              <div class="col-md-6">
                <label><b>Cédula:</b></label>
                <input type="text" name="cedula" class="form-control rounded"
                       placeholder="Tu número de cédula"
                       value="{{ $persona && $persona->cedula ? $persona->cedula : '' }}"
                       @if($persona && $persona->cedula) readonly @endif>
              </div>

              <div class="col-md-6">
                <label><b>Teléfono:</b></label>
                <input type="text" name="telefono" class="form-control rounded"
                       placeholder="Tu número de teléfono"
                       value="{{ $persona && $persona->telefono ? $persona->telefono : '' }}"
                       @if($persona && $persona->telefono) readonly @endif>
              </div>

              <div class="col-md-12">
                <label><b>Motivo de adopción:</b></label>
                <textarea name="motivo" class="form-control rounded" rows="4"
                          placeholder="¿Por qué deseas adoptar esta mascota?"></textarea>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-danger me-3 rounded-pill px-4">
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
      cedula: { required: true, digits: true, minlength: 10, maxlength: 10 },
      telefono: { required: true, digits: true, minlength: 7, maxlength: 15 },
      motivo: { required: true, minlength: 10 }
    },
    messages: {
      nombre: { required: "Ingrese su nombre completo" },
      correo: { required: "Ingrese su correo" },
      cedula: { required: "Ingrese su cédula" },
      telefono: { required: "Ingrese su teléfono" },
      motivo: { required: "Explique por qué desea adoptar" }
    }
  });
});
</script>
@endsection
