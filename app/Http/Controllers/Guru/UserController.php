<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profile()
    {
        return view("pages.guru.user.profile", [
            "user_data" => Auth::user()
        ]);
    }

    public function passwordEdit()
    {
        $userDetail = ExternalUser::where("id", Auth::user()->id)->first();
        // dd(Auth::user());
        return view("pages.guru.user.edit_password", [
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

        return redirect()->route('guru::akun-saya')->with(
            $this->success(__("Password Berhasil Di Ubah"), $data)
        );
    }
}
