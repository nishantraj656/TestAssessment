<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Preference;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'family_type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'annual_income' => ['required', 'numeric','digits_between:1,8'],
            'manglik' => ['required'],
            'occupation' => ['required'],
            'family_type' => ['required'],
            'expected_income'=> ['required'],
            'preference_occupation'=> ['required'],            
            'preference_family_type'=> ['required'],
            'preference_manglik'=> ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        DB::beginTransaction();
        $user =  User::create(
            [
                'first_name'=>$data['first_name'],
                 'last_name'=>$data['last_name'],
                 'email' => $data['email'],
                 'password' => Hash::make($data['password']),
                 'date_of_birth' => $data['date_of_birth'],
                 'gender' => $data['gender'],
                 'annual_income' => $data['annual_income'],
                 'occupation' => $data['occupation'],
                 'family_type' => $data['family_type'],
                 'manglik' => $data['manglik']
        ]);

        Preference::create(['user_id'=>$user->id, 'expected_income'=>$data['expected_income'], 'occupation'=>$data['preference_occupation'], 'family_type'=>$data['preference_family_type'], 'manglik'=>$data['preference_manglik']]);
        DB::commit();
        return $user;
    }
}
