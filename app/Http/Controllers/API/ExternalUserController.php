<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\CloudinaryFileManager;
use App\Services\UploadService;
use Illuminate\Support\Facades\Hash;
use Validator;

class ExternalUserController extends BaseController
{
    /**
     * Profile api
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $user = Auth::user();

        $success['nis'] = @$user->nis;
        $success['name'] = @$user->name;
        $success['photo'] = @$user->photo ? asset($user->photo) : '';
        $success['email'] = @$user->email;
        $success['role'] = @$user->role;
        $success['kelas'] = @$user->kelas->name;
        $success['tingkat'] = @$user->kelas->tingkat->name;
        $success['jenjang'] = @$user->kelas->tingkat->jenjang->name ?? @$user->jenjang->name;
        $success['is_pengunjung'] = @$user->is_pengunjung;
        $success['status'] = @$user->status;

        return $this->sendResponse($success, 'User retrieved successfully.');
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();

        if(@$request->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:external_users,email,'.$user->id,
            ]);

            if ($validator->fails()) {
                return $this->returnStatus(400, $validator->errors());
            }

            $user->email = $request->email;
        }

        if(@$request->photo){
            $user->photo = $request->photo;
        }

        $user->save();

        $success['nis'] = @$user->nis;
        $success['name'] = @$user->name;
        $success['email'] = @$user->email;
        $success['photo'] = @$user->photo ? asset($user->photo) : '/images/placeholder.png';
        $success['role'] = @$user->role;
        $success['kelas'] = @$user->kelas->name;
        $success['tingkat'] = @$user->kelas->tingkat->name;
        $success['jenjang'] = @$user->kelas->tingkat->jenjang->name ?? @$user->jenjang->name;
        $success['is_pengunjung'] = @$user->is_pengunjung;
        $success['status'] = @$user->status;

        return $this->sendResponse($success, 'User updated successfully.');
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        $user = ExternalUser::find(Auth::user()->id);

        if(Hash::check($request->old_password, $user->password)){

            $user->update(['password' => Hash::make($request->new_password)]);

            $success['nis'] = @$user->nis;
            $success['name'] = @$user->name;
            $success['email'] = @$user->email;
            $success['photo'] = @$user->photo ? asset($user->photo) : '/images/placeholder.png';
            $success['role'] = @$user->role;
            $success['kelas'] = @$user->kelas->name;
            $success['tingkat'] = @$user->kelas->tingkat->name;
            $success['jenjang'] = @$user->kelas->tingkat->jenjang->name ?? @$user->jenjang->name;
            $success['is_pengunjung'] = @$user->is_pengunjung;
            $success['status'] = @$user->status;

            return $this->sendResponse($success, 'User password updated successfully.');
        }else{
            return $this->sendError('Failed to update password.');
        }
    }

    /**
     * Upload image from base64
     */
    public function uploadImageBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'base64_image' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        $success = [
            "image_url" => CloudinaryFileManager::saveImageBase64($request->base64_image, 'images'),
        ];

        return $this->sendResponse($success, 'Image uploaded.');
    }

    /**
     * Upload image from file
     */
    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2028'
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        $image = $request->file('file');
        $extension = $image->extension();
        $url = UploadService::uploadImage($image, 'file/photo');

        $success = [
            "image_path" => $url,
            "image_url" => asset($url),
        ];

        return $this->sendResponse($success, 'Image uploaded.');
    }

    
    public function deactiveProfile(Request $request)
    {
        $user_email = $request->email;
        $auth_user_email = Auth::user()->nis;

        $external_user = ExternalUser::where('email', $user_email)->first();

        if($external_user == null){
            return $this->sendError('User email not found.');
        }

        if($auth_user_email != $external_user->email){
            return $this->sendError('Failed to delete user.');
        }

        $user = User::where('username', $external_user->nis)->first();
        $external_user->nis = "DEL_" . date('Ymdhis');
        $external_user->username = "DEL_" . date('Ymdhis') . "_" . $external_user->username;
        $external_user->email = "DEL_" . date('Ymdhis') . "@sample.id";
        $external_user->save();
        $external_user->delete();

        $update_user = User::find(@$user->id);
        if ($update_user) {
            $update_user->username = "DEL_" . date('Ymdhis') . "_" . $external_user->username;
            $update_user->email = "DEL_" . date('Ymdhis') . "@sample.id";
            $update_user->save();
            $update_user->delete();
        }

        return $this->sendResponse([], 'User deleted.');
    }
}
