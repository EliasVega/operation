@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Nueva categoria</h3>
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
            {!!Form::open(array('url'=>'category', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="box-body row">
                <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="code">Codigo</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" placeholder="Codigo">
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre de la category</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Ingrese el nombre de la category">
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="description">Descripcion de la category</label>
                        <input type="text" name="description" value="{{ old('description') }}" class="form-control" placeholder="Ingrese la descripcion de la category">
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
                        <a href="{{url('category')}}" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
