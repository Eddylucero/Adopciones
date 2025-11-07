@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Cirugías</h1>

    <div class="text-end mb-3">
        <a href="{{ route('cirugias.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nueva Cirugía
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tableCirugias">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Mascota</th>
                    <th>Fecha de Cirugía</th>
                    <th>Duración</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cirugias as $cirugia)
                    <tr>
                        <td>{{ $cirugia->id }}</td>
                        <td>{{ $cirugia->mascota->nombre ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($cirugia->fecha_cirugia)->format('d/m/Y') }}</td>
                        <td>{{ $cirugia->duracion ?? '—' }}</td>
                        <td>{{ Str::limit($cirugia->motivo, 60, '...') }}</td>

                        <td>
                            @if($cirugia->estado === 'Programada')
                                <span class="badge bg-warning text-dark">Programada</span>
                            @elseif($cirugia->estado === 'Realizada')
                                <span class="badge bg-success">Realizada</span>
                            @else
                                <span class="badge bg-danger">Cancelada</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('cirugias.edit', $cirugia->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('cirugias.destroy', $cirugia->id) }}" method="POST" style="display:inline;" class="form-eliminar">
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

<script>
$(document).ready(function() {
    new DataTable('#tableCirugias', {
        language: { url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json' },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro de eliminar esta cirugía?',
                text: 'No podrás revertir esta acción.',
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
