@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Nomina Total</h3>
            </div>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::open(array('url'=>'storetotal', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="box-body row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="bank_origin_id">Banco Origen de fondos</label>
                        <div class="select">
                            <select name="bank_origin_id" class="form-control selectpicker" data-live-search="true" id="bank_origin_id" required>
                                <option value="" disabled selected>Seleccionar.</option>
                                @foreach($banks as $ban)
                                <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Generar Pagos</button>
                        <a href="{{url('payment')}}" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#bank_origin_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    </script>
@endsection
