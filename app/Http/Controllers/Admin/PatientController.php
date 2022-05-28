<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient=User::orderBy('id', 'asc')->get();

        if(request()->ajax()) {
            return datatables()->of($patient)

            ->addColumn('created_at', function ($patient){
            return $patient->created_at->diffForHumans();
            })
            ->addColumn('action', 'admin.patient.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.patient.index',compact('patient'));
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
        $companyId = $request->id;

        $company   =   User::updateOrCreate(
                    [
                     'id' => $companyId
                    ],
                    [
                    'f_name' => $request->f_name,
                    'l_name' => $request->l_name,
                    'user_name' => $request->f_name.rand(1, 3000),
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'division_id' => $request->division_id,
                    'district_id' => $request->district_id,
                    'blood_group' => $request->blood_group,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'status' => 1,
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(40),
                    ]);


        return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request)
    {
        $users =User::where('id',$request->id)->delete();

        return Response()->json($users);
    }
}
