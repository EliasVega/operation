<a href="{{ route('remission.show', $id) }}">
    <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver Orden" ><i class="far fa-eye"></i></button>
</a>
<a href="{{ route('showPdfRemission', $id) }}">
    <button class="btn btn-lilaR" data-toggle="tooltip" data-placement="top" title="Ver Pdf" ><i class="fa fa-file-pdf"></i></button>
</a>
@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
    <a href="{{ route('EntregaPartial', $id) }}">
        <button class="btn btn-limonR" data-toggle="tooltip" data-placement="top" title="crear entrega" ><i class="fa fa-file-pdf"></i></button>
    </a>
    <a href="{{ route('EntregaTotal', $id) }}">
        <button class="btn btn-verdeR" data-toggle="tooltip" data-placement="top" title="Entrega total" ><i class="fa fa-file-pdf"></i></button>
    </a>
    <a href="{{ route('remission.edit', $id) }}">
        <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Orden" ><i class="far fa-edit"></i></button>
</a>
@endif

