@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Agregar Usuario</h3>
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
            {!!Form::open(array('url'=>'user', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="row box-body">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="document_id">T/Documento</label>
                        <select name="document_id" id="document_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar.</option>
                            @foreach($documents as $doc)
                                <option
                                    value="{{ $doc->id }}">{{ $doc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="number">Numero de Identificacion</label>
                        <input type="text" name="number" class="form-control" placeholder="Numero del Documento">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="address">Direccion Residencia</label>
                        <input type="text" name="address" class="form-control" placeholder="Direccion de residencia">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" placeholder="Numero de Telefono">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" value="" placeholder="Email" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-12 col-form-label">Conf.
                            Contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               placeholder="Confirmar Password" required>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="position">Cargo</label>
                        <input type="text" name="position" class="form-control" placeholder="Cargo">
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="bank_id">Banco</label>
                        <select name="bank_id" id="bank_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar.</option>
                            @foreach($banks as $ban)
                                <option
                                    value="{{ $ban->id }}">{{ $ban->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="payment_method_id">Methodo de pago</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar.</option>
                            @foreach($paymentMethods as $pm)
                                <option
                                    value="{{ $pm->id }}">{{ $pm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="reference">Cta o referencia</label>
                        <input type="text" name="reference" class="form-control" placeholder="Cargo">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select name="role_id" id="role_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar.</option>
                            @foreach($roles as $rol)
                                <option
                                    value="{{ $rol->id }}">{{ $rol->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a href="{{url('user')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

