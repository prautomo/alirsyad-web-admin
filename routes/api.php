<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;

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

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);

    Route::get("/tingkats", "API\TingkatController@index");
    Route::get("/tingkats/{id}", "API\TingkatController@show");

    Route::get("/mata_pelajarans", "API\MataPelajaranController@index");
    Route::get("/mata_pelajarans/inprogress", "API\MataPelajaranController@inprogress");
    Route::get("/mata_pelajarans/upcoming", "API\MataPelajaranController@upcoming");
    Route::get("/mata_pelajarans/passed", "API\MataPelajaranController@passed");
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

    Route::prefix('guru')->group(function() {
        Route::get("/dashboard", "API\DashboardController@index");
        Route::get("/dashboard/detail", "API\DashboardController@detail");
        Route::get("/ngajar", "API\DashboardController@guruNgajar");
    });
    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
