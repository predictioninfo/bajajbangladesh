<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    
    protected function credentials(Request $request)
        {

            //exit;

            //echo $request->email; exit;
            //   if($request->get('phone')){
            //     return ['phone'=>$request->get('phone'),'password'=>$request->get('password')];
            //   }
            //   elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            //     return ['email' => $request->get('email'), 'password'=>$request->get('password')];
            //   }
            //   return ['username' => $request->get('username'), 'password'=>$request->get('password')];


            $word = '@';
            $mystring = $request->get('email');
            // Test if string contains the word 
            if(strpos($mystring, $word) !== false){
                return ['email' => $request->get('email'), 'password'=>$request->get('password')];
            }
            
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];

        }
}
