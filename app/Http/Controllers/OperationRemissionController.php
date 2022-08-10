<?php

namespace App\Http\Controllers;

use App\Models\OperationRemission;
use App\Http\Requests\StoreOperationRemissionRequest;
use App\Http\Requests\UpdateOperationRemissionRequest;

class OperationRemissionController extends Controller
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
        //
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
     * @param  \App\Http\Requests\StoreOperationRemissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationRemissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperationRemission  $operationRemission
     * @return \Illuminate\Http\Response
     */
    public function show(OperationRemission $operationRemission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OperationRemission  $operationRemission
     * @return \Illuminate\Http\Response
     */
    public function edit(OperationRemission $operationRemission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationRemissionRequest  $request
     * @param  \App\Models\OperationRemission  $operationRemission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationRemissionRequest $request, OperationRemission $operationRemission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperationRemission  $operationRemission
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperationRemission $operationRemission)
    {
        //
    }
}
