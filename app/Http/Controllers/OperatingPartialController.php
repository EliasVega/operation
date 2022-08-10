<?php

namespace App\Http\Controllers;

use App\Models\OperatingPartial;
use App\Http\Requests\StoreOperatingPartialRequest;
use App\Http\Requests\UpdateOperatingPartialRequest;
use App\Models\Partial;
use App\Models\Payment;
use App\Models\Remission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatingPartialController extends Controller
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
            $operatingPartial = OperatingPartial::from('operating_partials as op')
            ->join('operations as ope', 'op.operation_id', 'ope.id')
            ->join('operatings as oper', 'op.operating_id', 'oper.id')
            ->join('partials as par', 'op.partial_id', 'par.id')
            ->join('remissions as rem', 'par.remission_id', 'rem.id')
            ->join('users as use', 'rem.user_id', 'use.id')
            ->select('op.id', 'op.quantity', 'op.price', 'op.subtotal', 'ope.name', 'rem.id as idR', 'use.name as nameU', 'par.id as idP', 'par.status')
            ->get();

            return datatables()
            ->of($operatingPartial)
            ->toJson();
        }
        return view('admin.operatingPartial.index');
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
     * @param  \App\Http\Requests\StoreOperatingPartialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperatingPartialRequest $request)
    {
        try {
            DB::beginTransaction();
            dd('xxxxxyyy');
            $bank = $request->bank_origin_id;
            $responsible = Auth::user()->id;
            $users = User::from('users as use')
            ->join('companies as com', 'use.company_id', 'com.id')
            ->join('documents as doc', 'use.document_id', 'doc.id')
            ->join('roles as rol', 'use.role_id', 'rol.id')
            ->join('banks as ban', 'use.bank_id', 'ban.id')
            ->join('payment_methods as pm', 'use.payment_method_id', 'pm.id')
            ->select('use.id', 'use.reference', 'use.status', 'use.position', 'ban.id as idB', 'pm.id as idPM')
            ->where('use.status', '=', 'ACTIVO')
            ->where('rol.id', '=', 4)
            ->get();
            foreach ($users as $use) {

                $partialTotal = Partial::where('user_id', '=', $use->id)->first();

                if ($partialTotal) {
                    $partials = Partial::from('partials as par')
                    ->join('remissions as rem', 'par.remission_id', 'rem.id')
                    ->join('users as use', 'par.user_id', 'use.id')
                    ->select('par.total', 'par.status', 'par.aprobation', 'use.id')
                    ->where('use.id', '=', $use->id)
                    ->where('par.status', '=', 'PENDIENTE')
                    ->where('par.aprobation', '=', 'APROBADO')
                    ->sum('par.total');
                    if ($partials > 0) {
                        $payment = new Payment();
                        $payment->amount = $partials;
                        $payment->reference = $use->reference;
                        $payment->bank_origin_id = $bank;
                        $payment->bank_id = $use->idB;
                        $payment->payment_method_id = $use->idPM;
                        $payment->user_id = $use->id;
                        $payment->responsible_id = $responsible;
                        $payment->save();

                        $partial = Partial::from('partials as par')
                        ->join('remissions as rem', 'par.remission_id', 'rem.id')
                        ->join('users as use', 'rem.user_id', 'use.id')
                        ->select('par.id', 'par.total', 'par.status', 'par.aprobation', 'use.id as idU')
                        ->where('use.id', '=', $use->id)
                        ->where('par.status', '=', 'PENDIENTE')
                        ->where('par.aprobation', '=', 'APROBADO')
                        ->get();

                        foreach ($partial as $par) {
                            $part = Partial::findOrFail($par->id);
                            $part->status     = 'CANCELADA';
                            $part->aprobation = 'PAGADO';
                            $part->payment_id = $payment->id;
                            $part->update();

                            $operpart = OperatingPartial::where('partial_id', '=', $part->id)->get();
                            foreach ($operpart as $op) {
                                $opepar = OperatingPartial::findOrFail($op->id);
                                $opepar->payment_id = $payment->id;
                                $opepar->update();
                            }
                            $remission = Remission::findOrFail($par->remission_id);
                            $partialall = Partial::where('remission_id', '=', $remission->id)
                            ->where('status', '=', 'PENDIENTE')
                            ->get();
                            $pall = count($partialall);
                            if ($pall == 0) {
                                $remission->status = 'CANCELADA';
                                $remission->update();
                            }
                        }
                    }
                }
            }
        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('payment')->with('warning', 'Nomina Generada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperatingPartial  $operatingPartial
     * @return \Illuminate\Http\Response
     */
    public function show(OperatingPartial $operatingPartial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OperatingPartial  $operatingPartial
     * @return \Illuminate\Http\Response
     */
    public function edit(OperatingPartial $operatingPartial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperatingPartialRequest  $request
     * @param  \App\Models\OperatingPartial  $operatingPartial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperatingPartialRequest $request, OperatingPartial $operatingPartial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperatingPartial  $operatingPartial
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperatingPartial $operatingPartial)
    {
        //
    }
}
