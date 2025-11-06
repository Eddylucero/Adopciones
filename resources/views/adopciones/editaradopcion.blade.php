@extends('layout.admin')

@section('content')
<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">
          <h2 class="mb-4 text-center text-dark">Editar Adopción</h2>

          <form action="{{ route('adopciones.update', $adopcion->id) }}" id="FormAdopcionEdit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

              <div class="col-md-6">
                <label><b>Fecha de adopción:</b></label>
                <input type="date" name="fecha_adopcion" class="form-control rounded" value="{{ $adopcion->fecha_adopcion }}" required>
              </div>

              <div class="col-md-6">
                <label><b>Lugar de adopción:</b></label>
                <input type="text" name="lugar_adopcion" class="form-control rounded" value="{{ $adopcion->lugar_adopcion }}" required>
              </div>

              <div class="col-md-6">
                <label><b>Mascota:</b></label>
                <select name="mascota_id" class="form-control rounded" required>
                  @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->id }}" {{ $adopcion->mascota_id == $mascota->id ? 'selected' : '' }}>
                      {{ $mascota->nombre }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label><b>Persona:</b></label>
                <select name="persona_id" class="form-control rounded" required>
                  @foreach($personas as $persona)
                    <option value="{{ $persona->id }}" {{ $adopcion->persona_id == $persona->id ? 'selected' : '' }}>
                      {{ $persona->nombre }} {{ $persona->apellido }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12">
                <label><b>Observaciones:</b></label>
                <textarea name="observaciones" class="form-control rounded" rows="4">{{ $adopcion->observaciones }}</textarea>
              </div>

              <div class="col-md-12 mt-3">
                <label><b>Contrato:</b></label>
                <input id="contrato" type="file" name="contrato" class="form-control rounded mt-2" accept="application/pdf">
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('adopciones.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-primary rounded">
                  <i class="fa fa-save"></i> Actualizar
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Scripts --}}
<script>
$(document).ready(function () {
  // Inicializar fileinput con vista previa del contrato actual
  $("#contrato").fileinput({
    language: "es",
    allowedFileExtensions: ["pdf"],
    showCaption: false,
    dropZoneEnabled: true,
    showClose: false,
    @if($adopcion->contrato)
    initialPreview: [
      "{{ asset('storage/'.$adopcion->contrato) }}"
    ],
    initialPreviewAsData: true,
    initialPreviewFileType: 'pdf',
    initialPreviewConfig: [
      { 
        type: "pdf", 
        caption: "Contrato actual", 
        downloadUrl: "{{ asset('storage/'.$adopcion->contrato) }}", 
        key: 1 
      }
    ],
    overwriteInitial: true,
    @endif
    theme: "fa5"
  });

  // Validación personalizada para fecha
  $.validator.addMethod("fechaPasada", function (value, element) {
    if (!value) return false;
    const hoy = new Date().toISOString().split('T')[0];
    return value <= hoy;
  }, "La fecha no puede ser futura.");

  $.validator.setDefaults({ ignore: [] });

  // Validar formulario
  $("#FormAdopcionEdit").validate({
    rules: {
      fecha_adopcion: {
        required: true,
        fechaPasada: true
      },
      mascota_id: { required: true },
      persona_id: { required: true },
      lugar_adopcion: { required: true },
      contrato: { extension: "pdf" }
    },
    messages: {
      fecha_adopcion: {
        required: "Seleccione la fecha de adopción",
        fechaPasada: "La fecha no puede ser posterior a hoy"
      },
      mascota_id: { required: "Seleccione una mascota" },
      persona_id: { required: "Seleccione una persona" },
      lugar_adopcion: { required: "Ingrese el lugar de adopción" },
      contrato: { extension: "Solo se permiten archivos PDF" }
    },
    errorElement: "span",
    errorClass: "text-danger",
    highlight: function(element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function(element) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>

@endsection
