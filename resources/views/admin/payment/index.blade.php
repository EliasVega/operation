@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de Pagos Operarios
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <a href="payment/create" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Agregar Pago</a>
                    <a href="{{ route('storeCreate') }}" class="btn btn-lilaR"><i class="fas fa-undo-alt mr-2"></i>Generar Pagos</a>
                @endif
                <a href="{{ route('remission.index') }}" class="btn btn-limonR"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>

                <a href="{{ route('presuntive.index') }}" class="btn btn-gris"><i class="fas fa-undo-alt mr-2"></i>Pago Presuntivo</a>

            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="payments">
                    <thead>
                        <tr class="bg-info">
                            <th>Id</th>
                            <th>Operario</th>
                            <th>Medio de Pago</th>
                            <th>Banco Destino</th>
                            <th>Referencia</th>
                            <th>Devengados</th>
                            <th>Deducciones</th>
                            <th>Total</th>
                            <th>Fecha</th>
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
        $('#payments').DataTable(
        {
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('payment.index') }}',
            columns:
            [
                {data: 'id'},
                {data: 'name'},
                {data: 'nameP'},
                {data: 'nameB'},
                {data: 'reference'},
                {data: 'amount'},
                {data: 'discount'},
                {data: 'total'},
                {data: 'created_at'},
                {data: 'edit'},
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
                    '10', '25', '50', 'Show all'
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
                }
            }
        });
    });
</script>
@endpush
</main>
@endsection

