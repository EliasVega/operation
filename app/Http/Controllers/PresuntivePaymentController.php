<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\OperatingPartial;
use App\Models\Partial;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class PresuntivePaymentController extends Controller
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
            $users = User::from('users AS use')
            ->join('companies AS com', 'use.company_id', 'com.id')
            ->join('documents AS doc', 'use.document_id', 'doc.id')
            ->join('roles AS rol', 'use.role_id', 'rol.id')
            ->select('use.id', 'use.name')
            ->where('use.status', '=', 'ACTIVO')
            ->where('use.role_id', '=', 4)
            ->get();

            return datatables()

            ->of($users)
            ->addColumn('btn', 'admin/presuntive/actions')
            ->rawcolumns(['btn'])
            ->toJson();
        }
        return view('admin.presuntive.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        $partials = Partial::from('partials as par')
        ->join('users as use', 'par.user_id', 'use.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->select('par.id', 'par.total', 'par.status', 'par.aprobation')
        ->where('use.id', '=', $id)
        ->where('par.status', '=', 'PENDIENTE')
        ->where('par.aprobation', '=', 'APROBADO')
        ->sum('par.total');
        $operatingPartials = OperatingPartial::from('operating_partials as op')
        ->join('operations as ope', 'op.operation_id', 'ope.id')
        ->join('operatings as oper', 'op.operating_id', 'oper.id')
        ->join('partials as par', 'op.partial_id', 'par.id')
        ->join('remissions as rem', 'par.remission_id', 'rem.id')
        ->select('op.id', 'rem.id as idR', 'par.user_id', 'ope.name', 'ope.price', 'op.quantity', 'op.subtotal', 'par.id as idP')
        ->where('par.user_id', '=', $id)
        ->where('op.status', 'PENDIENTE')
        ->get();

        $advan = Advance::where('user_id', '=', $id)
        ->where('status', '=', 'PENDIENTE')
        ->sum('amount');

        $advances = Advance::from('advances as adv')
        ->join('users as use', 'adv.user_id', 'use.id')
        ->join('users as user', 'adv.responsible_id', 'user.id')
        ->select('adv.id', 'adv.amount', 'adv.description', 'adv.created_at', 'use.name', 'user.name as nameR')
        ->where('adv.user_id', '=', $id)
        ->where('adv.status', '=', 'PENDIENTE')
        ->get();

        return view('admin.presuntive.show', compact('users', 'partials', 'operatingPartials', 'advances', 'advan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
