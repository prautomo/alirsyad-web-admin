<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\Models\District;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');    

Route::get("/verify-email", "Auth\RegisterController@verify")->name('verification.verify.email');

Route::get("/reset-password", "Auth\RegisterController@reset_password")->name('resetPassword');

Route::get("/tingkats/json", "API\TingkatController@index")->name('app.tingkat.json');
Route::get("/kelas/json", "API\KelasController@index")->name('app.kelas.json');

// route front office keur nu login (siswa/guru)
Route::middleware(['auth'])->group(function () {

    Route::get('/', "Front\HomeController@index")->name('app.home');
    Route::get('/mata-pelajaran', "Front\MataPelajaranController@index")->name('app.mapel.list');
    Route::get('/mata-pelajaran/upcoming', 'Front\MataPelajaranController@indexUpcoming')->name('app.mapel.upcoming');
    Route::get('/mata-pelajaran/passed', 'Front\MataPelajaranController@indexPassed')->name('app.mapel.passed');
    Route::get('/mata-pelajaran/{id}/by-tingkat', "Front\MataPelajaranController@indexByTingkat")->name('app.mapel.byTingkat');
    Route::get('/mata-pelajaran/{id}', "Front\MataPelajaranController@show")->name('app.mapel.detail');
    Route::get('/mata-pelajaran/{id}/modul', "Front\ModulController@indexByMapel")->name('app.mapel.modul');
    Route::get('/mata-pelajaran/{id}/video', "Front\VideoController@indexByMapel")->name('app.mapel.video');
    Route::get('/mata-pelajaran/{id}/simulasi', "Front\SimulasiController@indexByMapel")->name('app.mapel.simulasi');

    Route::get('/updates', "Front\UpdateController@index")->name('app.update');

    Route::get('/modul/{id}', "Front\ModulController@show")->name('app.modul.detail');
    Route::get('/video/{id}', "Front\VideoController@show")->name('app.video.detail');
    Route::get('/simulasi/{id}', "Front\SimulasiController@show")->name('app.simulasi.detail');
    // json res
    Route::get("/modul/{id}/json", "API\ModulController@show");
    Route::get("/video/{id}/json", "API\VideoController@show");

    Route::get("/nilai-simulasi", "Front\ScoreController@index")->name('app.nilai-simulasi');
    Route::get("/nilai-simulasi/mapels/json", "API\ScoreController@mapels");
    Route::get("/nilai-simulasi/mapels/{idMapel}/json", "API\ScoreController@progress");
    Route::post("/moduls/{id}/flag/json", "API\ModulController@createHistory");
    Route::post("/videos/{id}/flag/json", "API\VideoController@createHistory");
    Route::post("/simulasis/{id}/flag/json", "API\SimulasiController@createHistory");

    Route::get('/profile', "Front\UserController@profile")->name('app.akun-saya');
    Route::post('/profile/photo', "Front\UserController@profilePhoto")->name('app.akun-saya.photo');
    Route::get('/profile/edit', "Front\UserController@profileEdit")->name('app.akun-saya.profile-edit');
    Route::post('/profile/edit', "Front\UserController@profileUpdate")->name('app.akun-saya.profile-update');
    Route::get('/profile/password-edit', "Front\UserController@passwordEdit")->name('app.akun-saya.password-edit');
    Route::post('/profile/password-edit', "Front\UserController@passwordUpdate")->name('app.akun-saya.password-update');
    Route::post('/app/verification/resend',  function () {
        Auth::user()->sendEmailVerificationNotification();
        return redirect(url()->previous());
    });

    // Route::post("/app/image/upload" , "Front\HomeController@upload");
});
