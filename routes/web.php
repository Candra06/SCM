<?php

use App\Http\Controllers\HomeController;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'HomeController@Index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/daftar', 'HomeController@register');
Route::post('/register', 'HomeController@store');


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/homes/index', 'Dashboard\HomeController@index');
    Route::get('/homePelanggan/index', 'Dashboard\HomeController@dashboardPelanggan');
    Route::delete('/homes/index/{id}', 'Dashboard\HomeController@delete');
    Route::get('/settings/profile/', 'Dashboard\SettingController@profile');
    Route::put('/settings/profile/{id}', 'Dashboard\SettingController@updateprofile');
    Route::get('/settings/password/', 'Dashboard\SettingController@password');
    Route::put('/settings/password/{id}', 'Dashboard\SettingController@updatepassword');
    Route::resource('/settings/general', 'Dashboard\GeneralController');
    Route::resource('/managements/menu', 'Dashboard\MenuController');
    Route::resource('/managements/submenu', 'Dashboard\SubmenuController');
    Route::resource('/managements/role', 'Dashboard\RolemenuController');
    Route::resource('/users/index', 'Dashboard\UserController');
    Route::resource('/posts/post', 'Dashboard\PostController');
    Route::resource('/posts/category', 'Dashboard\CategoryController');
    Route::resource('/kavling/index', 'Dashboard\KavlingController');
    Route::resource('/tiperumah/data', 'Dashboard\TipeRumahController');
    Route::resource('/supplier/data', 'Dashboard\SupplierController');
    Route::resource('/databarang/data', 'Dashboard\DataBarangController');
    Route::resource('/kontraktor/data', 'Dashboard\KontraktorController');
    Route::resource('/pemesanan/data', 'Dashboard\PemesananController');
    Route::resource('/proyek/data', 'Dashboard\ProyekController');
    Route::resource('/progres-proyek/data', 'Dashboard\Progres_ProyekController');
    Route::resource('/material/data', 'Dashboard\PembelianMaterialController');
    Route::resource('/data-pemesanan-barang/data', 'Dashboard\Data_Pemesanan_BarangController');

    //role pelanggan
    Route::get('/properti/index/', 'Dashboard\TipeRumahController@listProperti');
    Route::get('/properti/detail/{id}', 'Dashboard\TipeRumahController@detailProperti');
    Route::post('/properti/pembelian', 'Dashboard\PembelianController@store');
    Route::get('/pelanggan/editProfil', 'Dashboard\PelangganController@show');
    Route::get('/pembelian/pelanggan', 'Dashboard\PembelianController@index');
    Route::get('/pembelian/pelanggan/{id}', 'Dashboard\PembelianController@show');
});
