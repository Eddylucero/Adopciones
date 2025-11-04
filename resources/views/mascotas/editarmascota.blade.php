@extends('layout.app')

@section('content')

<section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img" style="background-image: url('{{ asset('pets/images/bg_3.jpg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row d-md-flex justify-content-end">
      <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(6px); border-radius: 16px;">
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning mr-2"></span> Editar Mascota
          </h2>

          <form action="{{ route('mascotas.update', $mascota->id) }}" id="FormMascotaEdit" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Nombre:</b></label>
                  <input type="text" name="nombre" id="nombre" class="form-control rounded"
                         value="{{ old('nombre', $mascota->nombre) }}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Especie:</b></label>
                  <select name="especie" id="especie" class="form-control rounded" required>
                    <option value="" disabled>Seleccione especie</option>
                    <option value="Perro" {{ $mascota->especie == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ $mascota->especie == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ $mascota->especie == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ $mascota->especie == 'Otro' ? 'selected' : '' }}>Otro</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Raza:</b></label>
                  <input type="text" name="raza" id="raza" class="form-control rounded"
                         value="{{ old('raza', $mascota->raza) }}" placeholder="Raza (opcional)">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Edad (años):</b></label>
                  <input type="number" name="edad" id="edad" class="form-control rounded"
                         value="{{ old('edad', $mascota->edad) }}" placeholder="Edad (años)">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Sexo:</b></label>
                  <select name="sexo" id="sexo" class="form-control rounded">
                    <option value="" disabled>Sexo</option>
                    <option value="Macho" {{ $mascota->sexo == 'Macho' ? 'selected' : '' }}>Macho</option>
                    <option value="Hembra" {{ $mascota->sexo == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Estado:</b></label>
                  <select name="estado" id="estado" class="form-control rounded">
                    <option value="Disponible" {{ $mascota->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Adoptado" {{ $mascota->estado == 'Adoptado' ? 'selected' : '' }}>Adoptado</option>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Descripción:</b></label>
                  <textarea name="descripcion" id="descripcion" class="form-control rounded" rows="4">{{ old('descripcion', $mascota->descripcion) }}</textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group text-center">
                  <label class="fw-bold">Foto actual:</label><br>
                  @if ($mascota->foto)
                    <img src="{{ asset($mascota->foto) }}" width="120" height="120" class="rounded mb-3" style="object-fit: cover;">
                  @else
                    <p class="text-muted">No hay foto disponible</p>
                  @endif

                  <input type="file" name="foto" id="foto" class="form-control rounded">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('mascotas.index') }}" class="btn btn-outline-danger me-3 rounded-pill">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-primary rounded-pill">
                  <i class="fa fa-save"></i> Actualizar Mascota
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
</script>

<script>
$.validator.setDefaults({ ignore: [] });

$("#FormMascotaEdit").validate({
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
    edad: { number: true, min: 0, max: 10 },
    foto: { extension: "jpg|jpeg|png|gif" }
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
      max: "La edad máxima permitida es 10 años"
    },
    foto: {
      extension: "Formato permitido: jpg, jpeg, png o gif"
    }
  }
});
</script>

<script>
$("#especie").rules("add", {
  required: true,
  messages: {
    required: "Selecciona una especie antes de enviar"
  }
});
</script>

@endsection
