@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 16px;">
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning mr-2"></span> Registrar Nueva Mascota
          </h2>

          <form action="{{ route('mascotas.store') }}" id="FormMascota" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre:</b></label>
                  <input type="text" name="nombre" id="nombre" class="form-control rounded" placeholder="Nombre de la mascota" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Especie:</b></label>
                  <select name="especie" id="especie" class="form-control rounded" required>
                    <option value="" selected disabled>Seleccione especie</option>
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Raza:</b></label>
                  <input type="text" name="raza" id="raza" class="form-control rounded" placeholder="Raza (opcional)">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Edad (años):</b></label>
                  <input type="number" name="edad" id="edad" class="form-control rounded" placeholder="Edad (años)">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Sexo:</b></label>
                  <select name="sexo" id="sexo" class="form-control rounded">
                    <option value="" selected disabled>Sexo</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Estado:</b></label>
                  <select class="form-control rounded bg-light text-muted" disabled>
                    <option selected>Disponible</option>
                  </select>
                  <input type="hidden" name="estado" value="Disponible">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Descripción:</b></label>
                  <textarea name="descripcion" id="descripcion" class="form-control rounded" rows="4" placeholder="Descripción de la mascota..."></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="foto" class="form-label fw-bold">Foto de la mascota:</label>
                  <input type="file" name="foto" id="foto" class="form-control rounded">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('mascotas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Guardar Mascota
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
$("#foto").fileinput({
  language: "es",
  allowedFileExtensions: ["png", "jpg", "jpeg"],
  showCaption: false,
  dropZoneEnabled: true,
  showClose: false
});

$.validator.setDefaults({ ignore: [] });

$("#FormMascota").validate({
  rules: {
    nombre: {
      required: true,
      minlength: 2,
      maxlength: 100,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    },
    especie: { required: true },
    estado: { required: true },
    sexo: { required: true },
    edad: { number: true, min: 1, max: 10, required: true },
    foto: { required: true, extension: "jpg|jpeg|png|gif" }
  },
  messages: {
    nombre: {
      required: "El nombre de la mascota es requerido",
      minlength: "Debe tener al menos 2 caracteres",
      maxlength: "Máximo 100 caracteres",
      pattern: "Solo se permiten letras y espacios"
    },
    especie: { required: "Debe seleccionar una especie" },
    estado: { required: "Debe seleccionar un estado" },
    sexo: { required: "Debe seleccionar un sexo" },
    edad: {
      number: "Ingrese un valor numérico válido",
      min: "La edad no puede ser negativa",
      max: "La edad máxima permitida es 10 años",
      required: "La edad es obligatoria"
    },
    foto: {
      required: "Debe subir una imagen de la mascota",
      extension: "Formato permitido: jpg, jpeg, png o gif"
    }
  }
});

$("#especie").rules("add", {
  required: true,
  messages: {
    required: "Selecciona una especie antes de enviar"
  }
});
</script>

@endsection
