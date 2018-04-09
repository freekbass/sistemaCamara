<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller {
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username(): string {
        return 'email';
    }

    public function doLogin(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $response = array('valid' => true);
            return response()->json([$response], 200);
        } else {
            $response = array('valid' => false, 'message' => 'Login Inválido');
            return response()->json([$response], 422);
        }
    }

    public function doLogout(Request $request) {
        Auth::guard()->logout();
        $request->session()->invalidate();
        
        $response = array('valid' => true);
        return response()->json([$response]);
    }

}
