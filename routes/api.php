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
    
    Route::get("/tingkats", "API\TingkatController@index");
    Route::get("/tingkats/{id}", "API\TingkatController@show");

    Route::get("/mata_pelajarans", "API\MataPelajaranController@index");
    Route::get("/mata_pelajarans/inprogress", "API\MataPelajaranController@inprogress");
    Route::get("/mata_pelajarans/upcoming", "API\MataPelajaranController@upcoming");
    Route::get("/mata_pelajarans/{id}", "API\MataPelajaranController@show");

    Route::get("/videos", "API\VideoController@index");
    Route::get("/videos/{id}", "API\VideoController@show");
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
