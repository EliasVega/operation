<a href="{{ route('partial.show', $id) }}">
    <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver Entrega" ><i class="far fa-eye"></i></button>
</a>
<a href="{{ route('showPdfPartial', $id) }}">
    <button class="btn btn-lilaR" data-toggle="tooltip" data-placement="top" title="Ver Pdf" ><i class="fa fa-file-pdf"></i></button>
</a>
@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
    <a href="{{ route('partial.edit', $id) }}">
        <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar" ><i class="far fa-edit"></i></button>
    </a>
    <a href="{{ route('aprobation', $id) }}"
        class="btn btn-verR" data-toggle="tooltip" data-placement="top" title="En Revision"><i class="far fa-edit"></i>
    </a>
@endif

