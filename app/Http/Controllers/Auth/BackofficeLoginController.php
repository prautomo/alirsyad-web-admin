<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class BackofficeLoginController extends Controller
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

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:backoffice')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.backoffice.login');
    }

    public function login(Request $request)
    {
        
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:5'
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // if (auth()->guard('backoffice')->attempt($request->only('email', 'password'))) {
        if (auth()->guard('backoffice')->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended(route('backoffice::dashboard'));
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }

    public function logout()
    {
        auth()->guard('backoffice')->logout();
        session()->flush();

        return redirect()->route('backoffice-login');
    }
}