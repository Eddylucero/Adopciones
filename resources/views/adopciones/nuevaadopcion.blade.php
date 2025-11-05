@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">
          <h2 class="mb-4 text-center text-dark">Registrar Nueva Adopción</h2>

          <form action="{{ route('adopciones.store') }}" id="FormAdopcion" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Fecha de adopción:</b></label>
                  <input type="date" name="fecha_adopcion" class="form-control rounded" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Lugar de adopción:</b></label>
                  <input type="text" name="lugar_adopcion" class="form-control rounded" placeholder="Lugar" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Mascota:</b></label>
                  <select name="mascota_id" class="form-control rounded" required>
                    <option value="" disabled selected>Seleccione una mascota</option>
                    @foreach($mascotas as $mascota)
                      <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Persona:</b></label>
                  <select name="persona_id" class="form-control rounded" required>
                    <option value="" disabled selected>Seleccione una persona</option>
                    @foreach($personas as $persona)
                      <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->apellido }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Observaciones:</b></label>
                  <textarea name="observaciones" class="form-control rounded" rows="4"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="contrato "><b>Contrato (PDF):</b></label>
                  <input type="file" id="contrato" name="contrato" class="form-control rounded">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('adopciones.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Guardar Adopción
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
$(document).ready(function () {
$("#contrato").fileinput({
  language: "es",
  allowedFileExtensions: ["pdf"],
  showCaption: false,
  dropZoneEnabled: true,
  showClose: false
});

  $.validator.addMethod("fechaPasada", function (value, element) {
    if (!value) return false;
    const hoy = new Date().toISOString().split('T')[0];
    return value <= hoy;
  }, "La fecha no puede ser futura.");


  $.validator.setDefaults({ ignore: [] });

  $("#FormAdopcion").validate({
    rules: {
      fecha_adopcion: { required: true, date: true, fechaPasada: true } ,
      mascota_id: { required: true },
      persona_id: { required: true },
      lugar_adopcion: { required: true, minlength: 3 },
      contrato: { extension: "pdf" }
    },
    messages: {
      
      fecha_adopcion: { required: "Seleccione la fecha de adopción", date: "Ingrese una fecha válida" ,fechaPasada: "La fecha no puede ser posterior a hoy",},
      mascota_id: { required: "Seleccione una mascota" },
      persona_id: { required: "Seleccione una persona" },
      lugar_adopcion: { required: "Ingrese el lugar de adopción", minlength: "Mínimo 3 caracteres" },
      contrato: { extension: "Solo se permiten archivos PDF" }
    }
  });
});
</script>

@endsection
