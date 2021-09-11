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

// Route::get('/product', "Front\ProductController@index");
// Route::get('/product/detail/{id}', "Front\ProductController@detail");

// Route::get('/cart', "Front\TransactionController@index");
// Route::get('/jasa', "Front\TransactionJasaController@index");
// Route::get("/article/read/{slug}", "Front\ArticleController@read");

// Route::get('/home/nearestmitra', "Front\HomeController@getNearestMitra");
// Route::get("/app/data/getunit",  "Front\HomeController@getAllUnit");
// Route::get("/app/data/getcategory",  "Front\HomeController@getAllCategoryWithSubCategory");
// Route::get("/app/data/getcategory/{category_id}", "Front\HomeController@getSubCategory");

// Route::get("/app/data/getsubcategory",  "Front\HomeController@getAllSubCategory");
// Route::get("/app/data/getproducts",  "Front\HomeController@getAllProducts");
// Route::get("/app/data/getbrand",  "Front\HomeController@getAllBrand");
// Route::get("/app/data/district", function () {
//     return District::all();
// });

// Route::get("/app/data/service", "Front\HomeController@getService");
// Route::get("/app/data/service/{service_id}", "Front\HomeController@getSubService");



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// route front office keur nu login (siswa/guru)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/', "Front\HomeController@index")->name('app.home');
    Route::get('/mata-pelajaran', "Front\MataPelajaranController@index")->name('app.mapel.list');
    Route::get('/mata-pelajaran/{id}', "Front\MataPelajaranController@show")->name('app.mapel.detail');
    Route::get('/mata-pelajaran/{id}/modul', "Front\VideoController@indexByMapel")->name('app.mapel.modul');
    Route::get('/mata-pelajaran/{id}/video', "Front\VideoController@indexByMapel")->name('app.mapel.video');
    Route::get('/mata-pelajaran/{id}/simulasi', "Front\SimulasiController@indexByMapel")->name('app.mapel.simulasi');

    Route::get('/video/{id}', "Front\VideoController@show")->name('app.video.detail');
    Route::get('/simulasi/{id}', "Front\SimulasiController@show")->name('app.simulasi.detail');
    // json res
    Route::get("/video/{id}/json", "API\VideoController@show");

    Route::get('/profile', "Front\UserController@profile")->name('home');
    Route::post('/app/verification/resend',  function () {
        Auth::user()->sendEmailVerificationNotification();
        return redirect(url()->previous());
    });


    // Route::post("/app/image/upload" , "Front\HomeController@upload");

});