<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Document;
use App\Models\PaymentMethod;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $user = Auth::user()->role_id;
        if (request()->ajax()) {
            if ($user == 1) {
                $users = User::from('users AS use')
                ->join('companies AS com', 'use.company_id', 'com.id')
                ->join('documents AS doc', 'use.document_id', 'doc.id')
                ->join('roles AS rol', 'use.role_id', 'rol.id')
                ->select('use.id', 'use.name', 'doc.initials', 'use.number', 'use.address', 'use.phone', 'use.email', 'use.position', 'rol.role', 'use.status')
                ->where('use.status', '=', 'ACTIVO')
                ->get();
            } elseif ($user == 2) {
                $users = User::from('users AS use')
                ->join('companies AS com', 'use.company_id', 'com.id')
                ->join('documents AS doc', 'use.document_id', 'doc.id')
                ->join('roles AS rol', 'use.role_id', 'rol.id')
                ->select('use.id', 'use.name', 'doc.initials', 'use.number', 'use.address', 'use.phone', 'use.email', 'use.position', 'rol.role', 'use.status')
                ->where('use.status', '=', 'ACTIVO')
                ->where('rol.id', '!=', 1)
                ->get();
            }else{

                return redirect('remission')->with('warning', 'No tiene permisos para ingresar aqui');
            }

            return datatables()

            ->of($users)
            ->addColumn('btn', 'admin/user/actions')
            ->addColumn('delete', 'admin/user/delete')
            ->rawcolumns(['btn', 'delete'])
            ->toJson();
        }
        return view('admin.user.index');
    }

    public function inactive()
    {
        if (request()->ajax()) {
            $users = User::from('users AS use')
            ->join('documents AS doc', 'use.document_id', 'doc.id')
            ->join('roles AS rol', 'use.role_id', 'rol.id')
            ->select('use.id', 'use.name', 'doc.initials', 'use.number', 'use.address', 'use.phone', 'use.email', 'use.position', 'rol.role', 'use.status')
            ->where('use.status', '=', 'INACTIVE')
            ->get();

            return datatables()
            ->of($users)
            ->addColumn('btn', 'admin/user/active')
            ->rawcolumns(['btn'])
            ->toJson();
        }
        return view('admin.user.inactive');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->get();
        $documents = Document::get();
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $roles = Role::where('id', '!=', 1)->get();
        return view('admin.user.create', compact('companies', 'documents', 'roles', 'banks', 'paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->company_id = 1;
        $user->document_id = $request->document_id;
        $user->role_id = $request->role_id;
        $user->bank_id = $request->bank_id;
        $user->payment_method_id = $request->payment_method_id;
        $user->name = $request->name;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->position = $request->position;
        $user->reference = $request->reference;
        $user->status = 'ACTIVO';
        $user->save();

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function status($id)
    {
        $user = User::findOrFail($id);

        if ($user->status == 'ACTIVE') {
            $user->status = 'INACTIVE';
        } else {
            $user->status = 'ACTIVE';
        }
        $user->update();

        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies = Company::select('id', 'name')->get();
        $documents = Document::get();
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $roles = Role::where('id', '!=', 1)->get();
        return view('admin.user.edit', compact('user', 'companies', 'documents', 'roles', 'banks', 'paymentMethods'));
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
        $user = User::findOrFail($id);
        $user->company_id = 1;
        $user->document_id = $request->document_id;
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->position = $request->position;
        $user->status = 'ACTIVO';
        $user->update();

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('user')->with('success', 'Usuario Elinado ');
    }

    public function logout(Request $request)
    {
        if(session()->has('user'))
        {
            $request->session()->forget('user');
        }
        return redirect('login');
    }
}
