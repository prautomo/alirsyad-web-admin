<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Guru Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes guru
Route::get('guru/login','Auth\GuruLoginController@showLoginForm');
Route::post('guru/login', ['as' => 'guru-login', 'uses' => 'Auth\GuruLoginController@login']);
Route::post('guru/logout', ['as' => 'guru-logout', 'uses' => 'Auth\GuruLoginController@logout']);

Route::name('guru::')->prefix('guru')->middleware(['auth:guru'])->namespace('Guru')
->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.detail');

    Route::get('progress', 'ProgressController@index')->name('progress.siswa');
    Route::get('progress/{mapelId}/detail/{siswaId}', 'ProgressController@detailSiswa')->name('progress.detail-siswa');

    Route::get('simulasi-percobaan/{simulasiId}/detail', 'ProgressController@historyPercobaan')->name('simulasi.percobaan-siswa');

    Route::get('/profile', "UserController@profile")->name('akun-saya');
    Route::get('/profile/password-edit', "UserController@passwordEdit")->name('akun-saya.password-edit');
    Route::post('/profile/password-edit', "UserController@passwordUpdate")->name('akun-saya.password-update');

    // JSON Response
    Route::get("/json/ngajar", "\App\Http\Controllers\API\DashboardController@guruNgajar")->name('json.guru.ngajar');
    Route::get("/json/getSiswa", "\App\Http\Controllers\API\DashboardController@detail")->name('json.guru.detail_progress');

    Route::get("/json/getModuls", "\App\Http\Controllers\API\ModulController@index")->name('json.guru.progress_moduls');
    Route::get("/json/getVideos", "\App\Http\Controllers\API\VideoController@index")->name('json.guru.progress_videos');
    Route::get("/json/getSimulasis", "\App\Http\Controllers\API\SimulasiController@index")->name('json.guru.progress_simulasis');
    
    Route::get('/json/simulasi/{id}/nilai', '\App\Http\Controllers\API\ScoreController@nilaiSiswa');
});