<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginFormOfAdmin()
    {
        return view('auth.model-form-login', [
            'nameForm' => 'Login form of Admin',
            'roleSlugSystem' => Role::ROLE_SLUG_SYSTEM_ADMIN
        ]);
    }

    public function showLoginFormOfManager()
    {
        return view('auth.model-form-login', [
            'nameForm' => 'Login form of Manager',
            'roleSlugSystem' => Role::ROLE_SLUG_SYSTEM_MANAGER
        ]);
    }

    public function showLoginFormOfUser()
    {
        return view('auth.model-form-login', [
            'nameForm' => 'Login form of User',
            'roleSlugSystem' => Role::ROLE_SLUG_SYSTEM_USER
        ]);
    }

    public function myLogin(LoginFormRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $resultValidateRole = $this->validateRole($user, $request->input('role'));

        if( $resultValidateRole === true) {
            $sign = Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->has('remember'));

            if($sign) {
                return redirect()->route('site.home');
            }

            return redirect()->back()
                ->withInput($request->only(['email', 'remember']))
                ->withErrors([
                    'email' => 'Enter data for authentication not right. Try again.'
                ]);
        }

        return redirect()->route($resultValidateRole);

    }

    private function validateRole($user, $slugSystemRole)
    {
        $role = Role::where('slug_system', $slugSystemRole)->first();

        if(empty($role)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'Sorry, but there was an error that indicates that the form is working incorrectly. Please contact support for this site.'
            ]);

            return redirect()->back();
        }

        if($user->role_id != $role->id) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can sign in on site in form for entry user with role "' . $role->name . '" because you have a role "' . $user->role->name . '". You can sign in on site in this form.'
            ]);

            switch($user->role->slug_system){
                case Role::ROLE_SLUG_SYSTEM_ADMIN:
                    return 'auth.login_of_admin';
                case Role::ROLE_SLUG_SYSTEM_MANAGER:
                    return 'auth.login_of_manager';
                case Role::ROLE_SLUG_SYSTEM_USER:
                    return 'auth.login_of_user';
                default:
                    return 'auth.login_of_user';
            }
        }

        return true;
    }
}
