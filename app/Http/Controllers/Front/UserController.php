<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\UploadService;

class UserController extends Controller
{

    public function profile()
    {
        return view("pages.frontoffice.user.profile", [
            "user_data" => Auth::user()
        ]);
    }

    public function profileEdit()
    {
        $mitraDetail = ExternalUser::where("id", Auth::user()->id)->first();
        // dd(Auth::user());
        return view("pages.frontoffice.user.edit_profile", [
            "mitra_detail" =>  $mitraDetail
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'email' => 'required|email|unique:external_users,email,'.$user->id,
        ]);

        $update = $request->only([
            "email"
        ]);
        $update['email_verified_at'] = null;

        $user->update($update);

        return redirect("/profile")->with('success', "Profile Berhasil Di Ubah");
    }

    public function passwordEdit()
    {
        $userDetail = ExternalUser::where("id", Auth::user()->id)->first();
        // dd(Auth::user());
        return view("pages.frontoffice.user.edit_password", [
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
        Auth::user()->update(["password" => Hash::make($validatedData['password'])]);

        Session::flush();
        
        Auth::logout();

        return redirect("/login")->with('success', "Password Berhasil Di Ubah");

        // return redirect("/profile")->with('success', "Password Berhasil Di Ubah");
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
        $user->update($update);

        return redirect("/profile")->with('success', "Profile Berhasil Di Ubah");
    }
}
