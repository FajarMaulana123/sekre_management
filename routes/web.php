<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LoginController;
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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('proses_login', [LoginController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'home']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/adm', [AdminController::class, 'index'])->middleware('cek_login');
    Route::get('/adm/user', [AdminController::class, 'user_management'])->middleware('cek_login');
    Route::post('/adm/usermanagemant_', [AdminController::class, 'usermanagement_'])->middleware('cek_login');
    Route::post('/adm/create_usermanagement', [AdminController::class, 'create_usermanagement'])->middleware('cek_login');
    Route::post('/adm/update_usermanagement', [AdminController::class, 'update_usermanagement'])->middleware('cek_login');
    Route::post('/adm/get_modul', [AdminController::class, 'get_modul'])->middleware('cek_login');

    Route::get('/adm/client', [AdminController::class, 'client'])->middleware('cek_login');
    Route::post('/adm/client_', [AdminController::class, 'client_'])->middleware('cek_login');
    Route::post('/adm/create_client', [AdminController::class, 'create_client'])->middleware('cek_login');
    Route::post('/adm/update_client', [AdminController::class, 'update_client'])->middleware('cek_login');
    Route::post('/adm/delete_client', [AdminController::class, 'delete_client'])->middleware('cek_login');
    Route::post('/adm/update_status_client', [AdminController::class, 'update_status_client'])->middleware('cek_login');

    Route::get('/adm/perusahaan', [AdminController::class, 'perusahaan'])->middleware('cek_login');
    Route::post('/adm/perusahaan_', [AdminController::class, 'perusahaan_'])->middleware('cek_login');
    Route::post('/adm/create_perusahaan', [AdminController::class, 'create_perusahaan'])->middleware('cek_login');
    Route::post('/adm/update_perusahaan', [AdminController::class, 'update_perusahaan'])->middleware('cek_login');
    Route::post('/adm/delete_perusahaan', [AdminController::class, 'delete_perusahaan'])->middleware('cek_login');

    Route::get('/adm/jenis_project', [AdminController::class, 'jenis_project'])->middleware('cek_login');
    Route::post('/adm/jenis_project_', [AdminController::class, 'jenis_project_'])->middleware('cek_login');
    Route::post('/adm/create_jenis_project', [AdminController::class, 'create_jenis_project'])->middleware('cek_login');
    Route::post('/adm/update_jenis_project', [AdminController::class, 'update_jenis_project'])->middleware('cek_login');
    Route::post('/adm/delete_jenis_project', [AdminController::class, 'delete_jenis_project'])->middleware('cek_login');
    Route::post('/adm/update_status_project', [AdminController::class, 'update_status_project'])->middleware('cek_login');

    Route::get('/adm/project', [AdminController::class, 'project'])->middleware('cek_login');
    Route::post('/adm/project_', [AdminController::class, 'project_'])->middleware('cek_login');
    Route::post('/adm/create_project', [AdminController::class, 'create_project'])->middleware('cek_login');
    Route::post('/adm/update_project', [AdminController::class, 'update_project'])->middleware('cek_login');
    Route::post('/adm/delete_project', [AdminController::class, 'delete_project'])->middleware('cek_login');

    Route::get('/adm/transaksi', [KeuanganController::class, 'transaksi'])->middleware('cek_login');
    Route::post('/adm/transaksi_', [KeuanganController::class, 'transaksi_'])->middleware('cek_login');
    Route::post('/adm/create_transaksi', [KeuanganController::class, 'create_transaksi'])->middleware('cek_login');
    Route::post('/adm/update_transaksi', [KeuanganController::class, 'update_transaksi'])->middleware('cek_login');

    //CMS
    Route::get('/adm/profile', [ContentController::class, 'profile'])->middleware('cek_login');
    Route::post('/adm/create_profile', [ContentController::class, 'create_profile'])->middleware('cek_login');
});
