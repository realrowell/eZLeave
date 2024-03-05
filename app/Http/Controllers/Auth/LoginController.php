<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

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
    protected $loginPath = '/';
    protected $redirectPath = '';
    protected $redirectAfterLogout = '/';


    public function admin_login(Request $request){
        $input = $request->all();
        $users = User::all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $this->configureRateLimiting();
    }

    protected function configureRateLimiting(){
        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(1);
        });
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
