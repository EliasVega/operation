<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Http\Requests\StoreAdvanceRequest;
use App\Http\Requests\UpdateAdvanceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdvanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
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
                $advances = Advance::from('advances as adv')
                ->join('users as use', 'adv.user_id', 'use.id')
                ->join('users as user', 'adv.responsible_id', 'user.id')
                ->select('adv.id', 'adv.amount', 'adv.description', 'adv.status', 'adv.created_at', 'use.name', 'user.name as nameR')
                ->where('adv.status', '=', 'PENDIENTE')
                ->get();
            } else {
                $advances = Advance::from('advances as adv')
                ->join('users as use', 'adv.user_id', 'use.id')
                ->join('users as user', 'adv.responsible_id', 'user.id')
                ->select('adv.id', 'adv.amount', 'adv.description', 'adv.status', 'adv.created_at', 'use.name', 'user.name as nameR')
                ->where('adv.status', '=', 'PENDIENTE')
                ->where('use.id', '=', $usid)
                ->get();
            }

            return datatables()
            ->of($advances)
            ->editColumn('created_at', function(Advance $advance){
                return $advance->created_at->format('yy-m-d');
            })
            ->addColumn('btn', 'admin/advance/actions')
            ->rawcolumns(['btn'])
            ->toJson();
        }
        return view('admin.advance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('admin.advance.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdvanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvanceRequest $request)
    {
        $advance = new Advance();
        $advance->amount = $request->amount;
        $advance->description = $request->description;
        $advance->user_id = $request->user_id;
        $advance->responsible_id = Auth::user()->id;
        $advance->save();

        return redirect('advance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $advance = Advance::from('advances as adv')
        ->join('users as use', 'adv.user_id', 'use.id')
        ->join('users as user', 'adv.responsible_id', 'user.id')
        ->select('adv.id', 'adv.amount', 'adv.description', 'adv.status', 'adv.created_at', 'use.name', 'user.name as nameR')
        ->where('adv.id', '=', $id)
        ->first();
        return view('admin.advance.edit', compact('advance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvanceRequest  $request
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvanceRequest $request, $id)
    {
        $advance = Advance::findOrFail($id);
        $advance->amount = $request->amount;
        $advance->description = $request->description;
        $advance->user_id = $request->user_id;
        $advance->responsible_id = Auth::user()->id;
        $advance->update();

        return redirect('advance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        //
    }
}
