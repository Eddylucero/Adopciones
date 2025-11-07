@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">
          <h2 class="mb-4 text-center text-dark">Registrar Nueva Cirugía</h2>

          <form action="{{ route('cirugias.store') }}" id="FormCirugia" method="POST">
            @csrf
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Fecha de cirugía:</b></label>
                  <input type="date" name="fecha_cirugia" class="form-control rounded" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Duración (en horas o minutos):</b></label>
                  <input type="text" name="duracion" class="form-control rounded" placeholder="Ej: 2 horas o 45 minutos">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Mascota:</b></label>
                  <select name="mascota_id" class="form-control rounded" required>
                    <option value="" disabled selected>Seleccione una mascota</option>
                    @forelse($mascotas as $mascota)
                      <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                    @empty
                      <option value="" disabled>No hay mascotas disponibles</option>
                    @endforelse
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Motivo de la cirugía:</b></label>
                  <textarea name="motivo" class="form-control rounded" rows="4" placeholder="Explique brevemente el motivo de la cirugía"></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label><b>Estado:</b></label>
                  <select name="estado" class="form-control rounded" required>
                    <option value="Programada" selected>Programada</option>
                    <option value="Realizada">Realizada</option>
                    <option value="Cancelada">Cancelada</option>
                  </select>
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('cirugias.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Guardar Cirugía
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
  $.validator.addMethod("fechaMesActual", function (value, element) {
    if (!value) return false;
    const fecha = new Date(value);
    const hoy = new Date();
    const inicioMes = new Date(hoy.getFullYear(), hoy.getMonth(), 0);
    return fecha >= inicioMes && fecha <= hoy;
  }, "La fecha debe ser hoy o anterior, pero dentro del mes actual.");

  $.validator.setDefaults({ ignore: [] });

  $("#FormCirugia").validate({
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
