<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // $this->middleware('guest:admin')->except('logout');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'regex:/(0)[0-9]{10}/', 'unique:users'],
            'address' => ['required'],
            // photo max size 1MB
            // 'passport' => ['required', 'image', 'mimes:png,jpeg,jpg', 'max:1024'],
            // 'id_card' =>  ['required', 'image', 'mimes:png,jpeg,jpg', 'max:1024'],
            
        
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
        // $passport = $data['passport'];
        // $pass_name = date('Y_m_d_his') . $passport->getClientOriginalName();
        // $passport->move('images/users/passports', $pass_name);
        
        // $id_card = $data['id_card'];
        // $card_name = date('Y_m_d_his') . $id_card->getClientOriginalName();
        // $id_card->move('images/users/cards', $card_name);
        // dd($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            // 'passport' => $pass_name,
            // 'id_card' => $card_name,
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
    }



    // public function showAdminRegisterForm()
    // {
    //     return view('auth.register', ['url' => 'admin']);
    // }

    /**
     * Create a new admin instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Admin
     */
    // public function createAdmin(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $admin = Admin::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);

    //     return redirect()->intended('login/admin');
    // }
}
