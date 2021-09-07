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


    Route::get('/profile', "Front\UserController@profile")->name('home');
    Route::post('/app/verification/resend',  function () {
        Auth::user()->sendEmailVerificationNotification();
        return redirect(url()->previous());
    });


    // Route::post("/app/image/upload" , "Front\HomeController@upload");


    // Route::get("/customer/transaction/{status}", "Front\TransactionController@customerTransactionView");
    // Route::get("/customer/transaction/{status}/data", "Front\TransactionController@customerTransaction");
    // Route::get("/customer/jasa/transaction/{status}", "Front\TransactionJasaController@customerTransactionView");
    // Route::get("/customer/jasa/transaction/{status}/data", "Front\TransactionJasaController@customerTransaction");



    // Route::get('/toko', "Front\UserController@toko")->name('toko');
    // Route::get("/toko/transaction/{status}", "Front\TransactionController@mitraTransactionView");
    // Route::get("/toko/transaction/{status}/data", "Front\TransactionController@mitraTransaction");
    // Route::get("/jasa/transaction/{status}", "Front\TransactionJasaController@mitraTransactionView");
    // Route::get("/jasa/transaction/{status}/data", "Front\TransactionJasaController@mitraTransaction");


    // Route::get("/toko/update", "Front\TokoController@edit");
    // Route::post("/toko/update", "Front\TokoController@update");


    // Route::resource("/toko/product", "Front\TokoProductController");
    // Route::post("/toko/product/{id}/delete" , "Front\TokoProductController@delete");
    // Route::resource("/toko/promo", "Front\PromoMitraController");
    // Route::post("/toko/promo/{id}/delete" , "Front\PromoMitraController@delete");

    // Route::get("/jasa/update", "Front\TokoController@jasaEdit");
    // Route::post("/jasa/update", "Front\TokoController@jasaUpdate");

    // Route::get("/profile/edit", "Front\UserController@profileEdit");
    // Route::post("/profile/update", "Front\UserController@profileUpdate");

    // Route::get("/profile/ubah_password", "Front\UserController@passwordEdit");
    // Route::post("/profile/ubah_password", "Front\UserController@passwordUpdate");





    // Route::middleware(['verified'])->group(function () {

    //     Route::post("/app/saldo/requestTarikDana" , "Front\UserController@requestTarikDana");
    //     Route::get("/app/data/getmypromos",  "Front\HomeController@getMyPromos");
    //     Route::post("/mitra/updatepesanan", "Front\TransactionController@mitraUpdateTransaction");
    //     Route::post("/customer/updatepesanan", "Front\TransactionController@customerUpdateTransaction");
    //     Route::post("/app/validatevoucher", "Front\PromoController@validateVoucher");
    //     Route::post("/app/postcheckout", "Front\TransactionController@createTransaction");
    //     Route::post("/app/checkoutjasa", "Front\TransactionJasaController@createTransaction");


    //     Route::post("/mitra/jasa/updatepesanan", "Front\TransactionJasaController@mitraUpdateTransaction");
    //     Route::post("/customer/jasa/updatepesanan", "Front\TransactionJasaController@customerUpdateTransaction");
    // });
});



// Route::get('/toko/{id}', "Front\ProductController@detailToko");
