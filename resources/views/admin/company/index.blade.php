@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr class="bg-success">
                        <th>Id</th>
                        <th>Municipio</th>
                        <th>Nombre</th>
                        <th>NIT</th>
                        <th>dv</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Logo</th>
                        @if (Auth::user()->role_id == 1)
                        <th>Editar</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $com)
                        <tr>
                            <td>{{ $com->id }}</td>
                            <td>{{ $com->municipality->name }}</td>
                            <td>{{ $com->name }}</td>
                            <td>{{ $com->nit }}</td>
                            <td>{{ $com->dv }}</td>
                            <td>{{ $com->address }}</td>
                            <td>{{ $com->phone }}</td>
                            <td>{{ $com->mobile }}</td>
                            <td>{{ $com->email }}</td>
                            <td>
                                <img src="{{ asset('images/logos/'.$com->logo) }}" alt="{{ $com->name }}" style="height:60px; width:80px;" class="img-thumbnail">
                            </td>
                            @if (Auth::user()->role_id == 1)
                            <td>
                                <a href="{{ route('company.edit', $com->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row center">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('user.index') }}"><button><img src="{{ asset('/img/user.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Usuarios" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('remission.index') }}"><button><img src="{{ asset('/img/remision.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Ordenes de Produccion" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('partial.index') }}"><button><img src="{{ asset('/img/recibido.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Entregas" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('operation.index') }}"><button><img src="{{ asset('/img/proceso.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="En Produccion" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('operating.index') }}"><button><img src="{{ asset('/img/produccion.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Operarios Produciendo" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('payment.index') }}"><button><img src="{{ asset('/img/pagos.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Pagos" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('advance.index') }}"><button><img src="{{ asset('/img/advance.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Avances" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('presuntive.index') }}"><button><img src="{{ asset('/img/pagoP.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Pago Presuntivo" /></button></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vh-30 center">
        <div>
            <a href="{{ route('increment.create') }}"><button><img src="{{ asset('/img/increment.jpg') }}" height ="120" width="120" data-toggle="tooltip" data-placement="top" title="Incremento" /></button></a>
        </div>
    </div>

</div>
@endsection

