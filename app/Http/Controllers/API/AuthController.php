<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
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
            if($user->status === 'AKTIF'){
                $generateToken = $user->createToken('MyAppDigiBook308');
                $success['token'] = @$generateToken->accessToken; 
                $success['expires_at'] = @$generateToken->token->expires_at; 
                $success['nis'] = @$user->nis; 
                $success['name'] = @$user->name;
                $success['kelas'] = @$user->kelas->name;
                $success['tingkat'] = @$user->kelas->tingkat->name;

                return $this->sendResponse($success, 'User login successfully.');
            }else {
                return $this->sendError('Maaf, status user kamu : '.$user->status.'. Silahkan kontak administrator/guru.', ['error'=>'Unauthorised']);
            }
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}