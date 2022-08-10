<?php

namespace App\Http\Controllers;

use App\Models\Partial;
use App\Http\Requests\StorePartialRequest;
use App\Http\Requests\UpdatePartialRequest;
use App\Models\Company;
use App\Models\Operating;
use App\Models\OperatingPartial;
use App\Models\Operation;
use App\Models\OperationRemission;
use App\Models\Remission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->role_id;
        $usid = Auth::user()->id;
        if (request()->ajax()) {
            if ($user != 4) {
                $partials = Partial::from('partials as par')
                ->join('users as use', 'par.user_id', 'use.id')
                ->join('remissions as rem', 'par.remission_id', 'rem.id')
                ->join('users as user', 'rem.user_id', 'user.id')
                ->select('par.id', 'par.total', 'par.status', 'par.aprobation', 'par.created_at', 'use.name', 'rem.id as rem', 'user.name as nameR')
                ->get();
            } else {
                $partials = Partial::from('partials as par')
                ->join('users as use', 'par.user_id', 'use.id')
                ->join('remissions as rem', 'par.remission_id', 'rem.id')
                ->join('users as user', 'rem.user_id', 'user.id')
                ->select('par.id', 'par.total', 'par.status', 'par.aprobation', 'par.created_at', 'use.name', 'rem.id as rem', 'user.name as nameR')
                ->where('use.id', '=', $usid)
                ->get();
            }



            return datatables()
            ->of($partials)
            ->editColumn('created_at', function(Partial $partial){
                return $partial->created_at->format('yy-m-d');
            })
            ->addColumn('btn', 'admin/partial/actions')
            ->rawcolumns(['btn'])
            ->toJson();
        }
        return view('admin.partial.index');
    }

    public function aprobation($id)
    {

        $partial = Partial::findOrFail($id);

        if ($partial->aprobation == 'APROBADO') {

            $partial->aprobation = 'NO APROBADO';
        } else {
            $partial->aprobation = 'APROBADO';
        }

        $partial->update();
        return redirect('partial');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartialRequest $request)
    {
        try {
            DB::beginTransaction();
             //trayendo variables del array
            $operation_id = $request->operation_id;
            $quantity = $request->quantity;
            $price = $request->price;
            //metodo para crear registro partial
            $primis = $request->remission_id[0];
            $remission = Remission::from('remissions AS rem')
            ->join('users as use', 'rem.user_id', 'use.id')
            ->join('users as user', 'rem.responsible_id', 'user.id')
            ->select('rem.id', 'rem.items', 'rem.total', 'rem.created_at', 'use.id as idU', 'user.id', 'user.name as nameR')
            ->where('rem.id', '=', $primis)->first();
            $partial = new Partial();
            $partial->total = $request->total;
            $partial->items = count($operation_id);
            $partial->remission_id = $primis;
            $partial->user_id = $remission->idU;
            $partial->responsible_id = Auth::user()->id;
            $partial->save();


            $cont = 0;

            while($cont < count($operation_id) ){
                //metodo para crear registro operation partial
                $operating = Operating::from('operatings AS ope')
                ->join('operations as oper', 'ope.operation_id', 'oper.id')
                ->join('remissions as rem', 'ope.remission_id', 'rem.id')
                ->select('ope.id', 'rem.id as idR', 'oper.id as idO')
                ->where('rem.id', '=', $primis)
                ->where('oper.id', '=', $operation_id[$cont])
                ->first();
                $subtotal = $quantity[$cont] * $price[$cont];
                $item = $cont +1;

                $operatingPartial = new OperatingPartial();
                $operatingPartial->quantity = $quantity[$cont];
                $operatingPartial->price = $price[$cont];
                $operatingPartial->subtotal = $subtotal;
                $operatingPartial->item = $item;
                $operatingPartial->operation_id = $operating->idO;
                $operatingPartial->operating_id = $operating->id;;
                $operatingPartial->partial_id = $partial->id;
                $operatingPartial->save();

                //metodo para actualizar pendiente
                $operationRemission = OperationRemission::from('operation_remissions as or')
                ->join('operations as ope', 'or.operation_id', 'ope.id')
                ->join('remissions as rem', 'or.remission_id', 'rem.id')
                ->select('or.id', )
                ->where('rem.id', '=', $primis)
                ->where('ope.id', '=', $operation_id[$cont])
                ->first();
                $operation = OperationRemission::findOrFail($operationRemission->id);
                $pending = $operation->pending;
                $operation->pending = $pending - $quantity[$cont];
                $operation->update();

                //metodo para actualizar campo status de la remision
                $operationRemission = OperationRemission::where('remission_id', '=', $partial->remission_id)->get();
                $pend = 0;
                foreach ($operationRemission as $or) {
                    if ($or->pending > 0) {
                        $pend ++;
                    }
                }
                if ($pend > 0) {
                    $remission = Remission::findOrFail($partial->remission_id);
                    $remission->status = 'PARCIAL';
                    $remission->update();
                } else {
                    $remission = Remission::findOrFail($partial->remission_id);
                    $remission->status = 'FINALIZADA';
                    $remission->update();
                }


                $cont ++;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('partial')->with('warning', 'Entrega Realizada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partial  $partial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partials = Partial::from('partials AS par')
        ->join('users as use', 'par.user_id', 'use.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->join('users as user', 'par.responsible_id', 'user.id')
        ->select('par.id', 'par.total', 'par.created_at', 'use.name', 'user.name as nameO')
        ->where('par.id', '=', $id)->first();

        /*mostrar detalles*/
        $operatingPartials = OperatingPartial::from('operating_partials AS op')
        ->join('operatings AS ope', 'op.operating_id', '=', 'ope.id')
        ->join('partials AS par', 'op.partial_id', '=', 'par.id')
        ->join('operations AS oper', 'op.operation_id', '=', 'oper.id')
        ->select('op.quantity', 'op.price', 'op.subtotal', 'par.id', 'par.total', 'oper.name')
        ->where('op.partial_id', '=', $id)
        ->get();
        return view('admin.partial.show', compact('partials', 'operatingPartials'));
    }

    public function showPdfPartial($id)
    {
        $company = Company::from('companies AS com')
        ->join('departments AS dep', 'com.department_id', '=', 'dep.id')
        ->join('municipalities AS mun', 'com.municipality_id', '=', 'mun.id')
        ->select('com.id', 'com.name', 'com.nit', 'com.dv', 'com.address', 'com.email', 'com.phone', 'com.mobile', 'com.logo', 'dep.name AS department', 'mun.name AS municipality')
        ->where('com.id', '=', 1)
        ->first();
        $partials = Partial::from('partials AS par')
        ->join('users as use', 'par.user_id', 'use.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->join('users as user', 'rem.user_id', 'user.id')
        ->select('par.id', 'par.total', 'par.created_at', 'use.name', 'user.name as nameO', 'user.number', 'user.address', 'user.email', 'user.phone')
        ->where('rem.id', '=', $id)->first();

        /*mostrar detalles*/
        $operatingPartials = OperatingPartial::from('operating_partials AS op')
        ->join('operatings AS ope', 'op.operating_id', '=', 'ope.id')
        ->join('partials AS par', 'op.partial_id', '=', 'par.id')
        ->join('operations AS oper', 'op.operation_id', '=', 'oper.id')
        ->select('op.quantity', 'op.price', 'op.subtotal', 'par.id', 'par.total', 'oper.name')
        ->where('op.partial_id', '=', $id)
        ->get();

        $partialpdf = "REM-". $partials->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.partial.pdf', compact('partials', 'operatingPartials', 'company', 'logo'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$partialpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partial  $partial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partials = Partial::where('id', '=', $id)->first();

        if ($partials->status == 'PENDIENTE' && $partials->aprobation != 'PAGADO') {
            $partials = Partial::from('partials AS par')
            ->join('users as use', 'par.user_id', 'use.id')
            ->join('remissions as rem', 'par.remission_id', 'rem.id')
            ->join('users as user', 'par.responsible_id', 'user.id')
            ->select('par.id', 'par.total', 'par.created_at', 'use.id as idO', 'use.name', 'user.name as nameR', 'rem.id as idR', 'user.name as nameO', 'user.number', 'user.address', 'user.email', 'user.phone')
            ->where('par.id', '=', $id)
            ->first();

            $operatingPartials = OperatingPartial::from('operating_partials AS op')
            ->join('operations AS ope', 'op.operation_id', '=', 'ope.id')
            ->join('operatings AS oper', 'op.operating_id', '=', 'oper.id')
            ->join('partials AS par', 'op.partial_id', '=', 'par.id')
            ->join('users as use', 'par.user_id', 'use.id')
            ->select('op.id', 'op.quantity', 'op.price', 'op.subtotal', 'op.item', 'ope.id as idO', 'oper.id as idOp', 'par.total', 'ope.name', 'use.name AS nameU', 'use.id as idO', 'oper.operating')
            ->where('op.partial_id', '=', $id)
            ->get();

            return view('admin.partial.edit', compact('partials', 'operatingPartials'));
        } else {
            return redirect('partial')->with('warning', 'Esta Entrega ya fue cancelada');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartialRequest  $request
     * @param  \App\Models\Partial  $partial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartialRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            //trayendo variables del array
            $operation_id = $request->operation_id;
            $quantity = $request->quantity;
            $price = $request->price;

            $itemnew = count($operation_id);
            $partial = Partial::findOrFail($id);
            if($itemnew != $partial->items){

                return redirect("partial")->with('warning', 'Se requiere de todos los items');
            }
            $partial->total = $request->total;
            $partial->update();

            $remission = Remission::findOrFail($partial->remission_id)->first();
            $remission->status = 'PROCESO';
            $remission->update();
            $cont = 0;
            while($cont < count($operation_id) ){
                $operPartial = OperatingPartial::where('partial_id', '=', $id)->where('operation_id', '=', $operation_id[$cont])->first();
                $operation = Operation::where('id', '=', $operation_id[$cont])->first();
                $operRemission = OperationRemission::where('remission_id', '=', $partial->remission_id)->where('operation_id', '=', $operation->id)->first();

                //metodo para actualizar registro operation partial
                $operating = Operating::where('remission_id', '=', $partial->remission_id)->where('operation_id', '=', $operation_id[$cont])->first();


                $subtotal = $quantity[$cont] * $price[$cont];

                $item = $cont +1;
                $qtOperating = $operating->operating;//cantidad en operating->operating
                $qtOP = $operPartial->quantity; //cantidad operatingPartial->quantity
                $stockOper = $operation->stock; //cantidad en operation->stock
                $pendingOR = $operRemission->pending; // cantidad en operationRemission->pending
                $pendingORem = $pendingOR + $qtOP; //suma los campos pendiente + cantidad de la operatingPartial
                $oldOperating = $qtOperating + $qtOP;
                $oldOperation = $stockOper + $qtOP;
                $operatingPartial = OperatingPartial::where('partial_id', '=', $id)->where('operation_id', '=', $operation_id[$cont])->first();
                $operatingPartial->quantity = $quantity[$cont];
                $operatingPartial->price = $price[$cont];
                $operatingPartial->subtotal = $subtotal;
                $operatingPartial->item = $item;
                $operatingPartial->operation_id = $operation_id[$cont];
                $operatingPartial->operating_id = $operating->id;;
                $operatingPartial->partial_id = $id;
                $operatingPartial->update();

                //metodo para actualizar operating de la tabla operating
                $newOperating = $oldOperating - $quantity[$cont];
                $operating->operating = $newOperating;
                $operating->update();

                //metodo para actualizar stock de la tabla operation
                $newOperation = $oldOperation - $quantity[$cont];
                $operation->stock = $newOperation;
                $operation->update();

                //metodo para actualizar pendiente en operation remission
                $newPending = $pendingORem - $quantity[$cont];
                //$operationRemission = OperationRemission::findOrFail($operRemission->id);
                $operRemission->pending = $newPending;
                $operRemission->update();

                //metodo para actualizar campo status de la remision
                $operationRemission = OperationRemission::where('remission_id', '=', $partial->remission_id)->get();

                $pend = 0;
                foreach ($operationRemission as $or) {
                    if ($or->pendig > 0) {
                        $pend ++;
                    }
                }
                if ($pend > 0) {
                    $remission = Remission::findOrFail($partial->remission_id);
                    $remission->status = 'PARCIAL';
                    $remission->update();
                } else {
                    $remission = Remission::findOrFail($partial->remission_id);
                    $remission->status = 'FINALIZADA';
                    $remission->update();
                }


                $cont ++;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('partial')->with('warning', 'Entrega Editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partial  $partial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partial $partial)
    {
        //
    }
}
