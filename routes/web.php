<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

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

// Routes backoffice
Route::get('backoffice/login','Auth\BackofficeLoginController@showLoginForm');
Route::post('backoffice/login', ['as' => 'backoffice-login', 'uses' => 'Auth\BackofficeLoginController@login']);
Route::post('backoffice/logout', ['as' => 'backoffice-logout', 'uses' => 'Auth\BackofficeLoginController@logout']);

Route::name('backoffice::')->prefix('backoffice')->middleware(['auth:backoffice'])->namespace('Backoffice')
->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tingkats', 'TingkatController');
    Route::get('kelas/listJson', 'KelasController@listJson')->name('kelas.listJson');
    Route::resource('kelas', 'KelasController');
    
    Route::resource('simulasis', 'SimulasiController');
    Route::resource('kontens', 'KontenController');

    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('mata_pelajarans', 'MataPelajaranController');

    Route::get('external-users/batch_create',  "ExternalUserController@batchImport")->name('external-users.batch_create');
    Route::post('external-users/import', 'ExternalUserController@import')->name('external-users.import');
    Route::resource('external-users', 'ExternalUserController');
    Route::post('external-users/update-status/{id}', 'ExternalUserController@updateStatus')->name('external-users.update-status');

    // Route::name('sub_categories.')->prefix('kelas/{categoryId}/mata_pelajarans')->group(function() {
    //     Route::get('/', 'SubCategoryController@index')->name('index');
    //     Route::get('/create', 'SubCategoryController@create')->name('create');
    //     Route::post('/create', 'SubCategoryController@store')->name('store');
    //     Route::get('/edit/{id}', 'SubCategoryController@edit')->name('edit');
    //     Route::put('/update/{id}', 'SubCategoryController@update')->name('update');
    //     Route::delete('/destroy', 'SubCategoryController@destroy')->name('destroy');
    // });
    // Route::resource('services', 'ServiceController');
    // Route::name('sub-services.')->prefix('services/{serviceId}/sub')->group(function() {
    //     Route::get('/', 'SubServiceController@index')->name('index');
    //     Route::get('/create', 'SubServiceController@create')->name('create');
    //     Route::post('/create', 'SubServiceController@store')->name('store');
    //     Route::get('/edit/{id}', 'SubServiceController@edit')->name('edit');
    //     Route::put('/update/{id}', 'SubServiceController@update')->name('update');
    //     Route::delete('/destroy', 'SubServiceController@destroy')->name('destroy');
    // });
    // Route::resource('payment-methods', 'PaymentMethodController');
    // Route::resource('brands', 'BrandController');
    // Route::resource('banners', 'BannerController');
    // Route::resource('promos', 'PromoController');
    // Route::resource('articles', 'ArticleController');
    // Route::name('history-saldo.')->prefix('external-users/{userId}/history-saldo')->group(function() {
    //     Route::get('/', 'HistorySaldoController@index')->name('index');
    //     Route::get('/create', 'HistorySaldoController@create')->name('create');
    //     Route::post('/create', 'HistorySaldoController@store')->name('store');
    // });
    // Route::name('products.')->prefix('external-users/{userId}/products')->group(function() {
    //     Route::get('/', 'ProductController@index')->name('index');
    //     Route::get('/create', 'ProductController@create')->name('create');
    //     Route::post('/create', 'ProductController@store')->name('store');
    //     Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
    //     Route::put('/update/{id}', 'ProductController@update')->name('update');
    //     Route::delete('/destroy', 'ProductController@destroy')->name('destroy');
    // });
    
    // Route::get("request-pengambilan-dana",  "RequestPengambilanDanaController@index")->name('request-pengambilan-dana.index');
    // Route::post('request-pengambilan-dana/{id}', 'RequestPengambilanDanaController@changeStatus')->name('request-pengambilan-dana.changeStatus');

    // Route::get("mitras",  "ExternalUserController@getMitras");

    // Route::post("upload/image",  "FileUploadController@uploadImageFile");
    // Route::post("upload/base64",  "FileUploadController@uploadImageBase64");
    // Route::post("batchproductmitra/upload",  "ImportController@doUploadBatch");
});

Route::get('/clear-cache', function() {
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want

    return "clear cache success.";
});