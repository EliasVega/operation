@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Agregar Avance</h3>
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
            {!!Form::open(array('url'=>'advance', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
                <div class="box-body row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="user_id">Operario</label>
                            <div class="select">
                                <select name="user_id" class="form-control selectpicker" data-live-search="true" id="user_id" required>
                                    <option value="" disabled selected>Seleccionar.</option>
                                    @foreach($users as $use)
                                    <option value="{{ $use->id }}">{{ $use->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="amount">Valor</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="Valor" min="1" pattern="[0-9]{0,15}">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Descripcion">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save fa-2x"></i>&nbsp; Guardar</button>
                        <a href="{{url('advance')}}" class="btn btn-danger btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#user_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });

    </script>
@endsection
