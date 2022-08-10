@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Avance : &nbsp;&nbsp;&nbsp;&nbsp;{{ $advance->name }}</h3>
            </div>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::model($advance, ['method'=>'PATCH','route'=>['advance.update', $advance->id]])!!}
            {!!Form::token()!!}
                <div class="box-body row">

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Operario</label>
                            <input type="text" name="name" class="form-control" value="{{ $advance->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" id="user">
                            <label for="user_id">Operario</label>
                            <input type="text" name="user_id" class="form-control" value="{{ $advance->id }}" readonly>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="amount">Valor</label>
                            <input type="number" name="amount" class="form-control" value="{{ $advance->amount }}" min="1" pattern="[0-9]{0,15}">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <input type="text" name="description" class="form-control" value="{{ $advance->description }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-pencil-alt"></i>&nbsp; Actualizar</button>
                            <a href="{{ url('advance') }}" class="btn btn-danger btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
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

        $("#user").hide();

    </script>
@endsection
