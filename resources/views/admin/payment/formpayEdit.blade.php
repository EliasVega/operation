<div class="box-body row">
    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="user_id">Operador</label>
            <input type="text" name="user_id" value="{{ $payment->name }}" class="form-control" readonly>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="payment_method_id">Metodo de Pago</label>
            <div class="select">
                <select name="payment_method_id" class="form-control selectpicker" data-live-search="true" id="payment_method_id" required>
                    @foreach($paymentMethods as $pm)
                    @if($pm->id == $payment->payment_method_id)
                    <option value="{{ $pm->id }}" selected>{{ $pm->name }}</option>
                    @else
                    <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="payment_method_id">Banco de Origen</label>
            <div class="select">
                <select name="bank_origin_id" class="form-control selectpicker" data-live-search="true" id="bank_origin_id" required>
                    @foreach($banks as $ban)
                    @if($ban->id == $payment->bank_origin_id)
                    <option value="{{ $ban->id }}" selected>{{ $ban->name }}</option>
                    @else
                    <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="bank_id">Banco Destino</label>
            <div class="select">
                <select name="bank_id" class="form-control selectpicker" data-live-search="true" id="bank_id" required>
                    @foreach($banks as $ban)
                    @if($ban->id == $payment->bank_id)
                    <option value="{{ $ban->id }}" selected>{{ $ban->name }}</option>
                    @else
                    <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="reference">Cta o Referencia</label>
            <input type="text" name="reference" value="{{ $payment->reference }}" class="form-control" placeholder="Referencia" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Add</label><br>
            <button class="btn btn-grisb" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Add"><i class="fas fa-check"></i>&nbsp; </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('remission')}}" class="btn btn-grisb" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Eliminar</th>
                        <th>Operador</th>
                        <th>Metodo de pago</th>
                        <th>Bco Origen</th>
                        <th>Bco destino</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer" id="save">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group row">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;
                    Registrar</button>
            </div>
        </div>
    </div>
</div>
