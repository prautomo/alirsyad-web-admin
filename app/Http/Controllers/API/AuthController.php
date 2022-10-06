<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordResetStudent;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Validator;

class AuthController extends BaseController
{

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $login_type = filter_var( $request->nis, FILTER_VALIDATE_EMAIL ) ? 'email' : 'nis';

        if($login_type == 'email'){
            $get_visitor = ExternalUser::where('email', $request->nis)->first();

            if($get_visitor['is_pengunjung'] == 1 && $get_visitor['email_verified_at'] == null){
                return $this->sendError('Unauthorised.', ['error'=>'Your email has not verified']);
            }
        }

        if(Auth::attempt([$login_type => $request->nis, 'password' => $request->password])){
            $user = Auth::user();
            // handle status belum aktif
            // if($user->status === 'AKTIF'){
                $generateToken = $user->createToken('MyAppDigiBook308');
                $success['token'] = @$generateToken->accessToken;
                $success['expires_at'] = @$generateToken->token->expires_at;
                $success['nis'] = @$user->nis;
                $success['name'] = @$user->name;
                $success['photo'] = @$user->photo ? asset($user->photo) : '';
                $success['email'] = @$user->email;
                $success['role'] = @$user->role;
                $success['kelas'] = @$user->kelas->name;
                $success['is_pengunjung'] = @$user->is_pengunjung;
                $success['tingkat'] = @$user->kelas->tingkat->name;
                $success['jenjang'] = @$user->kelas->tingkat->jenjang->name ?? @$user->jenjang->name;
                $success['status'] = @$user->status;

                return $this->sendResponse($success, 'User login successfully.');
            // }else {
            //     return $this->sendError('Maaf, status akun kamu : '.(str_replace('_', ' ', @$user->status)).'. Silahkan kontak administrator/guru.', ['error'=>'Unauthorised']);
            // }
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            // 'nis' => ['required', 'string', 'max:255', 'unique:external_users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:external_users'],
            'phone' => ['required', 'string', 'max:255', 'unique:external_users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'jenjang_id' => ['required', 'integer'],
            // 'user_type' => ['required', 'string', 'in:SISWA'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('User registered not successful.', $validator->errors());
        }

        $data = $request;

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
            'source_api_call' => $data['source_api_call'],
            'url_link' => 'http://127.0.0.1:8000/'
        ];
    
        \Mail::to($data['email'])->send(new \App\Mail\EmailVerificationMail($details));

        return $this->sendResponse($registerd, 'User registered successfully.');
    }

    
    public function verify(Request $request)
    {
        $update_email_verified_at = ExternalUser::where('email', $request->email)->update(['email_verified_at'=> now() ]);

        if($update_email_verified_at){
            return $this->sendResponse('', 'Your emaill has been verified.');
        }
    }

    public function forgot(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        // $credentials = $request->only(['email']);

        // Password::sendResetLink($credentials);

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token, $request->source_api_call)) {
            return $this->sendResponse([], 'Reset password link sent to your email.');
        }else{
            return $this->sendError('Failed to request password reset.');
        }
    }

    private function sendResetEmail($email, $token, $source)
    {
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($email);

        try {
            
            $details = [
                'title' => 'Reset Password Akun Al-Irsyad Edu!',
                'email' => $email,
                'token' => $token,
                'source_api_call' => $source    ,
                'url_link' => url('/')
            ];
        
            \Mail::to($email)->send(new \App\Mail\EmailForgotPasswordMail($details));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function reset(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        // $reset_password_status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), 
        // function ($user) use ($request) {
        //     $user->forceFill([
        //         'password' => Hash::make($request->password),
        //         'remember_token' => Str::random(60)
        //     ])->save();

        //     event(new PasswordReset($user));
        // });

        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);

        //Hash and update the new password
        $user->password = Hash::make($request->password);
        $updated_user = $user->update(); //or $user->save();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        if($updated_user){
            return $this->sendResponse([], "Password has been successfully changed.");
        }else{
            return $this->sendError('Failed to change password.', []);
        }

    }

    public function forgot_password_student(Request $request) {

        $validator = Validator::make($request->all(), [
            'nis' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        $data = $request;

        $list_nis = ExternalUser::where('role', 'SISWA')->pluck('nis')->all();

        if (!in_array( $data['nis'] , $list_nis )) {
            return $this->sendError('NIS is not registred', []);
        }

        $new_req = PasswordResetStudent::create([
            'external_user_id' => ExternalUser::where('nis', $data['nis'])->first()->id,
            'nis' => $data['nis']
        ]);

        if($new_req){
            return $this->sendResponse([], 'Reset password is requested.');
        }else{
            return $this->sendError('Failed to request password reset.', $new_req);
        }

    }
    

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
            return $this->sendResponse([], 'User logout successfully.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
