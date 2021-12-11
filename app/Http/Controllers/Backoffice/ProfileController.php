<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\User;
use App\Models\MataPelajaran;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        if(Auth::user()->hasRole('Guru Uploader')){
            $eu = ExternalUser::where("email", @$user->email)->first();
        }else{
            $eu = User::where("email", @$user->email)->first();
        }
        return view("pages.backoffice.profile.profile", [
            "user_data" => $eu,
        ]);
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran($guruId="", $jenjangId=null){
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        if($jenjangId){
            $mapels = $mapels->whereHas('tingkat', function($q2) use($jenjangId) {
                $q2->where('jenjang_id', $jenjangId);
            });
        }

        // // filter kalo mapel nya udah ada yg ngajar
        // $guruMengajar = GuruMataPelajaran::get();
        // // for edit
        // if(@$guruId){
        //     $guruMengajar = GuruMataPelajaran::where('guru_id', '!=', $guruId)->get();
        // }
        // $guruMengajar = $guruMengajar->pluck('mata_pelajaran_id');
        // $mapels = $mapels->whereNotIn('id', $guruMengajar);

        $mapels = $mapels->get();

        $mapelList = [];

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat ".@$mapel->tingkat->name." ".@$mapel->tingkat->jenjang->name.")";
        }

        return $mapelList;
    }

    public function profileEdit()
    {
        $user = Auth::user();
        if(Auth::user()->hasRole('Guru Uploader')){
            $eu = ExternalUser::with('kelas')->where("email", @$user->email)->firstOrFail();
        }else{
            $eu = User::where("email", @$user->email)->first();
            $eu->nis = @$eu->username;
        }

        $mapelList = $this->getMataPelajaran(@$user->id);

        $mapelIDS = [];
        foreach($eu->mataPelajarans as $mapel)
        {
            $mapelIDS[] = $mapel->id;
        }  

        $isUploader = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view("pages.backoffice.profile.edit_profile", [
            "data" =>  $eu,
            'mapelList' => $mapelList, 
            'mapelIDS' => $mapelIDS, 
            'isUploader' => $isUploader,
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();

        // for guru uploader
        if(\Auth::user()->hasRole('Guru Uploader')){
            $externalUser = ExternalUser::with('kelas')->where("email", @$user->email)->firstOrFail();
            $id = @$externalUser->id;
            $this->validate($request, [
                'nis' => 'required|unique:external_users,nis,'.$id,
                'name' => 'required',
                'email' => 'required|email|unique:external_users,email,'.$id,
            ]);
            
            // update ke table user jadi guru uploader
            $gu = User::where('username', $externalUser->nis)->first();

            $this->validate($request, [
                'nis' => 'required|unique:users,username,'.$gu->id,
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$gu->id,
            ]);

            $inputUploader['name'] = $input['name'];
            $inputUploader['username'] = $input['nis'];
            $inputUploader['email'] = $input['email'];
    
            $guruUploader = User::find(@$gu->id);

            if($guruUploader){
                // update guru uploader
                $guruUploader->update($inputUploader);
                
                if(@$request->mapel){
                    if(count(@$request->mapel) > 0){
                        // giuru uplaoder
                        $guruUploader->mataPelajarans()->sync($request->mapel);
                    }
                }
            }

            // update guru biasa
            $externalUser->update($input);

            if(@$request->mapel){
                if(count(@$request->mapel) > 0){
                    // guru
                    $externalUser->mataPelajarans()->sync($request->mapel);
                }
            }
        }
        // superadmin
        else {
            $gu = User::where('username', $request->nis)->first();

            $this->validate($request, [
                'nis' => 'required|unique:users,username,'.@$gu->id,
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.@$gu->id,
            ]);

            $inputUsr['name'] = $input['name'];
            $inputUsr['username'] = $input['nis'];
            $inputUsr['email'] = $input['email'];
    
            $usr = User::find(@$gu->id);
            // update guru uploader
            $usr->update($inputUsr);
        }

        return redirect()->route('backoffice::akun-saya')->with(
            $this->success(__("Akun Berhasil Di Ubah"), [])
        );
    }

    public function passwordEdit()
    {
        $userDetail = ExternalUser::where("id", Auth::user()->id)->first();
        return view("pages.backoffice.profile.edit_password", [
            "user_detail" =>  $userDetail
        ]);
    }

    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    $validate_admin = Auth::user();

                    if ($validate_admin && !Hash::check($value, $validate_admin->password)) {
                        // here you know data is valid
                        return $fail(($attribute) . ' is invalid.');
                    }
                },
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $pass = Hash::make($validatedData['password']);

        // update user password
        Auth::user()->update(["password" => $pass]);

        // update user guru password
        if(Auth::user()->hasRole('Guru Uploader')){
            $eu = ExternalUser::where('email', Auth::user()->email)->first();
            $externalUser = ExternalUser::find($eu->id);
            $input['password'] = $pass;
            $externalUser->update($input);
        }

        return redirect()->route('backoffice::akun-saya')->with(
            $this->success(__("Password Berhasil Di Ubah"), $validatedData)
        );
    }

    public function profilePhoto(Request $request){
        
        $validatedData = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2028'
        ]);

        $image = $request->file('file');
        $extension = $image->extension();
        $url = UploadService::uploadImage($image, 'file/photo');

        $update['photo'] = $url;

        $user = Auth::user();
        $eu = ExternalUser::where("email", @$user->email)->first();
        $eu->update($update);

        return redirect("/backoffice/profile")->with('success', "Profile Berhasil Di Ubah");
    }
}
