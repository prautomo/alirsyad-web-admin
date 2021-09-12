<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class GuruLoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::DASHBOARD_GURU;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:guru')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.guru.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:5'
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        if (auth()->guard('guru')->attempt(array($fieldType => $input['email'], 'password' => $input['password'], 'role' => "GURU"))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended(route('guru::dashboard'));
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
        auth()->guard('guru')->logout();
        session()->flush();

        return redirect()->route('guru-login');
    }
}