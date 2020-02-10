<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Voting\User;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backend.login');
    }

    public function login(Request $request)
    {
        // dd($request);
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            // dd('gf');
            return $this->sendLoginResponse($request);
        }
        // dd('fg');
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
         $admin= User::where('email',$request->email)->get();
        // dd($admin);
        if(count($admin)){
            // dd($admin);  
            foreach($admin as $a){
                if($a->status == 0){
                    // dd($a->status);  
                    return ['email'=>'inactive', 'password'=>'You are not an active member, please contact admin.'];
                }
                
                else{
                return ['email'=>$request->email,'password'=>$request->password,'status'=>1];
            }}
        }
        return $request->only($this->username(), 'password');
    }

    protected function sendFailedLoginResponse(Request $request)
    {

        $fields= $this->credentials($request);
        // dd($fields);
            if($fields['email']=='inactive'){
                
              $errors = $fields['password'];
            }
            else{

                $errors = [$this->username() => trans('auth.failed')];
            }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function guard(){
            // dd('df');
        return Auth::guard();
    }

    public function logout(Request $request)
    {        

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('admin-login');
    }

    // public function username()
    // {
    //     return 'username';
    // }
}
