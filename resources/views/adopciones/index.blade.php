@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Adopciones</h1>

    <div class="text-end mb-3">
        <a href="{{ route('adopciones.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nueva Adopción
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tableAdopciones">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Mascota</th>
                    <th>Persona</th>
                    <th>Lugar</th>
                    <th>Contrato</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adopciones as $adopcion)
                    <tr>
                        <td>{{ $adopcion->id }}</td>
                        <td>{{ $adopcion->fecha_adopcion }}</td>
                        <td>{{ $adopcion->mascota->nombre ?? '—' }}</td>
                        <td>{{ $adopcion->persona->nombre ?? '—' }} {{ $adopcion->persona->apellido ?? '' }}</td>
                        <td>{{ $adopcion->lugar_adopcion ?? '—' }}</td>
                        <td>
                            @if($adopcion->contrato)
                                <iframe src="{{ asset($adopcion->contrato) }}" width="80px" height="80px"></iframe>
                            @else
                                <span class="text-muted">Sin contrato</span>
                            @endif
                        </td>



                        <td class="text-center">
                            <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" style="display:inline;" class="form-eliminar">
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
    new DataTable('#tableAdopciones', {
        language: { url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json' },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro de eliminar esta adopción?',
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
