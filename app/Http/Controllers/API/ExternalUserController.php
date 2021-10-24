<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ExternalUser;
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

        $user = Auth::user(); 

        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);

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

            return $this->sendResponse($success, 'User password updated successfully.');
        }else{
            return $this->sendResponse([], 'Failed to update password.');
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
}