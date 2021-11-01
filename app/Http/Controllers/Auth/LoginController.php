<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    // protected function authenticated(Request $request, $user){
    //     // Redirect admin to dashboard
    //     if($user->isAdmin()){
    //         return redirect(route('admin_dashboard'));
            
    //     }
    //     else if($user->isUser()){
    //         return redirect(route('home'));
    //     }

    //     abort(404);
    // }


    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            
            return redirect()->intended('home');
        
        }
        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
            'password' => 'Mot de passe incorrect!',
        ]);
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
