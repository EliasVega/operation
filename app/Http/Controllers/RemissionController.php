<?php

namespace App\Http\Controllers;

use App\Models\Remission;
use App\Http\Requests\StoreRemissionRequest;
use App\Http\Requests\UpdateRemissionRequest;
use App\Models\Company;
use App\Models\Operating;
use App\Models\OperatingPartial;
use App\Models\Operation;
use App\Models\OperationRemission;
use App\Models\Partial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\ElseIf_;

class RemissionController extends Controller
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
                $remissions = Remission::from('remissions as rem')
                ->join('users as use', 'rem.user_id', 'use.id')
                ->select('rem.id', 'rem.total', 'rem.status', 'rem.created_at', 'use.name')
                ->where('rem.status', '!=', 'ANULADA')
                ->get();
            } else {
                $remissions = Remission::from('remissions as rem')
                ->join('users as use', 'rem.user_id', 'use.id')
                ->select('rem.id', 'rem.total', 'rem.status', 'rem.created_at', 'use.name')
                ->where('rem.status', '!=', 'CANCELADA')
                ->where('rem.status', '!=', 'ANULADA')
                ->where('use.id', '=', $usid)
                ->get();
            }



            return datatables()
            ->of($remissions)
            ->editColumn('created_at', function(Remission $remission){
                return $remission->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/remission/actions')
            ->addColumn('delete', 'admin/remission/delete')
            ->rawcolumns(['btn', 'delete'])
            ->toJson();
        }
        return view('admin.remission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status', '=', 'ACTIVO')
        ->where('role_id', '=', 4)
        ->get();
        $operations = Operation::get();
        return view('admin.remission.create', compact('users', 'operations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRemissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRemissionRequest $request)
    {

        try{
            DB::beginTransaction();
            $operation_id = $request->operation_id;
            $quantity = $request->quantity;
            $price = $request->price;
            $responsible = Auth::user()->id;

            $remission = new Remission();
            $remission->items           = count($operation_id);
            $remission->total           = $request->total;
            $remission->status          = 'PROCESO';
            $remission->user_id         = $request->user_id;
            $remission->responsible_id = $responsible;
            $remission->save();

            $cont = 0;

            while($cont < count($operation_id)){
                $subtotal = $quantity[$cont] * $price[$cont];
                $item = $cont +1;

                $operationRemission = new OperationRemission();
                $operationRemission->quantity = $quantity[$cont];
                $operationRemission->price = $price[$cont];
                $operationRemission->subtotal = $subtotal;
                $operationRemission->item = $item;
                $operationRemission->pending = $quantity[$cont];
                $operationRemission->operation_id = $operation_id[$cont];
                $operationRemission->remission_id = $remission->id;
                $operationRemission->save();

                $operating = new Operating();
                $operating->operating = $quantity[$cont];
                $operating->operation_id = $operation_id[$cont];
                $operating->remission_id = $remission->id;
                $operating->save();

                $cont ++;
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect('remission')->with('warning', 'Remision creada satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $remissions = Remission::from('remissions AS rem')
        ->join('users as use', 'rem.user_id', 'use.id')
        ->join('users as user', 'rem.responsible_id', 'user.id')
        ->select('rem.id', 'rem.items', 'rem.total', 'rem.created_at', 'use.name', 'user.name as nameR')
        ->where('rem.id', '=', $id)->first();

        /*mostrar detalles*/
        $operationRemissions = OperationRemission::from('operation_remissions AS or')
        ->join('operations AS ope', 'or.operation_id', '=', 'ope.id')
        ->join('remissions AS rem', 'or.remission_id', '=', 'rem.id')
        ->join('users AS use', 'rem.user_id', '=', 'use.id')
        ->select('or.quantity', 'or.price', 'or.subtotal', 'rem.id', 'rem.total',  'ope.name', 'use.name AS nameU')
        ->where('or.remission_id', '=', $id)
        ->get();
        return view('admin.remission.show', compact('remissions', 'operationRemissions'));
    }

    public function EntregaPartial($id)
    {
        $users = User::from('users as use')
        ->join('companies as com', 'use.company_id', 'com.id')
        ->join('documents as doc', 'use.document_id', 'doc.id')
        ->join('roles as rol', 'use.role_id', 'rol.id')
        ->join('banks as ban', 'use.bank_id', 'ban.id')
        ->select('use.id', 'use.name', 'use.number', 'ban.name as nameB')
        ->where('use.status', '=', 'ACTIVO')
        ->where('rol.id', '=', 4)
        ->get();

        $remissions = Remission::from('remissions AS rem')
        ->join('users as use', 'rem.user_id', 'use.id')
        ->join('users as user', 'rem.responsible_id', 'user.id')
        ->select('rem.id', 'rem.items', 'rem.total', 'rem.created_at', 'use.name', 'user.name as nameR')
        ->where('rem.id', '=', $id)
        ->first();

        $operationRemissions = OperationRemission::from('operation_remissions AS or')
        ->join('operations AS ope', 'or.operation_id', '=', 'ope.id')
        ->join('remissions AS rem', 'or.remission_id', '=', 'rem.id')
        ->join('users AS use', 'rem.user_id', '=', 'use.id')
        ->select('or.quantity', 'or.price', 'or.pending', 'or.subtotal', 'ope.id', 'rem.total', 'ope.name', 'use.name AS nameU', 'use.id as idO')
        ->where('or.remission_id', '=', $id)
        ->where('or.pending', '>', 0)
        ->get();
        return view('admin.partial.create', compact('remissions', 'operationRemissions', 'users'));
    }

    public function EntregaTotal($id)
    {

        $remissions = Remission::from('remissions AS rem')
        ->join('users as use', 'rem.user_id', 'use.id')
        ->join('users as user', 'rem.responsible_id', 'user.id')
        ->select('rem.id', 'rem.items', 'rem.total', 'rem.created_at', 'use.id as idU', 'use.name', 'user.name as nameR')
        ->where('rem.id', '=', $id)->first();

        $partialTotal = Partial::where('remission_id', '=', $remissions->id)->first();
        if ($partialTotal) {
            return redirect('remission')->with('warning', 'Esta Remision ya tiene entregas');
        } else {
            try {
                DB::beginTransaction();
                //metodo para crear registro partial
                $partial = new Partial();
                $partial->total = $remissions->total;
                $partial->items = $remissions->items;
                $partial->remission_id = $remissions->id;
                $partial->user_id = $remissions->idU;
                $partial->responsible_id = Auth::user()->id;
                $partial->save();
                //trayendo variables del array
                $opRemission = OperationRemission::where('remission_id', '=', $remissions->id)->get();
                $operating = Operating::Where('remission_id', '=', $remissions->id);

                foreach ($opRemission as $or) {

                    //metodo para crear registro operation partial
                    $operating = Operating::from('operatings AS ope')
                    ->join('operations as oper', 'ope.operation_id', 'oper.id')
                    ->join('remissions as rem', 'ope.remission_id', 'rem.id')
                    ->select('ope.id', 'rem.id as idR', 'oper.id as idO')
                    ->where('rem.id', '=', $partial->remission_id)
                    ->where('oper.id', '=', $or->operation_id)
                    ->first();

                    $operatingPartial = new OperatingPartial();
                    $operatingPartial->quantity = $or->quantity;
                    $operatingPartial->price = $or->price;
                    $operatingPartial->subtotal = $or->subtotal;
                    $operatingPartial->item = $or->item;
                    $operatingPartial->operation_id = $operating->idO;
                    $operatingPartial->operating_id = $operating->id;
                    $operatingPartial->partial_id = $partial->id;
                    $operatingPartial->save();

                    //metodo para actualizar pendiente
                    $operationRemission = OperationRemission::from('operation_remissions as or')
                    ->join('operations as ope', 'or.operation_id', 'ope.id')
                    ->join('remissions as rem', 'or.remission_id', 'rem.id')
                    ->select('or.id', )
                    ->where('rem.id', '=', $or->remission_id)
                    ->where('ope.id', '=', $or->operation_id)
                    ->first();

                    $operation = OperationRemission::findOrFail($operationRemission->id);
                    $pending = $operation->pending;
                    $operation->pending = $pending - $or->quantity;
                    $operation->update();

                    //metodo para actualizar campo status de la remision
                    $operationRemission = OperationRemission::from('operation_remissions as or')
                    ->join('operations as ope', 'or.operation_id', 'ope.id')
                    ->join('remissions as rem', 'or.remission_id', 'rem.id')
                    ->select('or.id', )
                    ->where('rem.id', '=', $or->remission_id)
                    ->get();

                    $remission = Remission::findOrFail($partial->remission_id);
                    $remission->status = 'FINALIZADA';
                    $remission->update();

                }
            DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }
        return redirect('partial')->with('warning', 'Entrega Total Realizada con exito');
    }



    public function showPdfRemission($id)
    {
        $company = Company::from('companies AS com')
        ->join('departments AS dep', 'com.department_id', '=', 'dep.id')
        ->join('municipalities AS mun', 'com.municipality_id', '=', 'mun.id')
        ->select('com.id', 'com.name', 'com.nit', 'com.dv', 'com.address', 'com.email', 'com.phone', 'com.mobile', 'com.logo', 'dep.name AS department', 'mun.name AS municipality')
        ->where('com.id', '=', 1)
        ->first();
        $remissions = Remission::from('remissions AS rem')
        ->join('users as use', 'rem.user_id', 'use.id')
        ->join('users as user', 'rem.responsible_id', 'user.id')
        ->select('rem.id', 'rem.items', 'rem.total', 'rem.created_at', 'use.name', 'use.number', 'use.address', 'use.phone', 'use.email', 'user.name as nameR')
        ->where('rem.id', '=', $id)->first();

        /*mostrar detalles*/
        $operationRemissions = OperationRemission::from('operation_remissions AS or')
        ->join('operations AS ope', 'or.operation_id', '=', 'ope.id')
        ->join('remissions AS rem', 'or.remission_id', '=', 'rem.id')
        ->join('users AS use', 'rem.user_id', '=', 'use.id')
        ->select('or.quantity', 'or.price', 'or.subtotal', 'rem.id', 'rem.total', 'ope.name', 'use.name AS nameU')
        ->where('or.remission_id', '=', $id)
        ->get();

        $remissionpdf = "REM-". $remissions->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.remission.pdf', compact('remissions', 'operationRemissions', 'company', 'logo'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$remissionpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partial = Partial::where('remission_id', '=', $id)->get();
        $mas = count($partial);
        if ($mas == 0) {
            $remission = Remission::findOrFail($id);
            $users = User::get();
            $operationRemissions = OperationRemission::from('operation_remissions as or')
            ->join('operations as ope', 'or.operation_id', 'ope.id')
            ->join('remissions as rem', 'or.remission_id', 'rem.id')
            ->select('or.quantity', 'ope.price', 'ope.name', 'ope.id')
            ->where('or.remission_id', '=', $id)
            ->get();

        } else {
            return redirect('remission')->with('warning', 'Esta remision ya tiene entregas y no se puede editar');
        }
        return view('admin.remission.edit', compact('remission', 'users', 'operationRemissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRemissionRequest  $request
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRemissionRequest $request, $id)
    {
        $operation_id = $request->operation_id;
        $itemnew = count($operation_id);
        $remission = Remission::findOrFail($id);
        if($itemnew != $remission->items){
            return redirect("remission")->with('warning', 'Se requiere de todos los items');
        }
        try{
            DB::beginTransaction();
            $operation_id = $request->operation_id;
            $quantity = $request->quantity;
            $price = $request->price;
            $responsible = Auth::user()->id;
            $itemnew = count($operation_id);

            $remission = Remission::findOrFail($id);
            $remission->user_id         = $request->user_id;
            $remission->items           = count($operation_id);
            $remission->total           = $request->total;
            $remission->status          = 'PROCESO';
            $remission->responsible_id = $responsible;
            $remission->update();

            $cont = 0;

            while($cont < count($operation_id)){
                $subtotal = $quantity[$cont] * $price[$cont];
                $item = $cont +1;

                $operRemis = OperationRemission::from('operation_remissions as or')
                ->join('operations as ope', 'or.operation_id', 'ope.id')
                ->join('remissions as rem', 'or.remission_id', 'rem.id')
                ->select('or.id', 'or.quantity', 'ope.price', 'ope.name', 'ope.stock')
                ->where('or.remission_id', '=', $id)
                ->where('or.operation_id', '=', $operation_id[$cont])
                ->first();
                $stocky = $operRemis->quantity;
                $operation = Operation::findOrFail($operation_id[$cont]);
                $stock = $operation->stock;
                $operation->stock = $stock - $stocky;
                $operation->update();

                $operationRemission = OperationRemission::findOrFail($operRemis->id);
                $operationRemission->quantity = $quantity[$cont];
                $operationRemission->price = $price[$cont];
                $operationRemission->subtotal = $subtotal;
                $operationRemission->item = $item;
                $operationRemission->pending = $quantity[$cont];
                $operationRemission->update();


                $operation = Operation::findOrFail($operation_id[$cont]);
                $stock = $operation->stock;
                $operation->stock = $stock + $quantity[$cont];
                $operation->update();

                $opera = Operating::from('operatings as ope')
                ->join('operations as oper', 'ope.operation_id', 'oper.id')
                ->join('remissions as rem', 'ope.remission_id', 'rem.id')
                ->select('ope.id', 'ope.operation_id', 'ope.remission_id')
                ->where('ope.remission_id', '=', $id )
                ->where('ope.operation_id', '=', $operation_id[$cont])
                ->first();

                $operating = Operating::findOrFail($opera->id);
                $operating->operating = $quantity[$cont];
                $operating->update();

                $cont ++;
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect('remission')->with('warning', 'Remision editada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partial = Partial::from('partials as par')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->select('par.id', 'rem.id')
        ->where('rem.id', '=', $id)
        ->first();

        if ($partial != null) {
            return redirect("remission")->with('warning', 'esta remision ya tiene entregas');
        }
        try{
            DB::beginTransaction();

            $operRemis = OperationRemission::from('operation_remissions as or')
            ->join('operations as ope', 'or.operation_id', 'ope.id')
            ->join('remissions as rem', 'or.remission_id', 'rem.id')
            ->select('or.id', 'or.quantity', 'ope.price', 'ope.name', 'or.operation_id')
            ->where('or.remission_id', '=', $id)
            ->get();
            foreach ($operRemis as $or) {
                $operationRemission = OperationRemission::findOrFail($or->id);
                $operationRemission->quantity = 0;
                $operationRemission->price = 0;
                $operationRemission->subtotal = 0;
                $operationRemission->item = 0;
                $operationRemission->pending = 0;
                $operationRemission->update();

                $operation = Operation::findOrFail($or->operation_id);
                $stock = $operation->stock;
                $operation->stock = $stock - $or->quantity;
                $operation->update();

                $opera = Operating::from('operatings as ope')
                ->join('operations as oper', 'ope.operation_id', 'oper.id')
                ->join('remissions as rem', 'ope.remission_id', 'rem.id')
                ->select('ope.id', 'ope.operation_id', 'ope.remission_id')
                ->where('ope.remission_id', '=', $id )
                ->where('ope.operation_id', '=', $or->operation_id)
                ->first();

                $operating = Operating::findOrFail($opera->id);
                $operating->operating = 0;
                $operating->update();
            }

            $remission = Remission::findOrFail($id);
            $remission->items           = 0;
            $remission->total           = 0;
            $remission->status          = 'ANULADA';
            $remission->update();

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect('remission')->with('warning', 'Remision fue eliminada');
    }
}
