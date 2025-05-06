<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RequestUser;
use App\Models\User;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $requestUser = RequestUser::where('user_id', $user->id)->first();

            if ($requestUser) {
                if ($requestUser->status === 'PENDING') {
                    return redirect()->route('login')->with('error', 'Your registration is still pending. Please wait for approval.');
                } else if ($requestUser->status === 'DECLINED') {
                    return redirect()->route('login')->with('error', 'Your registration is declined. Please contact administrator.');
                }
            }
        }

        if ($this->attemptLogin($request)) {
            return redirect()->intended($this->redirectPath());
        }
    
        return redirect()->route('login')->with('error', 'Login failed. Please check your credentials.');
    }
}
