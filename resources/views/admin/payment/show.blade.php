@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="responsible">Elaborada por</label>
                <h4>{{ $payment->nameU }}</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">OPERADOR</label>
                <h4>{{ $payment->name }}</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="payment">Pago No.</label>
                <h4>{{ $payment->id }}</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h4>{{ $payment->created_at->format('yy-m-d') }}</h4>
            </div>
        </div>
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <h3>RELACION DEL PAGO
                        <a href="{{ route('payment.index') }}" class="btn btn-limonR"><i class="fas fa-undo-alt mr-2"></i>Regresar</a></h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Rem</th>
                                <th>Ent</th>
                                <th>operacion</th>
                                <th>Precio ($)</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ $payment->amount }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($operatingPartials as $op)
                                <tr>
                                    <td>{{ $op->idR }}</td>
                                    <td>{{ $op->idPay }}</td>
                                    <td>{{ $op->nameO }}</td>
                                    <td class="tdder">${{ $op->price }}</td>
                                    <td class="tdder">{{ $op->quantity }}</td>
                                    <td class="tdder">{{ $op->subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-danger">
                    <label class="form-control-label">
                        <h4>Deducciones</h4>
                    </label>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>ID</th>
                                <th>Autorizado</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ $advan }}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL A PAGAR:</p></th>
                                <th><p align="right">${{ $payment->amount - $advan }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($advances as $adv)
                                <tr>
                                    <td>{{ $adv->id }}</td>
                                    <td>{{ $adv->nameR }}</td>
                                    <td>${{ $adv->created_at->format('yy-m-d') }}</td>
                                    <td>{{ $adv->description }}</td>
                                    <td class="tdder">{{ $adv->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
