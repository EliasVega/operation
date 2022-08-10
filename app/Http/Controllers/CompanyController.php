<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Department;
use App\Models\Municipality;
use GuzzleHttp\Psr7\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('Administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $companies = company::where('id', '=', 1)->get();


        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        //$users = User::where('role_id', '=', 2)->get();
        return view('admin.company.create', compact('departments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new company();
        $company->department_id   = $request->department_id;
        $company->municipality_id = $request->municipality_id;
        $company->name            = $request->name;
        $company->nit             = $request->nit;
        $company->dv              = $request->dv;
        $company->address              = $request->address;
        $company->phone              = $request->phone;
        $company->mobile              = $request->mobile;
        $company->manager              = $request->manager;
        $company->email           = $request->email;
        //Handle File Upload
        if($request->hasFile('logo')){
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('logo')->guessClientExtension();
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            //Upload Image
            $path = $request->file('logo')->move('images/logos',$fileNameToStore);
            } else{
                $fileNameToStore="noimage.jpg";
            }
        $company->logo=$fileNameToStore;
        $company->save();

        return redirect('company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company        = Company::findOrfail($id);
        $departments    = Department::get();
        $municipalities = Municipality::get();
        return view("admin.company.edit", compact('company', 'departments', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrfail($id);
        $company->department_id   = $request->department_id;
        $company->municipality_id = $request->municipality_id;
        $company->name            = $request->name;
        $company->nit             = $request->nit;
        $company->dv              = $request->dv;
        $company->address              = $request->address;
        $company->phone              = $request->phone;
        $company->mobile              = $request->mobile;
        $company->manager              = $request->manager;
        $company->email           = $request->email;
        //Handle File Upload
        if($request->hasFile('logo')){
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('logo')->guessClientExtension();
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            //Upload Image
            $path = $request->file('logo')->move('images/logos',$fileNameToStore);
            } else{
                $fileNameToStore="noimage.jpg";
            }
        $company->logo=$fileNameToStore;
        $company->update();

        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function getmunicipalities(Request $request, $id)
    {
        if($request)
        {
            $municipalities = municipality::where('department_id', '=', $id)->get();

            return response()->json($municipalities);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('name');
       // \Session::forget('company');

        return redirect('admin/company');
    }
}
