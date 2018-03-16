<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Login;
use LoginLog;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    $login_log = new LoginLog;
    $login_log->created_by = Auth::id();
    $login_log->updated_by = Auth::id();
    $login_log->user_sys = \Request::ip();
    $login_log->created_at = date('Y-m-d H:i:s');;
    $login_log->updated_at = date('Y-m-d H:i:s');;
    $result = $login_log->save();

    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userlogout']]);
    }
    
    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
