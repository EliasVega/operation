<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Http\Requests\StoreMunicipalityRequest;
use App\Http\Requests\UpdateMunicipalityRequest;
use App\Models\Department;

class MunicipalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Superadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax())
        {
            $municipalities = municipality::from('municipalities AS mun')
            ->join('departments AS dep', 'mun.department_id', '=', 'dep.id')
            ->select('mun.id', 'mun.code', 'mun.name', 'dep.name AS nameD')
            ->get();
            return DataTables()::of($municipalities)
            ->addColumn('editar', 'admin/municipality/actions')
            ->rawColumns(['editar'])
            ->toJson();
        }
        return view('admin.municipality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        return view("admin.municipality.create", ["departments" => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMunicipalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMunicipalityRequest $request)
    {
        $municipality = new municipality();
        $municipality->department_id = $request->department_id;
        $municipality->code = $request->code;
        $municipality->name = $request->name;
        $municipality->save();
        return redirect('municipality');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show($municipality)
    {
        $municipality = municipality::findOrFail($municipality);
        return view("admin.municipality.show", compact('municipality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit($municipality)
    {
        $municipality = municipality::findOrFail($municipality);
        $departments = department::get();

        return view("admin.municipality.edit", compact('municipality', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMunicipalityRequest  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMunicipalityRequest $request, $municipality)
    {
        $municipality = municipality::findOrFail($municipality);
        $municipality->department_id = $request->department_id;
        $municipality->code = $request->code;
        $municipality->name = $request->name;
        $municipality->update();
        return redirect('municipality');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        //
    }
}
