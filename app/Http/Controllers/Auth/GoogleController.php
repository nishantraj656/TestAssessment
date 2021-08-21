<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
         
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect()->route('home');
     
            }else{

                if(!$user->email)
                    return redirect()->route('register')->with("error","Email Not Found Try Other Method!.");
               
                $isExit = User::where('email',$user->email)->exists();

                if($isExit)
                {
                    /**
                     * If user register with email but want google 
                     */
                    User::where('email',$user->email)->update([ 'google_id'=> $user->id, 'email_verified_at'=>$user->verified_email? now():null ]);
                    $user = User::where('email',$user->email)->first();
                    Auth::login($user);     
                    return redirect()->route('home');
                }
                else
                {
                    return redirect()->route('login');
                }
               
            }
    
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('login');
        }
    }
}
