<?php

namespace App\Http\Controllers;

use App\Models\Operating;
use App\Http\Requests\StoreOperatingRequest;
use App\Http\Requests\UpdateOperatingRequest;
use App\Models\OperatingPartial;
use App\Models\OperationRemission;
use App\Models\Partial;
use App\Models\Remission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatingController extends Controller
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
        if (request()->ajax()) {
            $operatings = Operating::from('operatings as ope')
            ->join('operations as oper', 'ope.operation_id', 'oper.id')
            ->join('remissions as rem', 'ope.remission_id', 'rem.id')
            ->join('users as use', 'rem.user_id', 'use.id')
            ->select('ope.id', 'ope.operating', 'oper.name', 'oper.id as idO', 'oper.price', 'rem.id as idR', 'use.name as nameU')
            ->where('ope.operating', '>', 0)
            ->get();

            return datatables()
            ->of($operatings)
            ->toJson();
        }
        return view('admin.operating.index');
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
     * @param  \App\Http\Requests\StoreOperatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperatingRequest $request)
    {
        $rem = $request->operator;
            dd($rem);
        try {
            DB::beginTransaction();
            //metodo para crear registro partial
            $partial = new Partial();
            $partial->total = $request->total;
            $partial->status = 'PENDIENTE';
            $partial->remission_id = $request->remission_id;
            $partial->user_id = Auth::user()->id;
            $partial->save();
            //trayendo variables del array
            $opRemission = OperationRemission::where('remission_id', '=', $request->session()->get('remssion'))->get();
            $operating = Operating::Where('remission_id', '=', $opRemission->remission_id);

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

            }
            //metodo para actualizar campo status de la remision
            $operationRemission = OperationRemission::from('operation_remissions as or')
            ->join('operations as ope', 'or.operation_id', 'ope.id')
            ->join('remissions as rem', 'or.remission_id', 'rem.id')
            ->select('or.id', )
            ->where('rem.id', '=', $opRemission->remission_id)
            ->get();

            $remission = Remission::findOrFail($partial->remission_id);
            $remission->status = 'FINALIZADA';
            $remission->update();


        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('partial')->with('warning', 'Entrega Realizada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operating  $operating
     * @return \Illuminate\Http\Response
     */
    public function show(Operating $operating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operating  $operating
     * @return \Illuminate\Http\Response
     */
    public function edit(Operating $operating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperatingRequest  $request
     * @param  \App\Models\Operating  $operating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperatingRequest $request, Operating $operating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operating  $operating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operating $operating)
    {
        //
    }
}
