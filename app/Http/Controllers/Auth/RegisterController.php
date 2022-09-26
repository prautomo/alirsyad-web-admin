<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\GenerateSlug;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'nis' => ['required', 'string', 'max:255', 'unique:external_users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:external_users'],
            'phone' => ['required', 'string', 'max:255', 'unique:external_users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'jenjang_id' => ['required', 'integer'],
            // 'user_type' => ['required', 'string', 'in:SISWA'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $registerd = ExternalUser::create([
            'nis' => $data['email'],
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => "SISWA",
            'is_pengunjung' => true,
            'jenjang_id' => $data['jenjang_id'],
        ]);

        
        $details = [
            'title' => 'Selamat Datang di Al-Irsyad Edu!',
            'email' => $data['email'],
            'url_link' => 'http://127.0.0.1:8000'
        ];
    
        \Mail::to($data['email'])->send(new \App\Mail\EmailVerificationMail($details));

        return $registerd;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')
                ->with('success', 'User registered successfully.');
    }

    /**
     * Verify email and updated email_verified_at.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function verify(Request $request)
    {
        $update_email_verified_at = ExternalUser::where('email', $request->email)->update(['email_verified_at'=> now() ]);

        if($update_email_verified_at){
            return redirect()->route('login')
                ->with('success', 'Your email has been verified.');
        }
    }
}
