<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $preference = $user->preference;
        $expanseRange = explode('-',$preference->expected_income);

        $users = User::whereBetween('annual_income',[$expanseRange[0],$expanseRange[1]])->where('id','!=',$user->id)->where('occupation',$preference->occupation)->where('family_type',$preference->family_type);

        if($preference->manglik == "yes" || $preference->manglik == "no")
            $users =  $users->where('manglik',$preference->manglik);
        $users =  $users->get();

        return view('home',compact('users'));
    }

  
}
