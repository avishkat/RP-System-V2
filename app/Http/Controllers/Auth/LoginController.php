<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers{
        attemptLogin as baseAttemptLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function attemptLogin(Request $request)
    {
        config(['database.connections.mysql.database' => $request->database]);
        
        return $this->baseAttemptLogin($request);
    }

    protected function authenticated(Request $request, $user)
    {
        session(['database' => $request->database]);
    }

    public function redirectTo(){
        if(Auth::user()->hasRole('admin')){
            $this->redirectTo = route('admin');
            return $this->redirectTo;
        }
        else if(Auth::user()->hasRole('supervisor')){
            $this->redirectTo = route('supervisor');
            return $this->redirectTo;
        }
        else if(Auth::user()->hasRole('student')){
            $this->redirectTo = route('student');
            return $this->redirectTo;
        }
        else{
            $this->redirectTo = route('login');
            return $this->redirectTo;
        }
    }

//    protected function validateLogin(Request $request)
//    {
//       $request->validate([
//          'database' => [
//             'required',
//             Rule::in(['db1', 'db2']),
//          ],
//          $this->username() => 'required|string',
//          'password' => 'required|string',
//       ]);
//    }

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
