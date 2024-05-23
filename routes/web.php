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


// Route::get('send-mail', function () {

//     $details = [
//         'title' => 'Selamat Datang di Al-Irsyad Edu!',
//         'body' => 'This is for testing email using smtp'
//     ];

//     \Mail::to('windahidayat27@gmail.com')->send(new \App\Mail\EmailVerificationMail($details));

//     dd("Email is Sent.");
//     // return view('emails.emailVerificationTemplate');
// });

// Routes backoffice
Route::get('backoffice/login', 'Auth\BackofficeLoginController@showLoginForm')->name('backoffice.login');
Route::post('backoffice/login', ['as' => 'backoffice-login', 'uses' => 'Auth\BackofficeLoginController@login']);
Route::post('backoffice/logout', ['as' => 'backoffice-logout', 'uses' => 'Auth\BackofficeLoginController@logout']);

Route::name('backoffice::')->prefix('backoffice')->middleware(['auth:backoffice'])->namespace('Backoffice')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard1');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/profile', "ProfileController@profile")->name('akun-saya');
        Route::get('/profile/edit', "ProfileController@profileEdit")->name('akun-saya.profile-edit');
        Route::post('/profile/edit', "ProfileController@profileUpdate")->name('akun-saya.profile-update');
        Route::post('/profile/photo', "ProfileController@profilePhoto")->name('akun-saya.photo');
        Route::get('/profile/password-edit', "ProfileController@passwordEdit")->name('akun-saya.password-edit');
        Route::post('/profile/password-edit', "ProfileController@passwordUpdate")->name('akun-saya.password-update');

        Route::resource('jenjangs', 'JenjangController');
        Route::resource('tingkats', 'TingkatController');
        Route::get('kelas/listJson', 'KelasController@listJson')->name('kelas.listJson');
        Route::resource('kelas', 'KelasController');
        Route::resource('banners', 'BannerController');

        Route::resource('moduls', 'ModulController');
        Route::resource('videos', 'VideoController');
        Route::resource('simulasis', 'SimulasiController');

        Route::get('story-paths/moduls', 'StoryPathController@getModul')->name('story-paths.getModul');
        Route::get('story-paths/simulasis/{mapelID}', 'StoryPathController@getSimulasi')->name('story-paths.getSimulasi');
        Route::resource('story-paths', 'StoryPathController');

        Route::resource('roles', 'RoleController');
        Route::resource('users', 'UserController');
        Route::resource('mata_pelajarans', 'MataPelajaranController');

        Route::get('external-users/batch_create',  "ExternalUserController@batchImport")->name('external-users.batch_create');
        Route::post('external-users/import', 'ExternalUserController@import')->name('external-users.import');
        Route::get('external-users/enableMapel/{id}', 'ExternalUserController@enableMapel')->name('external-users.enableMapel');
        Route::put('external-users/enableMapel/{id}', 'ExternalUserController@enableMapelUpdate')->name('external-users.enableMapelUpdate');
        Route::get('external-users/next-grade',  "ExternalUserController@nextGrade")->name('external-users.next_grade');
        Route::post('external-users/next-grade', 'ExternalUserController@nextGradeUpdate')->name('external-users.next_grade_update');
        Route::get('external-users/next-grade/list-siswa', 'ExternalUserController@listSiswaJson')->name('external-users.listSiswaJson');
        Route::get('external-users/generate-qr-code/{id}', 'ExternalUserController@generateQRCode')->name('external-users.generateQRCode');
        Route::get('external-users/generate-qr-code-bulk', 'ExternalUserController@generateQRCodeBulk')->name('external-users.generateQRCodeBulk');
        Route::get('external-users/filter-col', 'ExternalUserController@filterCol')->name('external-users.filterCol');

        // begin - development purpose only
        Route::get('external-users/next-grade/add-init-kelas-siswa', 'ExternalUserController@initKelasSiswa')->name('external-users.initKelasSiswa');
        Route::get('external-users/generate-uuid-external-users', 'ExternalUserController@generate_uuid'); //Temp route to generate uuid external users
        Route::get('external-users/set-kelas-id-guru-mapel', 'ExternalUserController@set_kelas_id_guru_mapel'); //Temp route to set default kelas id on guru mapel (first found kelas of tingkat)
        Route::get('external-users/set-user-roles', 'ExternalUserController@set_user_roles'); //Temp route to set user roles (on table model_has_roles)
        // end
        Route::resource('external-users', 'ExternalUserController');
        Route::post('external-users/update-status/{id}', 'ExternalUserController@updateStatus')->name('external-users.update-status');

        Route::resource('manage-external-users', 'ManageExternalUserController');
        // Route::get('manage-external-users/moduls',  "ManageExternalUserController@index_modul")->name('manage-external-users.index_modul');

        // JSON Response
        Route::get("/json/tingkats/{id}", "\App\Http\Controllers\API\TingkatController@show")->name('json.tingkat.detail');
        Route::get("/json/moduls", "\App\Http\Controllers\API\ModulController@index")->name('json.modul');

        Route::get("/json/kelas", "\App\Http\Controllers\API\KelasController@index");
        Route::get("/json/tingkats", "\App\Http\Controllers\API\TingkatController@index");
        Route::get("/json/jenjangs", "\App\Http\Controllers\API\JenjangController@index");

        Route::resource('paket-soals', 'PaketSoalController');
        Route::get('paket-soals/{id}/soal', 'PaketSoalController@indexSoal')->name('paket-soals.index-soal');
        Route::get('paket-soals/{id}/soal/create', 'PaketSoalController@createSoal')->name('paket-soals.create-soal');
        Route::post('paket-soals/{id}/soal/create', 'PaketSoalController@storeSoal')->name('paket-soals.store-soal');
        Route::get('paket-soals/{id}/soal/batch-create', 'PaketSoalController@batchSoal')->name('paket-soals.batch-soal');
        Route::post('paket-soals/{id}/soal/import', 'PaketSoalController@importSoal')->name('paket-soals.import-soal');
        Route::get('paket-soals/{paketId}/soal/{id}/edit', 'PaketSoalController@editSoal')->name('paket-soals.edit-soal');
        Route::put('paket-soals/{paketId}/soal/{id}/edit', 'PaketSoalController@updateSoal')->name('paket-soals.update-soal');
        Route::delete('paket-soals/{paketId}/soal/{id}/delete', 'PaketSoalController@destroySoal')->name('paket-soals.destroy-soal');

        Route::get('soals/create', 'SoalController@create')->name('soals.create');

        Route::resource('e-raport', 'ERaportController');

        Route::resource('password-reset-students', 'PasswordResetStudentController');
        Route::post('password-reset-students/update-status/{id}', 'PasswordResetStudentController@updateStatus')->name('password-reset-students.update-status');

        Route::post("upload/image",  "FileUploadController@uploadImageFile")->name('upload.image');
        Route::post("upload/base64",  "FileUploadController@uploadImageBase64");
        Route::post("upload/imageCKEditor",  "FileUploadController@uploadImageCKEditor")->name('upload.imageCKEditor');
    });

Route::get('/clear-cache', function () {
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want

    return "clear cache success.";
});

//Route api documentation
Route::get('api/docs', function (){
    return view('swagger.index');
});

//Route privacy policy
Route::get('/privacy-policy', function (){
    return view('privacy-policy.index');
});
