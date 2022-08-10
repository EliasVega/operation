<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Http\Requests\StoreOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use App\Models\Category;

class OperationController extends Controller
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
            $operations = Operation::from('operations as ope')
            ->join('categories as cat', 'ope.category_id', 'cat.id')
            ->select('ope.id', 'ope.name', 'ope.price', 'ope.stock', 'ope.status', 'cat.name as nameC')
            ->get();

            return datatables()
            ->of($operations)
            ->addColumn('editar', 'admin/operation/actions')
            ->rawColumns(['editar'])
            ->toJson();
        }
        return view('admin.operation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        return view('admin.operation.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationRequest $request)
    {
        $operation = new Operation();
        $operation->category_id = $request->category_id;
        $operation->name   = $request->name;
        $operation->price  = $request->price;
        $operation->stock  = 0;
        $operation->status = 'ACTIVA';
        $operation->save();

        return redirect('operation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::get();
        $operation = Operation::findOrFail($id);
        return view('admin.operation.edit', compact('operation', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationRequest  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationRequest $request, $id)
    {
        $operation = Operation::findOrFail($id);
        $operation->name   = $request->name;
        $operation->price  = $request->price;
        $operation->status = 'ACTIVA';
        $operation->update();

        return redirect('operation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        //
    }
}
