<div class="box-body row">

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="remission_id">Remision</label>
            <input type="text" name="remission_id" value="{{ $partials->idR }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="name">Operador</label>
            <input type="text" name="name" value="{{ $partials->name }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group" >
            <label for="responsible_id">Elaborada por</label>
            <input type="text" name="responsible_id" value="{{ $partials->nameR }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group" id="use_id">
            <label for="user_id">id Oper</label>
            <input type="text" name="user_id" value="{{ $partials->idO }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>

    <div class="clearfix"></div>



    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <h4>Agregar Entrega Parcial o total</h4>
            </label>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group"  id="pend">
            <label for="operating">Cantidad max</label>
            <input type="number" name="operating" id="operating"
                class="form-control" placeholder="cantidad" readonly>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group row">
            <label class="form-control-label" for="operation_id">Operacion</label>
            <select name="operation_id" class="form-control selectpicker" id="operation_id"
                data-live-search="true">
                <option value="0" disabled selected>Seleccionar el Operacion</option>
                @foreach($operatingPartials as $op)
                <option
                    value="{{ $op->id }}_{{ $op->price }}_{{ $op->quantity }}_{{ $op->operating }}">
                    {{ $op->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="price">Precio</label>
            <input type="number" id="price" name="price" class="form-control"
                placeholder="Precio" min="1" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="quantity">Cantidad</label>
            <input type="number" id="quantity" name="quantity" value=""
                class="form-control" placeholder="Cantidad" min="1" pattern="[0-9]{0,15}">
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
                        <th>Id</th>
                        <th>operacion</th>
                        <th>Cantidad</th>
                        <th>precio ($)</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="5" class="footder">TOTAL:</th>
                        <td class="footder"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
                    </tr>

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
