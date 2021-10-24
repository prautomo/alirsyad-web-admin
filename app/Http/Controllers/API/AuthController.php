<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
                $success['jenjang'] = @$user->kelas->tingkat->jenjang->name;

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
            return $this->returnStatus(400, $validator->errors());  
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

        return $this->sendResponse($registerd, 'User registered successfully.');
    }

    public function forgot(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());  
        }

        $credentials = $request->only(['email']);

        Password::sendResetLink($credentials);

        return $this->sendResponse([], 'Reset password link sent on your email id.');
    }

    public function reset(ResetPasswordRequest $request) {
        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->respondBadRequest(ApiCode::INVALID_RESET_PASSWORD_TOKEN);
        }

        return $this->respondWithMessage("Password has been successfully changed");
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