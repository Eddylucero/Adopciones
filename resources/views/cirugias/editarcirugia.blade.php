@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">
          <h2 class="mb-4 text-center text-dark">Editar Cirugía</h2>

          <form action="{{ route('cirugias.update', $cirugia->id) }}" id="FormCirugiaEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <label><b>Fecha de cirugía:</b></label>
                <input type="date" name="fecha_cirugia" class="form-control rounded" value="{{ $cirugia->fecha_cirugia }}" required>
              </div>

              <div class="col-md-6">
                <label><b>Duración:</b></label>
                <input type="text" name="duracion" class="form-control rounded" value="{{ $cirugia->duracion }}" placeholder="Ej: 2 horas, 45 minutos">
              </div>

              <div class="col-md-12 mt-3">
                <label><b>Mascota:</b></label>
                <select name="mascota_id" class="form-control rounded" required>
                  @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->id }}" {{ $cirugia->mascota_id == $mascota->id ? 'selected' : '' }}>
                      {{ $mascota->nombre }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mt-3">
                <label><b>Motivo de la cirugía:</b></label>
                <textarea name="motivo" class="form-control rounded" rows="4" placeholder="Motivo de la cirugía">{{ $cirugia->motivo }}</textarea>
              </div>

              <div class="col-md-6 mt-3">
                <label><b>Estado:</b></label>
                <select name="estado" class="form-control rounded" required>
                  <option value="Programada" {{ $cirugia->estado === 'Programada' ? 'selected' : '' }}>Programada</option>
                  <option value="Realizada" {{ $cirugia->estado === 'Realizada' ? 'selected' : '' }}>Realizada</option>
                  <option value="Cancelada" {{ $cirugia->estado === 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('cirugias.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-primary rounded">
                  <i class="fa fa-save"></i> Actualizar Cirugía
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
  $.validator.addMethod("fechaMesActual", function (value, element) {
    if (!value) return false;
    const fecha = new Date(value);
    const hoy = new Date();
    const inicioMes = new Date(hoy.getFullYear(), hoy.getMonth(), 0);
    return fecha >= inicioMes && fecha <= hoy;
  }, "La fecha debe ser hoy o anterior, pero dentro del mes actual.");

  $.validator.setDefaults({ ignore: [] });

  $("#FormCirugiaEdit").validate({
    rules: {
      fecha_cirugia: { required: true, date: true, fechaMesActual: true },
      mascota_id: { required: true },
      duracion: { maxlength: 50 },
      motivo: { required: true, minlength: 10, maxlength: 1000 },
      estado: { required: true }
    },
    messages: {
      fecha_cirugia: { 
        required: "Seleccione la fecha de la cirugía", 
        date: "Ingrese una fecha válida", 
        fechaMesActual: "La fecha debe ser hoy o anterior, pero dentro del mes actual" 
      },
      mascota_id: { required: "Seleccione una mascota" },
      duracion: { maxlength: "Máximo 50 caracteres" },
      motivo: { 
        required: "Ingrese el motivo de la cirugía", 
        minlength: "Debe tener al menos 10 caracteres", 
        maxlength: "Máximo 1000 caracteres" 
      },
      estado: { required: "Seleccione un estado" }
    }
  });
});
</script>

@endsection
