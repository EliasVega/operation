@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Tipo Documento:&nbsp;&nbsp;&nbsp;&nbsp;  {{ $document->name }}</h3>
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
            {!!Form::model($document, ['method'=>'PATCH','route'=>['document.update', $document->id]])!!}
            {!!Form::token()!!}
                <div class="box-body row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="code">Codigo</label>
                            <input type="text" name="code" class="form-control" value="{{ $document->code }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="initials">Sigla</label>
                            <input type="text" name="initials" class="form-control" value="{{ $document->initials }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Tipo Documento</label>
                            <input type="text" name="name" class="form-control" value="{{ $document->name }}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-pencil-alt"></i>&nbsp; Actualizar</button>
                            <a href="{{ url('document') }}" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
