@extends('layout.admin')

@section('content')
<div class="container py-4">
  <h2 class="text-center mb-4 fw-bold">Dashboard de Administración</h2>

  <div class="row text-center mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm border-0 bg-success text-white rounded-4">
        <div class="card-body">
          <h6>Total Mascotas</h6>
          <h2>{{ $totalMascotas }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0 bg-info text-white rounded-4">
        <div class="card-body">
          <h6>Total Adopciones</h6>
          <h2>{{ $totalAdopciones }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0 bg-success-subtle text-success rounded-4 border border-success">
        <div class="card-body">
          <h6>Aprobadas</h6>
          <h2>{{ $adopcionesAprobadas }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0 bg-danger-subtle text-danger rounded-4 border border-danger">
        <div class="card-body">
          <h6>Rechazadas</h6>
          <h2>{{ $adopcionesRechazadas }}</h2>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white text-center border-bottom">
          <h5 class="mb-0 text-dark fw-bold">Especies Más Adoptadas</h5>
        </div>
        <div class="card-body">
          <canvas id="graficaEspecies"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white text-center border-bottom">
          <h5 class="mb-0 text-dark fw-bold">Adopciones por Mes</h5>
        </div>
        <div class="card-body">
          <canvas id="graficaMeses"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white text-center border-bottom">
          <h5 class="mb-0 text-dark fw-bold">Aprobadas vs Rechazadas</h5>
        </div>
        <div class="card-body">
          <canvas id="graficaEstado"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxEspecies = document.getElementById('graficaEspecies').getContext('2d');
new Chart(ctxEspecies, {
  type: 'pie',
  data: {
    labels: {!! json_encode($especies->keys()) !!},
    datasets: [{
      label: 'Cantidad',
      data: {!! json_encode($especies->values()) !!},
      backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF']
    }]
  },
  options: {
    plugins: { legend: { position: 'bottom' } }
  }
});

const ctxMeses = document.getElementById('graficaMeses').getContext('2d');
new Chart(ctxMeses, {
  type: 'bar',
  data: {
    labels: {!! json_encode($labelsMeses) !!},
    datasets: [{
      label: 'Adopciones',
      data: {!! json_encode($valoresMeses) !!},
      backgroundColor: '#36A2EB'
    }]
  },
  options: {
    scales: { y: { beginAtZero: true } },
    plugins: { legend: { display: false } }
  }
});

const ctxEstado = document.getElementById('graficaEstado').getContext('2d');
new Chart(ctxEstado, {
  type: 'doughnut',
  data: {
    labels: ['Aprobadas', 'Rechazadas'],
    datasets: [{
      data: [{{ $adopcionesAprobadas }}, {{ $adopcionesRechazadas }}],
      backgroundColor: ['#198754', '#dc3545']
    }]
  },
  options: {
    plugins: { legend: { position: 'bottom' } }
  }
});
</script>
@endsection
