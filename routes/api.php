<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ExternalUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'login']);
Route::get("login", function (Request $request) {
    return "ok";
});
Route::post('register', [AuthController::class, 'register']);
Route::post('password/forgot', [AuthController::class, 'forgot']);

Route::get("/jenjangs", "API\JenjangController@index");
Route::get("/jenjangs/{id}", "API\JenjangController@show");

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('profile', [ExternalUserController::class, 'profile']);
    Route::post('profile', [ExternalUserController::class, 'profileUpdate']);
    Route::post('profile/password', [ExternalUserController::class, 'changePassword']);
    Route::post('upload/photo', [ExternalUserController::class, 'uploadPhoto']);
    Route::post('upload/photo/base64', [ExternalUserController::class, 'uploadImageBase64']);

    Route::get("/tingkats", "API\TingkatController@index");
    Route::get("/tingkats/{id}", "API\TingkatController@show");
    Route::get("/kelas", "API\KelasController@index");
    Route::get("/kelas/{id}", "API\KelasController@show");

    Route::get("/mata_pelajarans", "API\MataPelajaranController@index");
    Route::get("/mata_pelajarans/inprogress", "API\MataPelajaranController@inprogress");
    Route::get("/mata_pelajarans/upcoming", "API\MataPelajaranController@upcoming");
    Route::get("/mata_pelajarans/passed", "API\MataPelajaranController@passed");
    Route::get("/mata_pelajarans/active", "API\MataPelajaranController@active");
    Route::get("/mata_pelajarans/not-active", "API\MataPelajaranController@notActive");
    Route::get("/mata_pelajarans/{id}", "API\MataPelajaranController@show");
    Route::get("/mata_pelajarans/{id}/summary", "API\MataPelajaranController@summary");

    Route::get("/moduls", "API\ModulController@index");
    Route::get("/moduls/{id}", "API\ModulController@show")->name('api.modul.detail');
    Route::post("/moduls/{id}/flag", "API\ModulController@createHistory");

    Route::get("/videos", "API\VideoController@index");
    Route::get("/videos/{id}", "API\VideoController@show")->name('api.video.detail');
    Route::post("/videos/{id}/flag", "API\VideoController@createHistory");

    Route::get("/simulasis", "API\SimulasiController@index");
    Route::get("/simulasis/{id}", "API\SimulasiController@show")->name('api.simulasi.detail');
    Route::post("/simulasis/{id}/flag", "API\SimulasiController@createHistory");
    Route::post("/simulasis/{id}/score", "API\SimulasiController@createScore");

    Route::get("/nilai-simulasi", "API\ScoreController@index");
    Route::get("/nilai-simulasi/mapels", "API\ScoreController@mapels");
    Route::get("/nilai-simulasi/mapels/{idMapel}", "API\ScoreController@progress");

    Route::get("/home/banners", "API\BannerController@index");
    Route::get("/home/banners/{id}", "API\BannerController@show");

    Route::get("/home/updates", "API\UpdateController@index");
    Route::get("/home/tingkats", "API\TingkatController@userTingkat");
    Route::get("/home/tingkats/{id}", "API\MataPelajaranController@showByTingkat");

    Route::prefix('guru')->group(function() {
        Route::get("/dashboard", "API\DashboardController@index");
        Route::get("/dashboard/detail", "API\DashboardController@detail");
        Route::get("/ngajar", "API\DashboardController@guruNgajar");\

        Route::get('/simulasi/{id}/siswa', 'API\ScoreController@listNilaiSiswa');
        Route::get('/simulasi/{id}/nilai', 'API\ScoreController@nilaiSiswa');
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/moduls/upload", 'API\ModulController@upload');
Route::get("/moduls/anotasi/{id}", 'API\ModulController@getModulAnotasi');
