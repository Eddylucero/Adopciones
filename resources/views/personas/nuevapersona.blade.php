@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 16px;">
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning me-2"></span> Registrar Nueva Persona
          </h2>

          <form action="{{ route('personas.store') }}" id="FormPersona" method="post">
            @csrf
            <input type="hidden" name="origen" value="admin">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre:</b></label>
                  <input type="text" name="nombre" id="nombre" class="form-control rounded" placeholder="Nombre de la persona">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Apellido:</b></label>
                  <input type="text" name="apellido" id="apellido" class="form-control rounded" placeholder="Apellido">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Cédula:</b></label>
                  <input type="text" name="cedula" id="cedula" class="form-control rounded" placeholder="Cédula (10 dígitos)" maxlength="10">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Teléfono:</b></label>
                  <input type="text" name="telefono" id="telefono" class="form-control rounded" placeholder="Ejemplo: 0998765432" maxlength="10">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Dirección:</b></label>
                  <input type="text" name="direccion" id="direccion" class="form-control rounded" placeholder="Dirección (opcional)">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Correo:</b></label>
                  <input type="email" name="correo" id="correo" class="form-control rounded" placeholder="Correo electrónico (opcional)">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('personas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Guardar Persona
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
  .btn:hover {
    transform: scale(1.03);
  }
</style>

<script>
$.validator.addMethod("telefonoEcuador", function(value, element) {
  return this.optional(element) || /^09\d{8}$/.test(value);
}, "Ingrese un número válido que empiece con 09 y tenga 10 dígitos");

$.validator.setDefaults({ ignore: [] });

$("#FormPersona").validate({
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
      email: true
    },
    telefono: {
      required: true,
      telefonoEcuador: true
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
      email: "Ingrese un correo válido"
    },
    telefono: {
      required: "El teléfono es obligatorio",
      telefonoEcuador: "El número debe empezar con 09 y tener 10 dígitos"
    }
  }
});
</script>

@endsection
