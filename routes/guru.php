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
});