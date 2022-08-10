@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Edit company: &nbsp;&nbsp;&nbsp;&nbsp;{{ $company->name }}</h3>
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
            {!!Form::model($company, ['enctype' => "multipart/form-data", 'method'=>'PATCH','route'=>['company.update', $company->id]])!!}
            {!!Form::token()!!}
            <div class="box-body row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name">nombre de la Empresa</label>
                        <input type="text" name="name" value="{{ $company->name }}" class="form-control" placeholder="Empresa">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                    <label for="department_id">Departamento</label>
                        <select name="department_id" class="form-control" id="department">
                            @foreach($departments as $dep)
                                @if($dep->id == $company->department_id)
                                    <option value="{{ $dep->id }}" selected>{{ $dep->name }}</option>
                                @else
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="municipality_id">Municipio</label>
                            <select name="municipality_id" class="form-control" id="municipality" required>
                                @foreach($municipalities as $mun)
                                    @if($mun->id == $company->municipality_id)
                                        <option value="{{ $mun->id }}" selected>{{ $mun->name }}</option>
                                    @else
                                        <option value="{{ $mun->id }}">{{ $mun->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nit">Nit</label>
                        <input type="text" name="nit" value="{{ $company->nit }}" class="form-control" placeholder="Nit" required>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="dv">DV</label>
                        <input type="text" name="dv" value="{{ $company->dv }}" class="form-control" placeholder="DV" required>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" name="address" value="{{ $company->address }}" class="form-control" placeholder="Direccion" required>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input type="text" name="phone" value="{{ $company->phone }}" class="form-control" placeholder="Telefono" required>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="mobile">celular</label>
                        <input type="text" name="mobile" value="{{ $company->mobile }}" class="form-control" placeholder="celular" required>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="manager">Gerente</label>
                        <input type="text" name="manager" value="{{ $company->manager }}" class="form-control" placeholder="Gerente" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $company->email }}" class="form-control" placeholder="Ingrese el correo electronico">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="form-group">
                        <label for="logo">Imagen</label>
                        <input type="file" name="logo" class="form-control" id="logo" value="{{ $company->logo }}" placeholder="Ingresar Imagen">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
                        <a href="{{url('company')}}" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
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
        /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#department').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#municipality').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        $("#department").change(function(event){
            $.get("create/" + event.target.value + "", function(response){
                $("#municipality").empty();
                $("#municipality").append("<option value = '#' disabled selected>Seleccionar ...</option>");
                for(i = 0; i < response.length; i++){
                    $("#municipality").append("<option value = '" + response[i].id +"'>" + response[i].name + "</option>");
                }
            });
        });

    </script>
@endsection
