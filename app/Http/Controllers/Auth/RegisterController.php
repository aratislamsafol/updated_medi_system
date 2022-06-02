<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * @override
     * Show registrationform override
     * Compact Distric & Divison for Registration Page
     */
    public function showRegistrationForm()
    {
        $districts = District::orderBy('district_name', 'asc')->get();
        $divisions = Division::orderBy('priority', 'asc')->get();
        return view('auth.register',compact('districts','divisions'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'f_name' => $data['name'],
            'l_name' => $data['l_name'],
            'user_name' => $data['l_name'].rand(1, 3000),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'blood_group' => $data['blood_group'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            // 'photo' => $data['photo'],
            'status' => 1,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(40),
        ]);
    }
}
