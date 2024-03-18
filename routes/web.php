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
// Route::get('/test', [HomeController::class, 'RecursiveRandomNumberGenerator']);
Route::get('/list_portofolio', [HomeController::class, 'portofolio']);
Route::get('/detail_portofolio/{id}', [HomeController::class, 'detail_portofolio']);
Route::get('/detail_service/{id}', [HomeController::class, 'detail_service']);
Route::get('/about', [HomeController::class, 'about']);

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

    Route::get('/adm/mitra', [ContentController::class, 'mitra'])->middleware('cek_login');
    Route::post('/adm/mitra_', [ContentController::class, 'mitra_'])->middleware('cek_login');
    Route::post('/adm/create_mitra', [ContentController::class, 'create_mitra'])->middleware('cek_login');
    Route::post('/adm/update_mitra', [ContentController::class, 'update_mitra'])->middleware('cek_login');
    Route::post('/adm/delete_mitra', [ContentController::class, 'delete_mitra'])->middleware('cek_login');

    Route::get('/adm/team', [ContentController::class, 'team'])->middleware('cek_login');
    Route::post('/adm/team_', [ContentController::class, 'team_'])->middleware('cek_login');
    Route::post('/adm/create_team', [ContentController::class, 'create_team'])->middleware('cek_login');
    Route::post('/adm/update_team', [ContentController::class, 'update_team'])->middleware('cek_login');
    Route::post('/adm/delete_team', [ContentController::class, 'delete_team'])->middleware('cek_login');

    Route::get('/adm/testimoni', [ContentController::class, 'testimoni'])->middleware('cek_login');
    Route::post('/adm/testimoni_', [ContentController::class, 'testimoni_'])->middleware('cek_login');
    Route::post('/adm/create_testimoni', [ContentController::class, 'create_testimoni'])->middleware('cek_login');
    Route::post('/adm/update_testimoni', [ContentController::class, 'update_testimoni'])->middleware('cek_login');
    Route::post('/adm/delete_testimoni', [ContentController::class, 'delete_testimoni'])->middleware('cek_login');

    Route::get('/adm/portofolio', [ContentController::class, 'portofolio'])->middleware('cek_login');
    Route::post('/adm/portofolio_', [ContentController::class, 'portofolio_'])->middleware('cek_login');
    Route::post('/adm/create_portofolio', [ContentController::class, 'create_portofolio'])->middleware('cek_login');
    Route::post('/adm/update_portofolio', [ContentController::class, 'update_portofolio'])->middleware('cek_login');
    Route::post('/adm/delete_portofolio', [ContentController::class, 'delete_portofolio'])->middleware('cek_login');

    Route::get('/adm/service', [ContentController::class, 'service'])->middleware('cek_login');
    Route::post('/adm/service_', [ContentController::class, 'service_'])->middleware('cek_login');
    Route::post('/adm/create_service', [ContentController::class, 'create_service'])->middleware('cek_login');
    Route::post('/adm/update_service', [ContentController::class, 'update_service'])->middleware('cek_login');
    Route::post('/adm/delete_service', [ContentController::class, 'delete_service'])->middleware('cek_login');

    Route::get('/adm/foto_kegiatan', [ContentController::class, 'foto_kegiatan'])->middleware('cek_login');
    Route::post('/adm/foto_kegiatan_', [ContentController::class, 'foto_kegiatan_'])->middleware('cek_login');
    Route::post('/adm/create_foto_kegiatan', [ContentController::class, 'create_foto_kegiatan'])->middleware('cek_login');
    Route::post('/adm/update_foto_kegiatan', [ContentController::class, 'update_foto_kegiatan'])->middleware('cek_login');
    Route::post('/adm/delete_foto_kegiatan', [ContentController::class, 'delete_foto_kegiatan'])->middleware('cek_login');

    Route::get('/adm/kenapa_harus_kami', [ContentController::class, 'kenapa_harus_kami'])->middleware('cek_login');
    Route::post('/adm/kenapa_harus_kami_', [ContentController::class, 'kenapa_harus_kami_'])->middleware('cek_login');
    Route::post('/adm/create_kenapa_harus_kami', [ContentController::class, 'create_kenapa_harus_kami'])->middleware('cek_login');
    Route::post('/adm/update_kenapa_harus_kami', [ContentController::class, 'update_kenapa_harus_kami'])->middleware('cek_login');
    Route::post('/adm/delete_kenapa_harus_kami', [ContentController::class, 'delete_kenapa_harus_kami'])->middleware('cek_login');

    Route::get('/adm/paket', [ContentController::class, 'paket'])->middleware('cek_login');
    Route::post('/adm/paket_', [ContentController::class, 'paket_'])->middleware('cek_login');
    Route::post('/adm/create_paket', [ContentController::class, 'create_paket'])->middleware('cek_login');
    Route::post('/adm/update_paket', [ContentController::class, 'update_paket'])->middleware('cek_login');
    Route::post('/adm/delete_paket', [ContentController::class, 'delete_paket'])->middleware('cek_login');

    Route::get('/adm/paket_detail', [ContentController::class, 'paket_detail'])->middleware('cek_login');
    Route::post('/adm/paket_detail_', [ContentController::class, 'paket_detail_'])->middleware('cek_login');
    Route::post('/adm/create_paket_detail', [ContentController::class, 'create_paket_detail'])->middleware('cek_login');
    Route::post('/adm/update_paket_detail', [ContentController::class, 'update_paket_detail'])->middleware('cek_login');
    Route::post('/adm/delete_paket_detail', [ContentController::class, 'delete_paket_detail'])->middleware('cek_login');

    Route::get('/adm/flow_work', [ContentController::class, 'flow_work'])->middleware('cek_login');
    Route::post('/adm/flow_work_', [ContentController::class, 'flow_work_'])->middleware('cek_login');
    Route::post('/adm/create_flow_work', [ContentController::class, 'create_flow_work'])->middleware('cek_login');
    Route::post('/adm/update_flow_work', [ContentController::class, 'update_flow_work'])->middleware('cek_login');
    Route::post('/adm/delete_flow_work', [ContentController::class, 'delete_flow_work'])->middleware('cek_login');
});
