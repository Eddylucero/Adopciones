@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Mascotas</h1>

    <div class="text-end mb-3">
        <a href="{{ route('mascotas.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nueva Mascota
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tableMascotas">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Estado</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->id }}</td>
                        <td>{{ $mascota->nombre }}</td>
                        <td>{{ $mascota->especie }}</td>
                        <td>{{ $mascota->raza ?? '—' }}</td>
                        <td>{{ $mascota->edad ?? '—' }}</td>
                        <td>{{ $mascota->sexo ?? '—' }}</td>
                        <td>
                            @if($mascota->estado === 'Disponible')
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-secondary">Adoptada</span>
                            @endif
                        </td>
                        <td>
                            @if($mascota->foto)
                                <img src="{{ asset($mascota->foto) }}" width="80px" height="80px">
                            @else
                                <span class="text-muted">Sin foto</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm btn-eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- DataTables --}}
<script>
    $(document).ready(function() {
        new DataTable('#tableMascotas', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json' },
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-eliminar').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro de eliminar esta mascota?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
</script>
@endsection
