<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Company;
use App\Models\OperatingPartial;
use App\Models\Partial;
use App\Models\PaymentMethod;
use App\Models\Remission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
                $payments = Payment::from('payments as pay')
                ->join('banks as ban', 'pay.bank_id', 'ban.id')
                ->join('banks as bank', 'pay.bank_origin_id', 'bank.id')
                ->join('payment_methods as pm', 'pay.payment_method_id', 'pm.id')
                ->join('users as use', 'pay.user_id', 'use.id')
                ->join('users as user', 'pay.responsible_id', 'user.id')
                ->select('pay.id', 'pay.amount', 'pay.discount', 'pay.total', 'pay.reference', 'ban.name as nameB', 'bank.name as nameBO', 'pm.name as nameP', 'use.name', 'user.name as nameU', 'pay.created_at')
                ->get();
            } else {
                $payments = Payment::from('payments as pay')
                ->join('banks as ban', 'pay.bank_id', 'ban.id')
                ->join('banks as bank', 'pay.bank_origin_id', 'bank.id')
                ->join('payment_methods as pm', 'pay.payment_method_id', 'pm.id')
                ->join('users as use', 'pay.user_id', 'use.id')
                ->join('users as user', 'pay.responsible_id', 'user.id')
                ->select('pay.id', 'pay.amount', 'pay.discount', 'pay.total', 'pay.reference', 'ban.name as nameB', 'bank.name as nameBO', 'pm.name as nameP', 'use.name', 'user.name as nameU', 'pay.created_at')
                ->wher('use.id', '=', $usid)
                ->get();
            }



            return datatables()
            ->of($payments)
            ->editColumn('created_at', function(Payment $payment){
                return $payment->created_at->format('yy-m-d');
            })
            ->addColumn('edit', 'admin/payment/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks   = Bank::get();
        $paymentMethods = PaymentMethod::get();
        //$users   = User::get();
        $users = User::from('users as use')
        ->join('companies as com', 'use.company_id', 'com.id')
        ->join('documents as doc', 'use.document_id', 'doc.id')
        ->join('roles as rol', 'use.role_id', 'rol.id')
        ->join('banks as ban', 'use.bank_id', 'ban.id')
        ->join('payment_methods as pm', 'use.payment_method_id', 'pm.id')
        ->select('use.id', 'use.name', 'use.reference', 'ban.name as nameB', 'pm.name as namePM')
        ->where('use.status', '=', 'ACTIVO')
        ->where('rol.id', '=', 4)
        ->get();
        return view('admin.payment.create', compact('banks', 'paymentMethods', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        try {
            DB::beginTransaction();

            $user_id = $request->user_id;
            $payment_method_id = $request->payment_method_id;
            $bank_origin_id = $request->bank_origin_id;
            $bank_id = $request->bank_id;
            $reference = $request->reference;
            $responsible_id = Auth::user()->id;

            $cont = 0;
            while($cont < count($user_id)){

                $partials = Partial::where('user_id', '=', $user_id[$cont])
                ->where('status', '=', 'PENDIENTE')
                ->where('aprobation', '=', 'APROBADO')
                ->sum('total');

                $advances = Advance::where('user_id', '=', $user_id[$cont])
                ->where('status', '=', 'PENDIENTE')
                ->sum('amount');

                if ($partials > 0) {
                    $payment = new Payment();
                    $payment->amount = $partials;
                    $payment->discount = $advances;
                    $payment->total = $partials - $advances;
                    $payment->reference = $reference[$cont];
                    $payment->bank_origin_id = $bank_origin_id[$cont];
                    $payment->bank_id = $bank_id[$cont];
                    $payment->payment_method_id = $payment_method_id[$cont];
                    $payment->user_id = $user_id[$cont];
                    $payment->responsible_id = $responsible_id;
                    $payment->save();

                    $partial = Partial::where('user_id', '=', $user_id[$cont])
                    ->where('status', '=', 'PENDIENTE')
                    ->where('aprobation', '=', 'APROBADO')
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
                            $opepar->status = 'PAGADO';
                            $opepar->payment_id = $payment->id;
                            $opepar->update();
                        }
                        $remission = Remission::findOrFail($par->remission_id);
                        $partialall = Partial::where('aprobation', '=', 'APROBADO')
                        ->where('remission_id', '=', $remission->id)
                        ->get();
                        if ($remission->status == 'FINALIZADA') {
                            if (!empty($partialall)) {
                                $remission->status = 'CANCELADA';
                                $remission->update();
                            }
                        }
                    }
                    $advan = Advance::where('user_id', '=', $user_id[$cont])
                    ->where('status', '=', 'PENDIENTE')
                    ->get();
                    foreach ($advan as $adv) {
                        $advancy = Advance::findOrFail($adv->id);
                        $advancy->status     = 'CANCELADO';
                        $advancy->payment_id = $payment->id;
                        $advancy->update();
                    }
                }
                $cont ++;
            }
        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('payment')->with('warning', 'Nomina Generada con exito');
    }

    public function storeCreate()
    {
        $banks   = Bank::get();
        return view('admin.payment.storeCreate', compact('banks'));
    }


    public function storetotal(StorePaymentRequest $request)
    {

        try {
            DB::beginTransaction();

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

                    $advances = Advance::where('user_id', '=', $use->id)
                    ->where('status', '=', 'PENDIENTE')
                    ->sum('amount');
                    if ($partials > 0) {
                        $payment = new Payment();
                        $payment->amount = $partials;
                        $payment->discount = $advances;
                        $payment->total = $partials - $advances;
                        $payment->reference = $use->reference;
                        $payment->bank_origin_id = $bank;
                        $payment->bank_id = $use->idB;
                        $payment->payment_method_id = $use->idPM;
                        $payment->user_id = $use->id;
                        $payment->responsible_id = $responsible;
                        $payment->save();

                        $partial = Partial::where('user_id', '=', $use->id)
                        ->where('status', '=', 'PENDIENTE')
                        ->where('aprobation', '=', 'APROBADO')
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
                                $opepar->status = 'PAGADO';
                                $opepar->payment_id = $payment->id;
                                $opepar->update();

                            }
                            $remission = Remission::findOrFail($par->remission_id);
                            $partialall = Partial::where('aprobation', '=', 'APROBADO')
                            ->where('remission_id', '=', $remission->id)
                            ->get();
                            if ($remission->status == 'FINALIZADA') {
                                if (!empty($partialall)) {
                                    $remission->status = 'CANCELADA';
                                    $remission->update();
                                }
                            }
                        }
                        $advan = Advance::where('user_id', '=', $use->id)
                        ->where('status', '=', 'PENDIENTE')
                        ->get();
                        foreach ($advan as $adv) {
                            $advancy = Advance::findOrFail($adv->id);
                            $advancy->status     = 'CANCELADO';
                            $advancy->payment_id = $payment->id;
                            $advancy->update();
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pay = Payment::findOrFail($id);
        $payment = Payment::from('payments as pay')
        ->join('banks as ban', 'pay.bank_id', 'ban.id')
        ->join('payment_methods as pm', 'pay.payment_method_id', 'pm.id')
        ->join('users as use', 'pay.user_id', 'use.id')
        ->join('users as user', 'pay.responsible_id', 'user.id')
        ->select('pay.id', 'pay.amount', 'ban.name as nameB', 'pm.name as nameP', 'use.name', 'user.name as nameU', 'pay.created_at')
        ->where('pay.id', '=', $pay->id)
        ->first();
        $operatingPartials = OperatingPartial::from('operating_partials as op')
        ->join('operations as ope', 'op.operation_id', 'ope.id')
        ->join('operatings as oper', 'op.operating_id', 'oper.id')
        ->join('partials as par', 'op.partial_id', 'par.id')
        ->join('payments as pay', 'op.payment_id', 'pay.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->select('op.id', 'op.quantity', 'op.price', 'op.subtotal', 'ope.name as nameO', 'pay.id as idP', 'pay.id as idPay', 'rem.id as idR')
        ->where('pay.id', '=', $pay->id)
        ->get();

        $advan = Advance::where('payment_id', '=', $id)
        ->sum('amount');

        $advances = Advance::from('advances as adv')
        ->join('users as use', 'adv.user_id', 'use.id')
        ->join('users as user', 'adv.responsible_id', 'user.id')
        ->select('adv.id', 'adv.amount', 'adv.description', 'adv.created_at', 'use.name', 'user.name as nameR')
        ->where('adv.payment_id', '=', $id)
        ->get();

        return view('admin.payment.show', compact('payment', 'operatingPartials', 'advances', 'advan'));
    }

    public function showPdfPayment($id)
    {
        $company = Company::from('companies AS com')
        ->join('departments AS dep', 'com.department_id', '=', 'dep.id')
        ->join('municipalities AS mun', 'com.municipality_id', '=', 'mun.id')
        ->select('com.id', 'com.name', 'com.nit', 'com.dv', 'com.address', 'com.email', 'com.phone', 'com.mobile', 'com.logo', 'dep.name AS department', 'mun.name AS municipality')
        ->where('com.id', '=', 1)
        ->first();

        /*mostrar detalles*/
        $pay = Payment::findOrFail($id);
        $payment = Payment::from('payments as pay')
        ->join('banks as ban', 'pay.bank_id', 'ban.id')
        ->join('payment_methods as pm', 'pay.payment_method_id', 'pm.id')
        ->join('users as use', 'pay.user_id', 'use.id')
        ->join('users as user', 'pay.responsible_id', 'user.id')
        ->select('pay.id', 'pay.amount', 'ban.name as nameB', 'pm.name as nameP', 'use.name', 'use.number', 'use.address', 'user.email', 'use.phone', 'user.name as nameU', 'pay.created_at')
        ->where('pay.id', '=', $pay->id)
        ->first();
        $operatingPartials = OperatingPartial::from('operating_partials as op')
        ->join('operations as ope', 'op.operation_id', 'ope.id')
        ->join('operatings as oper', 'op.operating_id', 'oper.id')
        ->join('partials as par', 'op.partial_id', 'par.id')
        ->join('payments as pay', 'op.payment_id', 'pay.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->select('op.id', 'op.quantity', 'op.price', 'op.subtotal', 'ope.name as nameO', 'pay.id as idP', 'pay.id as idPay', 'rem.id as idR', 'par.id as idPar')
        ->where('pay.id', '=', $pay->id)
        ->get();

        $user = Auth::user()->name;

        $advan = Advance::where('payment_id', '=', $id)
        ->sum('amount');

        $advances = Advance::from('advances as adv')
        ->join('users as use', 'adv.user_id', 'use.id')
        ->join('users as user', 'adv.responsible_id', 'user.id')
        ->select('adv.id', 'adv.amount', 'adv.description', 'adv.created_at', 'use.name', 'user.name as nameR')
        ->where('adv.payment_id', '=', $id)
        ->get();

        $paymentpdf = "PAGO-". $pay->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.payment.pdf', compact('payment', 'operatingPartials', 'company', 'logo', 'advances', 'advan'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$paymentpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::from('payments as pay')
        ->join('users as use', 'pay.user_id', 'use.id')
        ->select('pay.id', 'pay.reference', 'use.name')
        ->where('pay.id', '=', $id)
        ->first();
        $banks   = Bank::get();
        $paymentMethods = PaymentMethod::get();
        //$users   = User::get();
        $users = User::from('users as use')
        ->join('companies as com', 'use.company_id', 'com.id')
        ->join('documents as doc', 'use.document_id', 'doc.id')
        ->join('roles as rol', 'use.role_id', 'rol.id')
        ->join('banks as ban', 'use.bank_id', 'ban.id')
        ->select('use.id', 'use.name', 'use.number', 'ban.name as nameB')
        ->where('use.status', '=', 'ACTIVO')
        ->where('rol.id', '=', 4)
        ->get();

        return view('admin.payment.edit', compact('banks', 'paymentMethods', 'users', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        try {
            DB::beginTransaction();

            $user_id = $request->user_id;
            $payment_method_id = $request->payment_method_id;
            $bank_origin_id = $request->bank_origin_id;
            $bank_id = $request->bank_id;
            $reference = $request->reference;
            $responsible_id = Auth::user()->id;

            $cont = 0;
            while($cont < count($user_id)){

                $partials = Partial::where('user_id', '=', $user_id[$cont])
                ->where('status', '=', 'PENDIENTE')
                ->where('aprobation', '=', 'APROBADO')
                ->sum('total');

                if ($partials > 0) {
                    $payment = new Payment();
                    $payment->amount = $partials;
                    $payment->reference = $reference[$cont];
                    $payment->bank_origin_id = $bank_origin_id[$cont];
                    $payment->bank_id = $bank_id[$cont];
                    $payment->payment_method_id = $payment_method_id[$cont];
                    $payment->user_id = $user_id[$cont];
                    $payment->responsible_id = $responsible_id;
                    $payment->save();

                    $partial = Partial::where('user_id', '=', $user_id[$cont])
                    ->where('status', '=', 'PENDIENTE')
                    ->where('aprobation', '=', 'APROBADO')
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
                        $partialall = Partial::where('aprobation', '=', 'APROBADO')
                        ->where('remission_id', '=', $remission->id)
                        ->get();
                        if ($remission->status == 'FINALIZADA') {
                            if (!empty($partialall)) {
                                $remission->status = 'CANCELADA';
                                $remission->update();
                            }
                        }
                    }

                }
                $cont ++;
            }
        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('payment')->with('warning', 'Nomina Generada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
