<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ExternalUser;
use App\Models\Product;
use App\Models\RequestPengambilanDana;
use App\Models\SubCategory;
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
        return view("app.Screen.customer.profile", [
            "user_data" => Auth::user()
        ]);
    }
    public function toko()
    {
        // dd(Auth::user());
        return view("app.Screen.mitra.toko", [

            "user_data" => Auth::user()
        ]);
        # code...
    }



    public function profileEdit()
    {
        $mitraDetail = ExternalUser::where("id", Auth::user()->id)->first();
        // dd(Auth::user());
        return view("app.Screen.user.update", [
            "mitra_detail" =>  $mitraDetail
        ]);
        # code...
    }
    public function profileUpdate(Request $request)
    {
        $mitraDetail = ExternalUser::where("id", Auth::user()->id)->first();

        $mitraDetail->update($request->only([
            "name",


        ]));


        return $this->returnStatus("200", "Info Toko Sudah Di Update");
    }



    public function passwordEdit()
    {
        $mitraDetail = ExternalUser::where("id", Auth::user()->id)->first();
        // dd(Auth::user());
        return view("app.Screen.user.ubahPassword", [
            "mitra_detail" =>  $mitraDetail
        ]);
        # code...
    }
    public function passwordUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'oldpassword' => [
                'required',
                function ($attribute, $value, $fail) {

                    $validate_admin = Auth::user();

                    if ($validate_admin && Hash::check($value, $validate_admin->password)) {
                        // here you know data is valid

                        return $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        Auth::user()->update(["password" => $validatedData['password']]);

        return redirect("/profile")->with('success', "Password Berhasil Di Ubah");;
    }


    public function requestTarikDana(Request $request)
    {
        $user = AUth::user();
        $saldo   = $user->saldo;

        if ($saldo <= 0) {
            return  $this->returnStatus("400", "Saldo Tidak Mencukupi");
        }

        return DB::transaction(function () use ($request,  $user,  $saldo) {


            $kodePengambilan =  "REQ/PENGAMBILAN" . date("ymdhis");
            $desc =   "Penarikan dana sebesar $saldo tanggal " . date("d-m-Y");

            RequestPengambilanDana::create([
                "user_id" => $user->id,
                "code" => $kodePengambilan,
                "description" => $desc,
                "amount" => $saldo,
                "status" => "NEW",
            ]);
            // reduceSaldo($amount, $code, $description = "", $status = "NEW")
            $user->reduceSaldo($saldo,  $kodePengambilan,  $desc, "NEW");
        });
        # code...
    }
}
