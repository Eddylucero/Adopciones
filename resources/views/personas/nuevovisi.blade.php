@extends('layout.app')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #fff8f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-7 p-4 py-5 ftco-animate">
        <div class="bg-light p-5 rounded shadow" style="background-color: rgba(255,255,255,0.95); border-radius: 20px;">
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning me-2"></span> Registro de Visitante
          </h2>
          <p class="text-center text-muted mb-4">Completa el siguiente formulario para unirte a nuestra comunidad y poder adoptar o apoyar a nuestros peludos</p>

          <form action="{{ route('personas.store') }}" id="FormVisitante" method="post">
            @csrf

            <input type="hidden" name="origen" value="visitante">
            <div class="row g-3">

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre:</b></label>
                  <input type="text" name="nombre" id="nombre" class="form-control rounded" placeholder="Tu nombre">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Apellido:</b></label>
                  <input type="text" name="apellido" id="apellido" class="form-control rounded" placeholder="Tu apellido">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Cédula:</b></label>
                  <input type="text" name="cedula" id="cedula" class="form-control rounded" placeholder="Tu cédula (10 dígitos)" maxlength="10">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Teléfono:</b></label>
                  <input type="text" name="telefono" id="telefono" class="form-control rounded" placeholder="Tu número de teléfono (opcional)">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Correo electrónico:</b></label>
                  <input type="email" name="correo" id="correo" class="form-control rounded" placeholder="Correo electrónico válido">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Dirección:</b></label>
                  <input type="text" name="direccion" id="direccion" class="form-control rounded" placeholder="Dirección completa (opcional)">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-danger me-3 rounded-pill px-4">
                  <i class="fa fa-arrow-left"></i> Volver
                </a>
                <button type="submit" class="btn btn-outline-success rounded-pill px-4">
                  <i class="fa fa-save"></i> Registrar
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .btn:hover { transform: scale(1.03); }
</style>

<script>
$.validator.setDefaults({ ignore: [] });

$("#FormVisitante").validate({
  rules: {
    nombre: {
      required: true,
      minlength: 2,
      maxlength: 100,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    },
    apellido: {
      required: true,
      minlength: 2,
      maxlength: 100,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    },
    cedula: {
      required: true,
      digits: true,
      minlength: 10,
      maxlength: 10
    },
    correo: {
      required: true,
      email: true
    },
    telefono: {
      maxlength: 20
    }
  },
  messages: {
    nombre: {
      required: "El nombre es obligatorio",
      minlength: "Debe tener al menos 2 caracteres",
      maxlength: "Máximo 100 caracteres",
      pattern: "Solo se permiten letras y espacios"
    },
    apellido: {
      required: "El apellido es obligatorio",
      minlength: "Debe tener al menos 2 caracteres",
      maxlength: "Máximo 100 caracteres",
      pattern: "Solo se permiten letras y espacios"
    },
    cedula: {
      required: "La cédula es obligatoria",
      digits: "Solo se permiten números",
      minlength: "Debe tener exactamente 10 dígitos",
      maxlength: "Debe tener exactamente 10 dígitos"
    },
    correo: {
      required: "El correo es obligatorio",
      email: "Ingrese un correo válido"
    },
    telefono: {
      maxlength: "Máximo 20 caracteres"
    }
  }
});
</script>

@endsection
