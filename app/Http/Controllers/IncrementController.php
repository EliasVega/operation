<?php

namespace App\Http\Controllers;

use App\Models\Increment;
use App\Http\Requests\StoreIncrementRequest;
use App\Http\Requests\UpdateIncrementRequest;
use App\Models\Operation;
use Illuminate\Support\Facades\DB;

class IncrementController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.increment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncrementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncrementRequest $request)
    {
        try {
            DB::beginTransaction();
             //trayendo variables del array
             $increment = $request->increment;

             $operations = Operation::get();

             foreach ($operations as $ope) {
                $operation = Operation::findOrFail($ope->id);

                $pold = $operation->price;
                $pinc = $pold * $increment/100;
                $pnew = $pold + $pinc;
                $operation->price = round($pnew);
                $operation->update();
             }


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('operation')->with('warning', 'Productos Actualizados con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function show(Increment $increment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function edit(Increment $increment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncrementRequest  $request
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncrementRequest $request, Increment $increment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Increment $increment)
    {
        //
    }
}
