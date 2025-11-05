@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 16px;">
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning me-2"></span> Editar Persona
          </h2>

          <form action="{{ route('personas.update', $persona->id) }}" id="FormPersonaEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre:</b></label>
                  <input type="text" name="nombre" class="form-control rounded"
                         value="{{ old('nombre', $persona->nombre) }}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Apellido:</b></label>
                  <input type="text" name="apellido" class="form-control rounded"
                         value="{{ old('apellido', $persona->apellido) }}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Cédula:</b></label>
                  <input type="text" name="cedula" class="form-control rounded"
                         value="{{ old('cedula', $persona->cedula) }}" maxlength="10" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Teléfono:</b></label>
                  <input type="text" name="telefono" class="form-control rounded"
                         value="{{ old('telefono', $persona->telefono) }}" placeholder="Ej: 0999999999">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Dirección:</b></label>
                  <input type="text" name="direccion" class="form-control rounded"
                         value="{{ old('direccion', $persona->direccion) }}" placeholder="Dirección actual">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Correo electrónico:</b></label>
                  <input type="email" name="correo" class="form-control rounded"
                         value="{{ old('correo', $persona->correo) }}" placeholder="correo@ejemplo.com">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('personas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-primary rounded">
                  <i class="fa fa-save"></i> Actualizar Persona
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
$.validator.setDefaults({ ignore: [] });

$("#FormPersonaEdit").validate({
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
      minlength: 10,
      maxlength: 10,
      digits: true
    },
    correo: {
      email: true
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
      minlength: "Debe tener 10 dígitos",
      maxlength: "Debe tener 10 dígitos",
      digits: "Solo se permiten números"
    },
    correo: {
      email: "Ingrese un correo electrónico válido"
    }
  }
});
</script>

@endsection
