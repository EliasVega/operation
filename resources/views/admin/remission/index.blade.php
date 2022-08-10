@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de Ordenes de Produccion
                <a href="{{ route('partial.index') }}" class="btn btn-celeste"><i class="fas fa-undo-alt mr-2"></i>Entregas</a>
                <a href="{{ route('advance.index') }}" class="btn btn-lilaR"><i class="fas fa-undo-alt mr-2"></i>Deducciones</a>
                <a href="{{ route('payment.index') }}" class="btn btn-verdeR"><i class="fas fa-undo-alt mr-2"></i>Pagos</a>
                @if (Auth::user()->role_id != 4)
                <a href="remission/create" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Agregar Orden de Produccion</a>
                @endif

                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <a href="{{ route('company.index') }}" class="btn btn-limonR"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endif

                </h3>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="remissions">
                    <thead>
                        <tr class="bg-info">
                            <th>X</th>
                            <th>Id</th>
                            <th>Operador</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#remissions').DataTable(
        {
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('remission.index') }}',
            columns:
            [
                {data: 'delete'},
                {data: 'id'},
                {data: 'name'},
                {data: 'total'},
                {data: 'created_at'},
                {data: 'status'},
                {data: 'btn'}

            ],
            dom: '<"pull-left"B><"pull-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
            buttons:
            [
                'copy', 'csv', 'excel', 'print',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
            ],
            lengthMenu:
            [
                [
                    10, 25, 50, -1
                ],
                [
                    '10 rows', '25 rows', '50 rows', 'Show all'
                ]
            ],
            "language":
            {
                "processing": "Cargando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "loadingRecords": "Cargando...",
                "paginate":
                {
                    "next": "Siguiente",
                    "previous": "Anterior",
                },

                "buttons":
                {
                    "copy": "Copiar",
                    "print": "Imprimir"
                },
            }
        });
    });
</script>
@endpush
</main>
@endsection




