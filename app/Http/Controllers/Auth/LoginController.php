<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home';
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if($this->loginNotAllowed($request)){
            return $this->sendLoginNotAllowedResponse($request);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function loginNotAllowed(Request $request) :bool {
        $this->user = User::where($this->username(), $request->input($this->username()))->first();
        if ($this->user === null){
            return false;
        }
        switch ($this->user->status){
            case 'normal':
                return false;
            case 'ban_forever':
                return true;
            case 'ban':
                return $this->stillBanned($this->user);
        }
    }

    public function stillBanned(User $user):bool {
        return $user->ban_time > time();
    }

    public function sendLoginNotAllowedResponse(Request $request){
        $time = ceil(( $this->user->ban_time - time()) / 86400);
        return response([
            'message' => "账号封停中，$time 天后允许登录，原因：" . $this->user->ban_reason
        ], 403);
    }


    public function sendLoginResponse(Request $request){
        return [
            'status'=>'success',
            'message'=>'登录成功',
            'data'=>Auth::user()->toArray()
        ];
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return [
            'status'=>'success',
            'message'=>'登出成功'
        ];
    }
}
