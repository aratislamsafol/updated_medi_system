<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
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
        return view('admin.patient.index');
    }

    public function getall()
    {
        $user_data = User::orderBy('id','DESC')->latest()->get();

        return datatables($user_data)

          ->addColumn('created_at', function ($user_data) {
              if($user_data->created_at==null){
                  return 'this is null';
              }else{
                return $user_data->created_at->diffForHumans();
              }
          })
          ->addColumn('updated_at', function ($user_data) {
            if($user_data->updated_at==null){
                return 'this is null';
            }else{
              return $user_data->updated_at->diffForHumans();
            }
        })

        ->addColumn('action', 'admin.patient.action')
        ->make(true);
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = View::make('admin.patient.create')->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

        ]);

        $data = new User;
        $data->f_name = $request->f_name;
        $data->l_name = $request->l_name;
        $data->user_name = $request->f_name.rand(1,3000);
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->blood_group = $request->blood_group;
        $data->age = $request->age;
        $data->gender = $request->gender;
        $data->status = $request->status;
        $data->password = Hash::make($request->password);

        $data->save();
        return response()->json(['html' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient_data =User::find($id);
        $view = View::make('admin.patient.view', compact('patient_data'))->render();

        return response()->json(['html' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =User::find($id);
        $view = View::make('admin.patient.edit', compact('data'))->render();
        return response()->json(['html' => $view]);
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
        $data =User::find($id);
        $this->validate($request, [

        ]);
        $data->f_name = $request->f_name;
        $data->l_name = $request->l_name;
        $data->user_name = $request->f_name.rand(1,3000);
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->blood_group = $request->blood_group;
        $data->age = $request->age;
        $data->gender = $request->gender;
        $data->status = $request->status;
        $data->password = Hash::make($request->password);

        $data->save();
        return response()->json($data);
    }

     /**

      */
    // public function active(Request $request)
    // {
    //     $where = array('id' => $request->id);
    //     $company  = Coupon::where($where)->first();

    //     return Response()->json($company);

    //     // // dd($request->all());
    //     // $coupon =Coupon::find($id);
    //     // $this->validate($request, [

    //     // ]);
    //     // $coupon->status=$request->status;
    //     // // dd($coupon);
    //     // $coupon->save();
    //     // return response()->json($coupon);
    // }

    // public function store_active(Request $request){
    //     $companyId = $request->id;

    //     $company   =   Coupon::updateOrCreate(
    //                 [
    //                  'id' => $companyId
    //                 ],
    //                 [
    //                 'status' => 2,
    //                 ]);

    //     return Response()->json($company);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_del =User::find($id);
        $data_del->delete();
        return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
    }
}
