<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:backoffice')->except('logout');
        $this->middleware('guest:guru')->except('logout');
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function login(Request $request)
    {   
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'], 'role' => "SISWA"))){
            return redirect()->route('app.home');
            // $user = Auth::user();
            // if($user->status === "AKTIF"){
            //     return redirect()->route('app.home');
            // }else{
            //     return redirect()->route('login')
            //     ->with('error','Login gagal, user belum diaktifkan. Hubungi admin untuk mengaktifkan akun anda.');
            // }
        }else{
            return redirect()->route('login')
                ->with('error','Login gagal, NIS atau Password tidak sesuai.');
        }
    }
}
